<?php
namespace Modules\User\src\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Raw;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $pageTitle = 'Quản lý người dùng';

        return view('user::lists', compact('pageTitle'));
    }

    public function data()
    {
        $users= $this->userRepo->getAllUsers(); 

        return DataTables::of($users)
        ->addColumn('edit', function ($user) {
            return '<a href="'.route('admin.users.edit', $user).'" class="btn btn-warning">Sửa</a>';
        })
        ->addColumn('delete', function ($user) {
            return '<a href="'.route('admin.users.delete', $user).'" class="btn btn-danger delete-action">Xóa</a>';
        })
        ->editColumn('created_at', function ($user) {
            return Carbon::parse($user->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])
        ->toJson();
    }

    public function create()
    {  
        $pageTitle = 'Thêm người dùng';
        return view('user::add', compact('pageTitle'));
    }

    public function store(UserRequest $request)
    {
        $this->userRepo->create([
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.users.index')->with('msg', trans('user::messages.create.success'));
    }

    public function edit($id)
    {
        $user = $this->userRepo->find($id);

        if (!$user)
        {
            abort(404);
        }

        $pageTitle = 'Cập nhật người dùng';

        return view('user::edit', compact('user', 'pageTitle'));
    }

    public function update(UserRequest $request, $id)
    {
        $data = $request->except('_token', 'password'); //lấy tất cả dữ liệu từ request ngoại trừ dữ liệu có key là _token, password

        if ($request->password)
        {
            $data['password'] = Hash::make($request->password);
        }

        $this->userRepo->update($id, $data);

        return back()->with('msg', trans('user::messages.update.success'));
    }

    public function delete($id)
    {
        $this->userRepo->delete($id);
        return back()->with('msg', trans('user::messages.delete.success'));
    }
}