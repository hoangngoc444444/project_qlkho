<h3>
    Admin vừa reset mật khẩu
</h3>
<p>Tên: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<p>Quyền: {{ $user->roles ? "admin" : "user" }}</p>
<p>Mật khẩu mới sau reset: <b>{{ 123456 }}</b></p>
