<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = Page::paginate(10);
        return view('pages.admin.settings.pages.index',compact('pages'));
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
        //
        $page = Page::create([
            'title'     => $request->input('title'),
            'slug'      => $request->input('slug'),
            'status'    => $request->input('status'),
            'position'  => $request->input('position')
        ]);

        \Artisan::call('cache:clear');

        flash()->success('تم اضافة صفحة جديد بنجاح ');
        return redirect()->back();
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
        $page = Page::find($id);
        return view('pages.admin.settings.pages.edit',compact('page'));
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
        $data = [
            'title'            => $request->input('title'),
            'content'          => is_array($request->input('content')) ? serialize($request->input('content')) : $request->input('content'),
            'status'           => $request->input('status'),
            'thumbnail_id'     => $request->input('thumbnail_id'),
            'meta_title'       => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'position'         => $request->input('position'),
            'menu_position'    => $request->input('menu_position')
        ];

        if(request('slug')):
            $slug         = str_replace(' ','-',$request->input('slug') ?: $request->input('title'));
            $data['slug'] = $slug;
        endif;

        $page = Page::where('id',$id)->update($data);

        \Artisan::call('cache:clear');

        flash()->success('تم تحديث الصفحة بنجاح ');
        return redirect()->back();
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

        $page = Page::destroy($id);

        flash()->success('تم حذف الصفحة بنجاح');

        \Artisan::call('cache:clear');

        return back();
    }
}
