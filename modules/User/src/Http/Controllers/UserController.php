<?php
namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\src\Models\User;
use Modules\User\src\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        //Để trả về view của module thì cần khai báo theo cú pháp: tên module như đã thiết lập trong phần khai báo view::tên view
        return view('user::lists'); 
    }

    public function detail($id)
    {
        return view('user::detail', compact('id'));
    }

    public function create()
    {
        $user = new User();
        $user->name = 'Quoc Viet';
        $user->email = 'phoquocviet@gmail.com';
        $user->save();
    }
}