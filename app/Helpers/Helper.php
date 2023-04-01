<?php


namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{

    public static function menus($danhmuc, $parent_id = 0) :string
    {
        $html = '';
        foreach ($danhmuc as $key => $muc) {
            if ($muc->parent_id == $parent_id) {
                $html .= '
                    <li class = "nav-item">
                        <a class = "menu" href="/san-pham/'.$muc->id.'">
                            ' . $muc->ten_danh_muc . '
                        </a>';

                unset($danhmuc[$key]);

                if (self::isChild($danhmuc, $muc->id)) {
                    $html .= '<div class="bar-item_propose nav-item_propose">';
                    $html .= '<ul class="bar-item_propose-list">';
                    $html .= self::menus($danhmuc, $muc->id);
                    $html .= '</ul>';
                    $html .= '</div>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }

    public static function isChild($danhmuc, $id) : bool
    {
        foreach ($danhmuc as $muc) {
            if ($muc->parent_id == $id) {
                return true;
            }
        }

        return false;
    }

}
