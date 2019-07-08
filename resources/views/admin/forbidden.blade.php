@extends('admin.master')
@section('content')
<div class="alert alert-danger">
    <strong>Bạn không có quyền truy cập !!!</strong>
  </div>
<a href="{{ route('logut') }}" class="btn btn-link">Đăng nhập với tài khoản root</a>
@endsection
