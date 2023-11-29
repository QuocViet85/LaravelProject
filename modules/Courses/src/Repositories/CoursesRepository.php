<?php
namespace Modules\Courses\src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\Courses\src\Models\Course;
use Modules\Course\src\Repositories\CourseRepositoryInterface;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }

    public function getAllCourses()
    {
        return $this->model->select(['id', 'name', 'price', 'sale_price', 'status', 'created_at'])->latest();
    }

    public function createCourseCategories($course, $data = [])
    {
        return $course->categories()->attach($data); //thêm dữ liệu vào bảng trung gian để tạo mqh nhiều - nhiều
    }

    public function updateCourseCategories($course, $data = [])
    {
        return $course->categories()->sync($data); //sửa dữ liệu trong bảng trung gian để sửa mqh nhiều - nhiều
        //Cơ chế sửa: xóa tất cả các dòng trong bảng trung gian có courseId như trên và insert vào bảng trung gian các dòng có courseId và categoryId tương ứng nhau mới update
    }
    
    public function deleteCourseCategories($course)
    {
        return $course->categories()->detach(); //xóa dữ liệu trong bảng trung gian chứa Id của 1 hàng trong 1 bảng có mối quan hệ nhiều - nhiều để hủy mqh nhiều - nhiều của hàng đó
    }

    public function getRelatedCategories($course)
    {
        $categoryIds = $course->categories()->allRelatedIds()->toArray(); //lấy id của các dữ liệu có quan hệ nhiều với dữ liệu hiện tại
        return $categoryIds;
    }
}