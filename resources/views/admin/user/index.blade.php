@extends('admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <a href="{{ route('admin.root.create') }}" class="btn btn-primary">Tạo quản lý</a>
                <a href="{{ route('admin.ware.create') }}" class="btn btn-primary">Tạo kho</a>
                <a href="{{ route('admin.resetall') }}" class="btn btn-primary">Reset mật khẩu</a>
                <a href="{{ route('admin.export') }}" class="btn btn-primary">Bảng excel quản lý</a>
            </div>
            <br>
        </div>
    </div>
</div>
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class='container'>
    <table width='100%' border='0'>
        <tr>
            <th width='10%'>ID</th>
            <th width='20%'>Tên</th>
            <th width='20%'>Email</th>
            <th width='20%'>Các kho hang quản lý</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
        </tr>
        @forelse($users ?: [] as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>
                <div contentEditable='true' class='edit' id='name_{{ $user->id }}'>
                    {{ $user->name }}
                </div>
            </td>
            <td>
                <div contentEditable='true' class='edit' id='email_{{ $user->id }}'>
                    {{ $user->email }}
                </div>
            </td>
            <td>
                @forelse($user->wares ?: [] as $ware)
                {{"|$ware->name|"}}
                @empty
                No data
                @endforelse
            </td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No data</td>
        </tr>
        @endforelse
    </table>
</div>
@endsection
@section('js')
<script src="{{ asset('js/test.js') }}" defer></script>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/test.css') }}">
@endsection
