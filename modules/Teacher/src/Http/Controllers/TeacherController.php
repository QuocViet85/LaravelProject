<?php
namespace Modules\Teacher\src\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Raw;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Teacher\src\Http\Requests\TeacherRequest;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    protected $teacherRepo;

    public function __construct(TeacherRepositoryInterface $TeacherRepo)
    {
        $this->teacherRepo = $TeacherRepo;
    }

    public function index()
    {
        $pageTitle = 'Quản lý giảng viên';

        return view('teacher::lists', compact('pageTitle'));
    }

    public function data()
    {
        $teachers = $this->teacherRepo->getAllTeachers(); 

        return DataTables::of($teachers)
        ->addColumn('edit', function ($teacher) {
            return '<a href="'.route('admin.teacher.edit', $teacher).'" class="btn btn-warning">Sửa</a>';
        })
        ->addColumn('delete', function ($teacher) {
            return '<a href="'.route('admin.teacher.delete', $teacher).'" class="btn btn-danger delete-action">Xóa</a>';
        })
        ->editColumn('created_at', function ($teacher) {
            return Carbon::parse($teacher->created_at)->format('d/m/Y H:i:s');
        })
        ->editColumn('image', function ($teacher) {
            return $teacher->image ? '<img src = "'.$teacher->image.'" style = "width: 80px" />' : '';
        })
        ->rawColumns(['edit', 'delete', 'image'])
        ->toJson();
    }

    public function create()
    {  
        $pageTitle = 'Thêm giảng viên';
        return view('teacher::add', compact('pageTitle'));
    }

    public function store(TeacherRequest $request)
    {
        $teacher = $request->except(['_token']);

        $this->teacherRepo->create($teacher);

        return redirect()->route('admin.teacher.index')->with('msg', trans('teacher::messages.create.success'));
    }

    public function edit($id)
    {
        $teacher = $this->teacherRepo->find($id);

        if (!$teacher)
        {
            abort(404);
        }

        $pageTitle = 'Cập nhật giảng viên';

        return view('teacher::edit', compact('teacher', 'pageTitle'));
    }

    public function update(TeacherRequest $request, $id)
    {
        $teacher = $request->except('_token'); //lấy tất cả dữ liệu từ request ngoại trừ dữ liệu có key là _token

        $this->teacherRepo->update($id, $teacher);

        return back()->with('msg', trans('teacher::messages.update.success'));
    }

    public function delete($id)
    {
        $this->teacherRepo->delete($id);
        return back()->with('msg', trans('teacher::messages.delete.success'));
    }
}