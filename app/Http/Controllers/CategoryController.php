<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\traits\ResponseFormate;
class CategoryController extends Controller
{
    use ResponseFormate;
    protected $category;
    public function __construct(Category $category){
        $this->category = $category::query();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $per_page = 10;
        $categories_main = Category::MainCategory()->select('id','name')->get();
        $this->category->when(request('status') != null, function ($q) {
            return $q->where('status',request('status'));
        });

        $this->category->when(request('search') != null, function ($q) {
                return $q->where('name','like', '%' . request('search') . '%')
            ->orWhereHas('main_category',function($query){
                return $query->where('categories.name','like','%' . request('search') . '%');
            });
        });

        $this->category->when(request('filter') == 'sort_asc', function ($q) {
            return $q->orderBy('created_at','asc');
        });

        $this->category->when(request('filter') == 'sort_desc', function ($q) {
            return $q->orderBy('created_at','desc');
        });

        $this->category->when(request('filter') == null, function ($q) {
            return $q->orderBy('created_at','desc');
        });

        if(request('rows')):
            $per_page = request('rows');
        endif;

        $categories      = $this->category->paginate($per_page);
        return view('pages.admin.categories.index', compact('categories','categories_main'));
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
        $request->validate([
            'name' => 'unique:categories,name',
            'parent' => 'nullable|exists:categories,id'
        ]);

        $category = $this->category->create($request->only([
            'name',
            'parent'
        ]));


        flash()->success('تم اضافة تصنيف جديد بنجاح ');
        return back()->with('success_message', 'تم انشاء التصنيف بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $per_page = 10;
        $categories_main = Category::whereNull('parent')->select('id','name')->get();
        $this->category->when(request('status') != null, function ($q) {
            return $q->where('status',request('status'));
        });

        $this->category->when(request('search') != null, function ($q) {
            return $q->where('name','like', '%' . request('search') . '%')->orWhere('email', 'like', '%' . request('search') . '%');
        });

        $this->category->when(request('filter') == 'sort_asc', function ($q) {
            return $q->orderBy('created_at','asc');
        });

        $this->category->when(request('filter') == 'sort_desc', function ($q) {
            return $q->orderBy('created_at','desc');
        });

        $this->category->when(request('filter') == null, function ($q) {
            return $q->orderBy('created_at','desc');
        });

        if(request('rows')):
            $per_page = request('rows');
        endif;

        $categories   = $this->category->paginate($per_page);
        $category     = $this->category->where('id',$id)->first();
        return view('pages.admin.categories.edit', compact('category','categories_main','categories'));
    }

    public function child_categories($id){
        $child_categories = Category::ChildCategory()->where('parent',$id)->select('id','name')->get();
        return $this->response_formate($child_categories);
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
        $request->validate([
            'name' => 'unique:categories,name,'.$id
        ]);

        $category = $this->category->where('id',$id)->update($request->only([
            'name',
            'parent'
        ]));

        return redirect()->route('admin.categories.index');
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
        $delete_category = $this->category->where('id',$id)->delete();
        return $this->response_formate($delete_category);
    }
}
