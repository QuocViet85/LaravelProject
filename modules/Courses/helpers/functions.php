<?php
function getCategoriesCheckBox($categories, $old = [], $parentId = 0, $char = '') 
{
    if ($categories)
    {
        foreach ($categories as $key => $category)
        {
            if ($category->parent_id == $parentId) //mặc định parentId = 0 nên lấy ra các Category không có parent
            {
                $checked = !empty($old) && in_array($category->id, $old) ? 'checked' : null;
                echo '<label class = "d-block"><input type = "checkbox" name = "categories[]" value = "'.$category->id.'" '.$checked.'/> '.$char.$category->name.'</label>';
                unset($categories[$key]);
                getCategoriesCheckBox($categories, $old, $category->id, $char.' |- '); //Đệ quy => lấy ra các Category con có parent
            }
        }
    }
}