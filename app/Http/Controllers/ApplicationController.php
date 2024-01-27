<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use App\Models\Application;
use Illuminate\Http\Request;
use App\traits\ResponseFormate;
use App\Http\Requests\ServiceRequest;

class ApplicationController extends Controller
{
    use ResponseFormate;

    protected $application;
    protected $categories;
    public function __construct(Application $application){
        $this->application = $application::query();
        $this->categories  = Category::query();
    }

    public function create()
    {
        $categories_main = $this->categories->whereNull('parent')->select('id','name')->get();
        return view('pages.admin.application.create',compact('categories_main'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'app_name' => 'required|unique:applications,app_name',
            'fields'   => 'required|array',
            'main_category_id'  => 'required|exists:categories,id',
            'child_category_id' => 'nullable|exists:categories,id'
        ]);


        $this->application->create($request->only([
            'app_name',
            'fields',
            'main_category_id',
            'child_category_id'
        ]));

        // \Artisan::call('cache:clear');

        flash()->success('تم اضافة خدمة جديد بنجاح ');
        return redirect()->route('admin.applications.index')->with('success_message', 'تم انشاء الخدمة');
    }

    public function index()
    {
        $applications = $this->application->with('main_category','child_category')->orderBy('id', 'desc')->paginate(10);
        return view('pages.admin.application.index', compact('applications'));
    }

    public function edit($id)
    {
        $application = $this->application->find($id);
        $categories_main = $this->categories->whereNull('parent')->select('id','name')->get();
        return view('pages.admin.application.edit', compact('application','categories_main'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'app_name' => 'required|unique:applications,app_name,'.$id.',id',
            'fields'   => 'required|array',
            'main_category_id'  => 'required|exists:categories,id',
            'child_category_id' => 'nullable|exists:categories,id'
        ]);


        $this->application->where('id',$id)->update($request->only([
            'app_name',
            'fields',
            'main_category_id',
            'child_category_id'
        ]));

        // \Artisan::call('cache:clear');

        flash()->success('تم تحديث خدمة جديد بنجاح ');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $delete_application = $this->application->where('id',$id)->delete();
        return $this->response_formate($delete_application);
    }

    public function applications_by_categories($main_category_id,$child_category_id = null){
        $applications = $this->application->where([
            'main_category_id' => $main_category_id
        ]);

        $applications->when($child_category_id != 'null',function($query) use($child_category_id){
            $query->orWhere('child_category_id',$child_category_id);
        });
        
        $applications = $applications->select('id','app_name')->get();
        return $this->response_formate($applications);
    }
}
