<?php
namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class UploadImage
{

    private $image;
    public function upload($image)
    {
        $this->image = $image;

        if ($this->validate_image_exist() == false):
            return [
                'status' => false,
                'message' => 'Image not Exist',
            ];
        endif;

        $new_image_name = $this->generate_image_name();
        $upload         = $this->image->storeAs($this->image_path(), $new_image_name, 'public');

        if ($upload):
            return $this->store_on_db($upload,$new_image_name);
        endif;

        return [
            'status' => false,
            'message' => 'Image not stored',
        ];
    }

    public function validate_image_exist()
    {
        if (is_null($this->image)) {
            return false;
        }

        if (gettype($this->image) != 'object') {
            return false;
        }

        return true;
    }

    public function get_full_image_path()
    {
        return $this->image_path() . '/' . $this->generate_image_name();
    }

    public function generate_image_name()
    {
        return  pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME).'_'. time() . '.' . $this->image->getClientOriginalExtension();
    }

    public function image_path()
    {
        return 'services/image';
    }

    public function store_on_db($image,$name)
    {

        $image = Image::create([
            'path' => $image,
            'name' => $name,
            'size' => $this->image->getSize(),
            'type' => $this->image->getClientMimeType()
        ]);

        return $image;
    }

    public function delete_image($image_id)
    {
        $image = Image::find($image_id);

        if($image):
            if(file_exists(Storage::disk('public')->path($image->path))):
                File::delete(Storage::disk('public')->path($image->path));
            endif;
        endif;

        $image->delete();

        return [
            'status' => 'true',
            'message' => 'Image is stored successfully',
            'path' => $image,
        ];
    }
    public function add_image_info($data, $image_id)
    {
        $image = Image::where([
            'id' => $image_id,
        ])->update($data);
    }

}
