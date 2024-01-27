<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $reviews   =  Review::query();
        $reviews   =  $reviews->with('customer','product')->whereNull('replay_on');
        $per_page  = 10;

        $reviews->when(request('search') != null, function ($q) {
            return $q->WhereHas('customer',function($query){
                $query->where('name', 'like', '%' . request('search') . '%');
            })->orWhereHas('product',function($query){
                $query->where('name', 'like', '%' . request('search') . '%');
            });
        });

        $reviews->when(request('filter') == 'sort_asc', function ($q) {
            return $q->orderBy('created_at','asc');
        });

        $reviews->when(request('filter') == 'sort_desc', function ($q) {
            return $q->orderBy('created_at','desc');
        });
            
        $reviews->when(!request('filter'), function ($q) {
            return $q->orderBy('created_at','desc');
        });

        if($request->has('rows')):
            $per_page = $request->query('rows');
        endif;

        $reviews   = $reviews->paginate($per_page);

        return view('pages.admin.reviews.index',compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $review   =  Review::with('customer','product','replays')->find($id);
        return view('pages.admin.reviews.show',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $review = Review::find($id);
        if(request('replay')):
            $replay = Review::create([
                'review' => $request->input('review'),
                'replay_on' => $review->id,
                'product_id' => $review->product->id,
                'customer_id' => auth()->user()->id
            ]);
            flash()->success('تم اضافة الرد على التقيم بنجاح');
        endif;

        if(request('status')):
            $review->update([
                'status' => request('status')
            ]);
            flash()->success('تم تعديل حالة التقيم بنجاح');
        endif;
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
