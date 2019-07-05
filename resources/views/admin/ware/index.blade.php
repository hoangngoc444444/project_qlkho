@extends('admin.master')
@section('content')
<div class="container">
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

    <table width='100%' border='0'>
        <tr>
            <th width='10%'>ID</th>
            <th width='10%'>Tên Kho</th>
            <th width='10%'>Tên người quản lý</th>
            <th width='10%'>Ngày cập nhật</th>
            <th width='10%'>Chức năng</th>
        </tr>
        @forelse($wares ?: [] as $ware)
        <tr>
            <td>{{ $ware->id }}</td>
            <td>
                <div contentEditable='true' class='edit' id='name_{{ $ware->id }}'>
                    {{ $ware->name }}
                </div>
            </td>
            <td>
                <div>
                    {{ $ware->user->name }}
                </div>
            </td>
            <td>{{ $ware->created_at }}</td>
            <td>
                <a href="{{ route('admin.ware.show', ['id' => $ware->id]) }}" class="btn btn-primary btn-sm">Thêm thông
                    tin xuất nhập kho</a>

                <a href="{{ route('admin.showproduct', ['id' => $ware->id]) }}" class="btn btn-outline-dark btn-sm">Xem
                    thông tin hàng hóa trong kho này</a>
            </td>
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
<script src="{{ asset('js/ware.js') }}" defer></script>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/ware.css') }}">
@endsection
