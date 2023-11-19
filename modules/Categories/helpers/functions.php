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

function getCategoriesTable($categories, $char = '', &$result = [])
{
    if (!empty($categories))
    {
        foreach ($categories as $key => $category)
        {
            $row = $category;
            $row['name'] = $char.$row['name'];
            $row['edit'] = '<a href="'.route('admin.categories.edit', $category['id']).'" class="btn btn-warning">Sửa</a>';
            $row['delete'] = '<a href="'.route('admin.categories.delete', $category['id']).'" class="btn btn-danger delete-action">Xóa</a>';
            $row['link'] = '<a target="_blank" href="" class="btn btn-primary">Xem</a>';
            $row['created_at'] = Carbon::parse($row['created_at'])->format('d/m/Y H:i:s');
            unset($row['sub_categories']);
            unset($row['updated_at']);
            $result[] = $row;
            if (!empty($category['sub_categories']))
            {
                getCategoriesTable($category['sub_categories'], $char.'|--', $result);
            }
        }
    }
        return $result;
}