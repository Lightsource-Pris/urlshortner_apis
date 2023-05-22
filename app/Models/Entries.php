<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entries extends Model
{
    use HasFactory;
    protected $fillable = ['unique_name','original_url','short_url','expiration','status'];
    protected $attributes = ['status'=>1];
    protected $hidden = ['created_at','updated_at'];
}
