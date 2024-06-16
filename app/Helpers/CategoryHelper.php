<?php

namespace App\Helpers;

class CategoryHelper
{
    public static function buildCategoryTree($data, $parentId = null, $prefix = '--')
    {
        $tree = [];

        foreach ($data as $item) {
            if ($item->parent_id === $parentId || is_null($parentId)) {
                $item->ten_dm = $prefix . $item->ten_dm;
                $item->children = self::buildCategoryTree($data, $item->id, $prefix . '--');
                $tree[] = $item;
            }
        }
        return $tree;
    }
}
