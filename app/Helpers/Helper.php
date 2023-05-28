<?php


namespace App\Helpers;

use App\Models\DanhMuc;
use Illuminate\Support\Str;

class Helper
{
    public static function getSubCategories($parentId)
    {
        $subCategories = DanhMuc::where('parent_id', $parentId)->orderBy('id', 'asc')->get();
        return $subCategories;
    }

}
