<?php

use Illuminate\Support\Carbon;
function getCategories($categories, $old = '', $parentId = 0, $char = '') 
{
    $currentId = request()->route()->category;
    if ($categories)
    {
        foreach ($categories as $key => $category)
        {
            if ($category->parent_id == $parentId && $currentId != $category->id) //mặc định parentId = 0 nên lấy ra các Category không có parent
            {
                echo '<option value = "'.$category->id.'"';
                if ($old == $category->id)
                {
                    echo ' selected';
                }
                echo '>'.$char.$category->name.'</option>';
                unset($categories[$key]);
                getCategories($categories, $old, $category->id, $char.' |- '); //Đệ quy => lấy ra các Category con có parent
            }
        }
    }
}

