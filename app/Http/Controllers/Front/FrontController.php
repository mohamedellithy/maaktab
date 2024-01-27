<?php

namespace App\Http\Controllers\Front;

use Mail;
use App\Models\Page;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Review;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Proposal;
use App\Mail\ContactMail;
use App\Models\Application;
use Illuminate\Support\Str;
use App\Mail\NewsLetterMail;
use Illuminate\Http\Request;
use App\Services\UploadImage;
use App\Mail\ReplayContactMail;
use Illuminate\Validation\Rule;
use App\Models\ApplicationOrder;
use App\services\ThawaniPayment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ApplicationServiceRequest;

class FrontController extends Controller
{
    //

    public function index(){
        $projects = Cache::rememberForever('all-products',function(){
            return $projects = Project::where('status','active')->get();
        });

        $services = Cache::rememberForever('all-services',function(){
            return $services = Service::where('status','active')->get();
        });
        return view('pages.front.index',compact('projects','services'));
    }

    public function projects_show(){
        $projects = Project::query();

        $projects->with('image_info')->where('status','active');

        if(request('search')):
            $projects = $projects->where('name', 'like', '%' . request('search') . '%')->orWhere('name', 'like', '%' . request('search') . '%');
        endif;

        if(request('order_by')):
            if(request('order_by') == 'high-price'):
                $projects = $projects->orderBy('price','desc');
            elseif(request('order_by') == 'low-price'):
                $projects = $projects->orderBy('price','asc');
            endif;
        else:
            $projects = $projects->orderBy('created_at', 'desc');
        endif;

        $projects = $projects->paginate(12);


        return view('pages.front.project.show-projects',compact('projects'));
    }

    public function single_project($slug){
        $project    = Project::with('image_info')->where('slug',$slug)->first();
        return view('pages.front.project.single-project',compact('project'));
    }

    public function ajax_apply_coupon(Request $request){
        $project = Project::where('id',$request->input('project_id'))->first();
        $coupon = check_coupon_exists($project,$request->input('coupon_code'));
        $result = null;
        if($coupon):
            $result  = apply_coupon_code($coupon,get_price_after_discount($project));
        endif;
        return response()->json([
            'project_id' =>  $request->input('project_id'),
            'code'       =>  $request->input('coupon_code'),
            'result'     =>  $result
        ]);
    }

    public function ajax_paginate_review_lists(){
        $reviews    = Review::query()->where([
            'product_id' => request('product_id')
        ]);

        $reviews->whereNull('replay_on');

        $reviews->where('status','active');

        if(auth()->user()):
            $reviews->where('customer_id','!=',auth()->user()->id);
        endif;

        $reviews = $reviews->orderBy('created_at','desc')->offset(request('offset'))->limit(5)->get();

        return response()->json([
            'status'  => 'success',
            '_result' => view('partials.reviews_list',compact('reviews'))->render()
        ]);
    }

    public function services(){
        $services = Service::query();

        $services = $services->where('status','active');
        $services->with('image_info');
        $services->when(request('search') != null, function ($q) {
            return $q->where('name','like', '%' . request('search') . '%')->orWhere('description', 'like', '%' . request('search') . '%');
        });

        $services = $services->orderBy('created_at','desc')->paginate(12);

        return view('pages.front.service.show-services',compact('services'));
    }

    public function single_service($slug){
        $service  = Service::with('image_info')->where([
            'slug'   => $slug,
            'status' => 'active'
        ])->first();
        return view('pages.front.service.single-service',compact('service'));
    }

    public function application_form($application_id,$selected_id,$selected){
        $application = Application::find($application_id);
        if($selected == 'service'):
            $model   = Service::find($selected_id);
        elseif($selected == 'project'):
            $model   = Project::find($selected_id);
        endif;
        return view('pages.front.application.form',compact('application','model'));
    }

