<?php
namespace Modules\Categories\src\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;

class CategoriesController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoriesRepositoryInterface $cateRepo)
    {   
        $this->categoryRepo = $cateRepo;
    }

    public function index()
    {
        $pageTitle = 'Quản lý danh mục';

        return view('categories::lists', compact('pageTitle'));
    }

    public function data()
    {
        $categories = $this->categoryRepo->getCategories(); 

        return DataTables::of($categories)
        ->addColumn('edit', function ($category) {
            return '<a href="'.route('admin.categories.edit', $category).'" class="btn btn-warning">Sửa</a>';
        })
        ->addColumn('delete', function ($category) {
            return '<a href="'.route('admin.categories.delete', $category).'" class="btn btn-danger delete-action">Xóa</a>';
        })
        ->addColumn('link', function ($category) {
            return '<a href="" class="btn btn-primary">Xem</a>';
        })
        ->editColumn('created_at', function ($category) {
            return Carbon::parse($category->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete', 'link'])
        ->toJson();
    }

    public function create()
    {
        $pageTitle = 'Thêm danh mục';
        return view('categories::add', compact('pageTitle'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryRepo->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')->with('msg', trans('categories::messages.create.success'));
    }

    public function edit($id)
    {
        $category = $this->categoryRepo->find($id);

        if (!$category)
        {
            abort(404);
        }

        $pageTitle = 'Cập nhật danh mục';

        return view('categories::edit', compact('category', 'pageTitle'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->except('_token'); //lấy tất cả dữ liệu từ request ngoại trừ dữ liệu có key là _token

        $this->categoryRepo->update($id, $data);

        return back()->with('msg', trans('categories::messages.update.success'));
    }

    public function delete($id)
    {
        $this->categoryRepo->delete($id);
        return back()->with('msg', trans('categories::messages.delete.success'));
    }

    public function test()
    {
        
    }
}