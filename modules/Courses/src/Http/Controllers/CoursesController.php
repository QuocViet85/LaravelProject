<?php
namespace Modules\Courses\src\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Raw;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Course\src\Http\Requests\CourseRequest;
use Modules\Courses\src\Repositories\CoursesRepository;

class CoursesController extends Controller
{
    protected $coursesRepo;

    public function __construct(CoursesRepository $coursesRepo)
    {
        $this->coursesRepo = $coursesRepo;
    }

    public function index()
    {
        $pageTitle = 'Quản lý khóa học';

        return view('courses::lists', compact('pageTitle'));
    }

    public function data()
    {
        $courses = $this->coursesRepo->getAllCourses(); 

        return DataTables::of($courses)
        ->addColumn('edit', function ($course) {
            return '<a href="'.route('admin.courses.edit', $course).'" class="btn btn-warning">Sửa</a>';
        })
        ->addColumn('delete', function ($course) {
            return '<a href="'.route('admin.courses.delete', $course).'" class="btn btn-danger delete-action">Xóa</a>';
        })
        ->editColumn('created_at', function ($course) {
            return Carbon::parse($course->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])
        ->toJson();
    }

    public function create()
    {  
        $pageTitle = 'Thêm khóa học';
        return view('courses::add', compact('pageTitle'));
    }

    public function store(CourseRequest $request)
    {
        
    }

    public function edit($id)
    {
        $course = $this->coursesRepo->find($id);

        if (!$course)
        {
            abort(404);
        }

        $pageTitle = 'Cập nhật khóa học';

        return view('courses::edit', compact('course', 'pageTitle'));
    }

    public function update(CourseRequest $request, $id)
    {
        
    }

    public function delete($id)
    {
        $this->coursesRepo->delete($id);
        return back()->with('msg', trans('courses::messages.delete.success'));
    }
}