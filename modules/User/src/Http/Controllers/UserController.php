<?php
namespace Modules\User\src\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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

        $data = [];
        foreach ($users as $user)
        {
            array_push($data, [
                ...$user->toArray(), //... giúp chuyển các phần tử của mảng con thành phần tử của mảng cha
                'edit' => '<a href="#" class="btn btn-warning">Sửa</a>',
                'delete' => '<a href="#" class="btn btn-danger">Xóa</a>'
            ]);
        }

        return response()->json([
            "draw" => 1,
            "recordsTotal" => count($users),
            "recordsFiltered" => count($users),
            "data" => $data,
        ]);
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

        return redirect()->route('admin.users.index')->with('msg', trans('user::messages.success'));
    }
}