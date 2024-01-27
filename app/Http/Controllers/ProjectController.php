<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    protected $category;
    protected $project;
    public function __construct(Project $project){
        $this->project  = $project::query();
        $this->category = Category::query();
    }

    public function create()
    {
        $categories_main = $this->category->MainCategory()->select('id','name')->get();
        return view('pages.admin.projects.create',compact('categories_main'));
    }
    public function store(ProjectRequest $request)
    {
        if(!request('status')):
            $request->merge([
                'status' => 'inactive'
            ]);
        endif;
        $slug = str_replace(' ','-',request('slug') ?: request('name'));
        $request->merge([
            'slug' => $slug
        ]);
        $product = Project::create($request->only([
            'name',
            'description',
            'short_description',
            'thumbnail_id',
            'status',
            'slug',
            'attachments_id',
            'price',
            'from',
            'to',
            'meta_title',
            'meta_description',
            'main_category_id',
            'child_category_id',
            'application_id'
        ]));

        if($request->has('download_name')):
            $product->downloads()->create($request->only([
                'project_id',
                'download_name',
                'download_description',
                'download_link',
                'download_attachments_id',
                'download_status',
                'download_type'
            ]));
        endif;

        \Artisan::call('cache:clear');

        flash()->success('تم اضافة منتج جديد بنجاح ');
        return redirect()->route('admin.projects.index')->with('success_message', 'تم انشاء الخدمة');
    }
    public function index(Request $request)
    {
        $projects =  Project::query();
        $projects = $projects->with('image_info');
        $per_page = 10;
        if($request->has('search')):
            $projects = $projects->where('name', 'like', '%' . $request->query('search') . '%')->orWhere('name', 'like', '%' . $request->query('search') . '%');
        endif;

        if($request->has('status')):
            $projects = $projects->where('status',$request->query('status'));
        endif;

        if($request->has('filter')):
            if($request->query('filter') == 'high-price'):
                $projects = $projects->orderBy('price','desc');
            elseif($request->query('filter') == 'low-price'):
                $projects = $projects->orderBy('price','asc');
            endif;
        else:
            $projects = $projects->orderBy('id', 'desc');
        endif;

        if($request->has('rows')):
            $per_page = $request->query('rows');
        endif;

        $projects = $projects->paginate($per_page);
        return view('pages.admin.projects.index', compact('projects'));
    }
    public function edit($id)
    {
        $project = Project::with('downloads')->find($id);
        $categories_main = $this->category->MainCategory()->select('id','name')->get();
        return view('pages.admin.projects.edit', compact('project','categories_main'));
    }
    public function update(ProjectRequest $request, $id)
    {
        if(!request('status')):
            $request->merge([
                'status' => 'inactive'
            ]);
        endif;
        $project = Project::find($id);
        $slug = str_replace(' ','-',request('slug') ?: request('name'));
        $request->merge([
            'slug' => $slug
        ]);
        $project->update($request->only([
            'name',
            'short_description',
            'description',
            'thumbnail_id',
            'status',
            'slug',
            'attachments_id',
            'price',
            'from',
            'to',
            'meta_title',
            'meta_description',
            'main_category_id',
            'child_category_id',
            'application_id'
        ]));

        if(request('download_name')):
            $project->downloads()->updateOrCreate($request->only([
                'project_id',
            ]),$request->only([
                'download_name',
                'download_description',
                'download_link',
                'download_attachments_id',
                'download_status',
                'download_type'
            ]));
        endif;

        \Artisan::call('cache:clear');

        flash()->success('تم تعديل المنتج بنجاح');

        return redirect()->route('admin.projects.index');
        // return redirect()->back();

    }
    public function show($id)
    {
        $project = Project::find($id);
        return view('pages.admin.projects.show', compact('project'));
    }
    public function destroy($id)
    {
        $project = Project::destroy($id);

        flash()->success('تم حذف المنتج بنجاح');
        \Artisan::call('cache:clear');
        return redirect()->route('admin.projects.index');

    }
}
