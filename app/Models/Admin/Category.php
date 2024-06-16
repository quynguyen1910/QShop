<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'ten_dm',
        'slug',
        'parent_id',
    ];


    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }

    // Mối quan hệ với danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Mối quan hệ với các danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Đệ qui để lấy danh sách con
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive')->orderBy('ten_dm');
    }

    // Phương thức đệ qui để lấy danh sách các danh mục cha và các danh mục con của chúng
    public static function getNestedCategories($categories, $prefix = '')
    {
        $nestedCategories = collect();

        foreach ($categories as $category) {
            $category->ten_dm = $prefix . $category->ten_dm;
            $nestedCategories->push($category);
            if ($category->childrenRecursive->isNotEmpty()) {
                $nestedCategories = $nestedCategories->merge(self::getNestedCategories($category->childrenRecursive, $prefix . '--'));
            }
        }

        return $nestedCategories;
    }
}
