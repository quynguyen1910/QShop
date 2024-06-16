<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ten_sp',
        'slug',
        'anh_sp',
        'gia_sp',
        'giakm_sp',
        'soluong_sp',
        'tinhtrang_sp',
        'noibat_sp',
        'phukien_sp',
        'khuyenmai_sp',
        'mota_sp',
        'cat_id'
    ];

    protected $casts = [
        'tinhtrang_sp' => 'boolean',
        'noibat_sp' => 'boolean',
    ];

    protected $dates = ['deleted_at'];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
