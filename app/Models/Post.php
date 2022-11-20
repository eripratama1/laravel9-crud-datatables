<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImage()
    {
        if ($this->image) {
            return asset('uploads/'.$this->image);
        }
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
