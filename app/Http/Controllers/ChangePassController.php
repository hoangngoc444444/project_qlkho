<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePassRequest;

class ChangePassController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function postCredentials(ChangePassRequest $request)
    {
                $current_password = Auth::user()->password;
        if (Hash::check($request->current_password, $current_password)) {
            $user_id = Auth::user()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->password);
            if (!Auth::user()->email) {
                $obj_user->email = $request->email;
            }
            $obj_user->change = 1;
            $obj_user->save();
            // echo "doipasthanhcong";
            return redirect()->route('admin.root.index');
        } else {
            return redirect()->back()->with('error', 'Nhập đúng mật khẩu hiện tại');
        }
    }
}
