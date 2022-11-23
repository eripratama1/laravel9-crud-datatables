<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Membuat accessor untuk mendapatkan attribut nilai image dari table Post
     * Jadi kita tidak harus menulis kode secara berulang-ulang untuk mengakses
     * lokasi penyimpanan gambar 
     */

    public function getImage()
    {
        if ($this->image) {
            return asset('uploads/'.$this->image);
        }
    }


    /**
     * Membuat method getCategory untuk mendapatkan nilai pada tabel kategori
     * dengan relasi 1 to 1 dari tabel Post ke category
     */
    public function getCategory()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
