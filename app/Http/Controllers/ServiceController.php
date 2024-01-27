<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    protected $category;
    protected $service;
    public function __construct(Service $service){
        $this->service  = $service::query();
        $this->category = Category::query();
    }

    public function create()
    {
        $categories_main = $this->category->MainCategory()->select('id','name')->get();
        return view('pages.admin.services.create',compact('categories_main'));
    }
    public function store(ServiceRequest $request)
    {
        $this->service->create($request->only([
            'name',
            'description',
            'image',
            'whatsapStatus',
            'whatsapNumber',
            'loginStatus',
            'slug',
            'child_category_id',
            'main_category_id',
            'application_id',
            'status'
        ]));

        \Artisan::call('cache:clear');

        flash()->success('تم اضافة خدمة جديد بنجاح ');
        return redirect()->route('admin.services.index')->with('success_message', 'تم انشاء الخدمة');
    }
    public function index()
    {

        $services = $this->service->with('image_info')->orderBy('id', 'desc')->paginate(10);
        return view('pages.admin.services.index', compact('services'));
    }
    public function edit($id)
    {
        $service = $this->service->find($id);
        $categories_main = $this->category->MainCategory()->select('id','name')->get();
        return view('pages.admin.services.edit', compact('service','categories_main'));
    }
    public function update(ServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->image = $request->image;
        $service->whatsapStatus = $request->input('whatsapStatus');
        $service->whatsapNumber = $request->input('whatsapNumber');
        $service->loginStatus = $request->input('loginStatus');
        $service->slug = $request->input('slug');
        $service->status = $request->input('status') ?: 'unactive';
        $service->child_category_id = $request->input('child_category_id');
        $service->main_category_id  = $request->input('main_category_id');
        $service->application_id    = $request->input('application_id');
        $service->save();

        \Artisan::call('cache:clear');

        flash()->success('تم تحديث الخدمة بنجاح ');
        return redirect()->route('admin.services.index');
        // return redirect()->back();

    }
    public function show($id)
    {
        $service = $this->service->find($id);
        return view('pages.admin.services.show', compact('service'));
    }
    public function destroy($id)
    {
        $service = $this->service->destroy($id);
        \Artisan::call('cache:clear');
        flash()->success('تم حذف الخدمة بنجاح ');
        return redirect()->route('admin.services.index');

    }
    public function search(Request $request)
    {
        $loginStatus = $request->loginStatus;
        $whatsapStatus = $request->whatsapStatus;

        $services = $this->service->where('name', 'like', '%' . $request->search . '%')->when(!is_null($loginStatus), function ($query) use ($loginStatus) {
            return $query->where('loginStatus', $loginStatus);
        })->when(!is_null($whatsapStatus), function ($query) use ($whatsapStatus) {
            return $query->where('whatsapStatus', $whatsapStatus);
        })
            ->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'status' => 'success',
            '_result' => view('partials.services_list', compact('services'))->render(),
        ]);
    }


}