    public function application_submit(Request $request,$application_id,$selected_id,$selected){
        $selected   = $selected == 'service' ? 'Service' : 'Project';
        $request->validate([
            'application_id' => [
                Rule::unique('orders','application_id')->where(function($query) use($selected_id,$selected){
                    return $query->where([
                        'customer_id'    => 1,
                        'modelable_id'   => $selected_id,
                        'modelable_type' => "App\Models\\".$selected,
                        'status'         => 'opened'
                    ]);
                })
            ]
        ]);
        $application = Application::findOrfail($application_id);
        $order_attachments = [];
        DB::beginTransaction();
        // filter table application fields
        $inputs      = [];
        foreach($application->fields as $field):
            $filter_field = json_decode($field,true);
            $inputs[]     = Str::replace(' ','_',$filter_field['name']);
        endforeach;
        $input_data = $request->only($inputs);
        // create order
        $order = Order::create([
            'customer_id'    => auth()->user()->id,
            'order_no'       => Str::random(10),
            'application_id' => $application_id,
            'modelable_id'   => $selected_id,
            'modelable_type' => "App\Models\\".$selected,
            'order_status'   => 'pending'
        ]);

        if($order):
            foreach($input_data as $field => $value):
                $type = "text";
                if($request->hasFile($field)):
                    $attachment  = new UploadImage();
                    $result      = $attachment->upload($request->file($field));
                    $value       = $result ? $result->id : null;
                    $type        = 'media';
                endif;
                $order_attachments[] = [
                    'order_id' => $order->id,
                    'name'     => $field,
                    'value'    => $value,
                    'type'     => $type
                ];
            endforeach;
            $order->order_attachments()->insert($order_attachments);
            DB::commit();
        else:
            DB::rollBack();
        endif;
        flash()->success('تم ارفاق النموذج الطلب بنجاح');
        return redirect()->route('my-orders');
    }

    public function my_account(){
        return view('pages.front.my-account.index');
    }

