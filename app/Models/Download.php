<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'download_name',
        'download_description',
        'download_link',
        'download_attachments_id',
        'download_status',
        'download_type'
    ];
}
