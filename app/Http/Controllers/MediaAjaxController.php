<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\services\UploadImage;
class MediaAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $medias = Image::query();
        if(!request('typeMedia') || request('typeMedia') != 'all'):
            $medias->where('type','Like','%'.request('typeMedia').'%');
        endif;

        $medias = $medias->paginate(10);

        return response()->json([
            'status'  => 'success',
            '_result' => view('partials.media_list_1',compact('medias'))->render()
        ]);
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
        $results =[];
        $image = new UploadImage();
        if($request->hasFile('medias')):
            foreach($request->file('medias') as $media):
                $results[] = $image->upload($media);
            endforeach;
        endif;
        return response()->json([
            'status'  => 'success',
            '_result' => $results
        ]);
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
