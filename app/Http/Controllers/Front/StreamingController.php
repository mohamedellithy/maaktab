<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Image;
class StreamingController extends Controller
{
    //

    public function view_attachments($attachment_id){
        $attachment = Image::where([
            'id' => $attachment_id
        ])->first();
        $path = Storage::disk('public')->path($attachment->path);

        $headers = [
            'Content-Type' => $attachment->type,
            'Content-Disposition' => 'inline; filename="'.$path. '"',
        ];

        return response()->file($path, $headers);
    }

    public function viewPdf($filename){
        // $path = Storage::disk('public')->path('services/image/'.$filename);

        // $headers = [
        //     'Content-Type' => 'image/png',
        //     'Content-Disposition' => 'inline; filename="' . 'services/image/'.$filename . '"',
        // ];

        // return response()->file($path, $headers);
    }
}
