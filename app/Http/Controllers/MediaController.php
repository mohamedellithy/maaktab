<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\services\UploadImage;
class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $medias = Image::query();

        $medias->when(request('media_type') != null,function($q){
            return $q->where('type',request('media_type'));
        });

        $medias = $medias->paginate(100);

        return view('pages.admin.medias.index',compact('medias'));
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // if(request('type') == 'all'):
        //     $medias = Image::destroy($id);
        // else:
        //endif;
        $medias = new UploadImage();
        $medias->delete_image($id);
        flash()->success('تم حذف العناصر بنجاح ');
        return redirect()->back();
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_all()
    {
        //
        $medias = Image::truncate();
        flash()->success('تم حذف العناصر بنجاح');
        return redirect()->back();
    }
}