    public function my_orders(){
        $orders = Order::with('order_attachments','modelable')->where('customer_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(10);
        return view('pages.front.customer.orders.list-orders',compact('orders'));
    }

    public function single_order($order_id,$section = 'proposals'){
        $data = [];
        $order = Order::where([
            'id'           => $order_id,
            'customer_id'  => auth()->user()->id
        ])->with('order_attachments','modelable')->orderBy('created_at','desc')->firstOrfail();
        if($section == 'proposals'):
            $data['proposals'] = Proposal::where('order_id',$order->id)->orderBy('id','desc')->paginate(10);
        elseif($section == 'project-payments'):
            $data['payments'] = Payment::where('order_id',$order->id)->orderBy('id','desc')->paginate(10);
        elseif($section == 'project-discussions'):
            $data['project-discussions'] = Message::where('order_id',$order->id)->orderBy('id','desc')->paginate(10);
        endif;

        return view('pages.front.customer.orders.single-order',compact('order','data'));
    }

    public function accept_proposal($proposal_id){
        $proposal = Proposal::findOrfail($proposal_id);
        $proposal->update([
            'status' => 'accepted'
        ]);

        Proposal::where([
            ['order_id','=',$proposal->order_id],
            ['id','!=',$proposal->id]
        ])->update([
            'status' => 'refused'
        ]);

       $order =  Order::where([
            'id' => $proposal->order_id,
        ])->first();
        
        $order->update([
            'proposal_id'  => $proposal->id,
            'order_status' => 'progress',
            'order_total'  => $proposal->price
        ]);
        
        Payment::create([
            'order_id' => $order->id,
            'transaction_id' => Str::random(100),
            'status_payment' => 'success',
            'total_payment'  => $order->order_total,
            'getaway'        => 'thawani'
        ]);
        // $payment = new ThawaniPayment();
        // $payment->create_portal_payment($order);

        return back();
    }

    public function payment_success(){
        $success = new ThawaniPayment();
        $success->success_payment();
        return $success;
    }

    public function thank_you_payment($order_no = null){
        $order = Order::with('payment','order_items','order_items.product','order_items.product.downloads')->where('order_no',$order_no)->first();
        return view('pages.front.orders.thank_you',compact('order'));
    }

    public function refuse_proposal($proposal_id){
        $proposal = Proposal::findOrfail($proposal_id);
        $proposal->update([
            'status' => 'refused'
        ]);

        return back();
    }


    public function setting_account(){
        return view('pages.front.customer.settings.index');
    }

    public function update_account(Request $request){
        $email_changed = false;
        $request->validate([
            'phone' => 'unique:users,phone,'.auth()->user()->id,
            'email' => 'unique:users,email,'.auth()->user()->id
        ]);

        $data = [
            'name'       => $request->input('name'),
            'phone'      => $request->input('phone'),
            'phone_code' => $request->input('phone_code')
        ];

        if(request('password')):
            $data['password'] = Hash::make($request->input('password'));
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        endif;

        if(request('email') != auth()->user()->email):
            $data['email'] = $request->input('email');
            $data['email_verified_at'] = null;
            $email_changed = true;
        endif;

        User::where('id',auth()->user()->id)->update($data);

        if($email_changed == true):
            Auth::logout();
        endif;

        flash()->success('Account is updated successfully');

        return back();
    }

    public function contact_us(){
        $page = Page::where('slug','contact-us')->first();
        return view('pages.front.contact-us',compact('page'));
    }

    public function custom_page($slug){
        $page = Page::where('slug',$slug)->first();
        return view('pages.front.custom_page',compact('page'));
    }

    public function post_contact_us(ContactUsRequest $request){
        $adminEmail = 'info@pioneeringstep.com';
        $data = $request->all();
        $data['phone'] = $data['phone_code'] .$data['phone'];
        if(Mail::to($adminEmail)->send(new ContactMail($data))){
            flash()->success('تم ارسال الرسالة بنجاح ');
            Mail::to($data['email'])->send(new ReplayContactMail($data));
        }

        return redirect()->back();
    }

    public function post_news_letter(Request $request){
        $adminEmail = 'info@pioneeringstep.com';
        $data = $request->all();
        if(Mail::to($adminEmail)->send(new NewsLetterMail($data))){
            flash()->success('تم ارسال طلب الاشتراك بنجاح ');
        }

        return redirect()->back();
    }

    public function generate_sitemap(){
        set_time_limit(100000000);
        SitemapGenerator::create(env('APP_URL'))
        ->getSitemap()
        ->writeToFile(public_path('sitemap.xml'));
    }

    public function send_message(Request $request){
        $request->validate([
            'order_id' => [
                'required',
                'exists:orders,id'
            ]
        ]);

        $results =[];
        $image = new UploadImage();
        if($request->hasFile('medias')):
            foreach($request->file('medias') as $media):
                $media_uploaded = $image->upload($media);
                $results[]      = $media_uploaded->id;
            endforeach;
        endif;
        $discussion = Message::create([
            'message'     => $request->input('message'),
            'attachments' => implode(',',$results),
            'client_id'   => auth()->user()->id,
            'sender'      => 'client',
            'order_id'    => $request->input('order_id')
        ]);
        return response()->json([
            'success' => true,
            'template' => view('pages.front.customer.orders.sections.templates.messgae-template',compact('discussion'))->render(),
            'data' => $request->all()
        ]);
    }

    public function my_payments(){
        $payments = Payment::whereHas('order',function($query){
            return $query->where('orders.customer_id',auth()->user()->id);
        })->orderBy('id','desc')->paginate(10);
        return view('pages.front.customer.payments.list-payments',compact('payments'));
    }

    // public function search_ajax(Request $request){

    //     if(request('search')):
    //         $results = Product::where('name','like','%'.request('search').'%')
    //         ->orWhere('short_description','like','%'.request('search').'%')
    //         ->orWhere('description','like','%'.request('search').'%')->limit(5)->get();

    //         $services = Service::where('name','like','%'.request('search').'%')
    //         ->orWhere('description','like','%'.request('search').'%')->limit(5)->get();

    //         $results = $results->merge($services);
    //     else:
    //         $results = null;
    //     endif;

    //     return response()->json([
    //         'data'    => request('search'),
    //         'results' => $results,
    //         '_render' => view('partials.search_ajax',compact('results'))->render()
    //     ]);
    // }

    // public function search(Request $request){

    //     $search = request('search');
    //     if(request('search')):
    //         $results = Project::where('name','like','%'.request('search').'%')
    //         ->orWhere('short_description','like','%'.request('search').'%')
    //         ->orWhere('description','like','%'.request('search').'%')->limit(20)->get();

    //         $services = Service::where('name','like','%'.request('search').'%')
    //         ->orWhere('description','like','%'.request('search').'%')->limit(20)->get();

    //         $results = $results->merge($services);
    //     else:
    //         $results = null;
    //     endif;

    //     return view('pages.front.search',compact('results','search'));
    // }
}
