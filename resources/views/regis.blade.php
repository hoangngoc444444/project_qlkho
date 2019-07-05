<h2>Thông tin quản lý mới tạo</h2>


<p>Tên: <b>{{ $user->name }}</b></p>
<p>Email: <b>{{ $user->email }}</b></p>
<p>Quyền: <b>{{ $user->roles ? "admin" : "Người quản lý kho" }}</b></p>
<p>Mật khẩu: <b>{{ $password }}</b></p>
