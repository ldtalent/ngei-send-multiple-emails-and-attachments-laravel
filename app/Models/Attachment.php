<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $casts = [
        'cc'=>'array',
//        'attachments'=>'array'
    ];
    protected $fillable = [
        'email',
        'cc',
        'subject',
        'message',
        'attachments',
        'send',
    ];
}
