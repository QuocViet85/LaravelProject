<?php
namespace Modules\Courses\src\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Raw;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class CoursesController extends Controller
{
    protected $coursesRepo;

    protected $categoriesRepo;

    public function __construct(CoursesRepositoryInterface $coursesRepo, CategoriesRepositoryInterface $categoriesRepo)
    {
        $this->coursesRepo = $coursesRepo;
        $this->categoriesRepo = $categoriesRepo;
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
        ->editColumn('status', function ($course) {
            return $course->status == 1 ? '<button class = "btn btn-success">Ra mắt</button>' : '<button class = "btn btn-warning">Chưa ra mắt</button>';
        })
        ->editColumn('price', function ($course) {
            if ($course->price)
            {
                if ($course->sale_price != 0)
                {
                    $price = number_format($course->sale_price, 0, '.', ','). ' VNĐ';
                }
                else
                {
                    $price = number_format($course->price, 0, '.', ','). ' VNĐ';
                }
            }
            else
            {
                $price = 'Miễn phí';
            }

            return $price;
        })
        ->rawColumns(['edit', 'delete', 'status'])
        ->toJson();
    }

    public function create()
    {  
        $pageTitle = 'Thêm khóa học';

        $categories = $this->categoriesRepo->getAllCategories();

        return view('courses::add', compact('pageTitle', 'categories'));
    }

    public function store(CoursesRequest $request)
    {
        $course = $request->except('_token');

        if (!$course['sale_price'])
        {
            $course['sale_price'] = 0;
        }

        if (!$course['price'])
        {
            $course['price'] = 0;
        }

        $courseInserted = $this->coursesRepo->create($course);

        $categories = $this->getCategories($course);

        $this->coursesRepo->createCourseCategories($courseInserted, $categories);

        return redirect()->route('admin.courses.index')->with('msg', trans('courses::messages.create.success'));
    }

    public function edit($id)
    {
        $course = $this->coursesRepo->find($id);

        if (!$course)
        {
            abort(404);
        }

        $categoryIds = $this->coursesRepo->getRelatedCategories($course);

        $categories = $this->categoriesRepo->getAllCategories();

        $pageTitle = 'Cập nhật khóa học';

        return view('courses::edit', compact('course', 'pageTitle', 'categories', 'categoryIds'));
    }

    public function update(CoursesRequest $request, $id)
    {
        $course = $request->except(['_token', '_method']);

        if (!$course['sale_price'])
        {
            $course['sale_price'] = 0;
        }

        if (!$course['price'])
        {
            $course['price'] = 0;
        }

        $this->coursesRepo->update($id, $course);

        $categories = $this->getCategories($course);

        $courseUpdate = $this->coursesRepo->find($id);

        $this->coursesRepo->updateCourseCategories($courseUpdate, $categories);

        return back()->with('msg', trans('courses::messages.update.success'));
    }

    public function delete($id)
    {
        $course = $this->coursesRepo->find($id);
        $this->coursesRepo->deleteCourseCategories($course);
        $this->coursesRepo->delete($id);
        return back()->with('msg', trans('courses::messages.delete.success'));
    }

    public function getCategories($course)
    {
        $categories = [];

        foreach ($course['categories'] as $category)
        {
            $categories[$category] = ['created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')];
        }

        return $categories;
    }
}