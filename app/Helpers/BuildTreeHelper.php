<?php

namespace App\Helpers;

function buildTree($data, $parentId = null, $prefix = '--') {
    $tree = [];

    foreach ($data as $item) {
        if ($item->parent_id === $parentId) {
            $item->ten_dm = $prefix . $item->ten_dm;
            $tree[] = $item;
            $tree = array_merge($tree, buildTree($data, $item->id, $prefix . '--'));
        }
    }

    return $tree;
}
