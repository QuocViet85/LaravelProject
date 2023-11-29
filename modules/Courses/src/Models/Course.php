<?php
namespace Modules\Courses\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Categories\src\Models\Category;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'name',
        'slug',
        'detail',
        'teacher_id',
        'thumbnail',
        'price',
        'sale_price',
        'code',
        'durations',
        'is_document',
        'supports',
        'status'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_courses'); //mối quan hệ nhiều - nhiều, cần khai báo tham số thứ 2 là tên bảng trung gian
    }
}