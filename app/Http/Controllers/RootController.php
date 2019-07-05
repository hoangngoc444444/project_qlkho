<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPass;
use App\Http\Requests\CreateManagerRequest;
use App\Mail\Regis;

class RootController extends Controller
{
    protected $model;
    public function __construct(User $user)
    {
        $this->middleware('CheckRoot');
        $this->middleware('CheckRole')->except('showWare');
        $this->model = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = $this->model->getUsers();
        unset($data['users'][0]);
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateManagerRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = rand(1111, 9999);
        $user = $this->model->insertUser($name, $email, $password);
        $data['user'] = $user;
        $data['password'] = $password;
        Mail::to($email)->queue(new Regis($data));
        // Mail::to($email)->queue(new ResetPass($user));
        return redirect()->route('admin.root.index')->with('message', 'Tạo quản lý thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->model->deleteUser($id);
        return redirect()->route('admin.root.index')->with('message', "Đã xóa quản lý $user->name");
    }

    public function showreset()
    {
        $data['users'] = $this->model->getUsers();

        return view('reset', $data);
    }
    public function resetAll(Request $request)
    {
        if ($request->users) {
            $users = $request->users;
            foreach ($users as $name => $user) {
                $user = $this->model->getUserbyID($user);
                $user->password = bcrypt(123456);
                $email = $user->email;
                $user->save();
                Mail::to($email)->queue(new ResetPass($user));
            }
            return redirect()->route('admin.root.index')->with('message', 'Reset thành công');
        } else {
            return redirect()->route('admin.root.index')->with('error', 'Chưa chọn tài khoản reset');
        }
    }

    public function showWare()
    {
        $user = Auth::user();
        $data['user'] = $user;
        return view('admin.user.ware', $data);
    }
}
