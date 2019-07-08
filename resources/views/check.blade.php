@extends('admin.master')
@section('content')
<div class="container">
    {{ 'Không có quyền truy cập' }}

    <a class="btn btn-primary btn-small" href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">Thoát ra và đăng nhập với quyền root</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</div>
@endsection
