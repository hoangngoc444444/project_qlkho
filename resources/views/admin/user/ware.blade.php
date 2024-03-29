@extends('admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <a href="{{ route('admin.root.index') }}" class="btn btn-primary">Danh sách quản lý</a>
            </div>
            <div class="panel panel-default">
            <div class="panel-heading">Danh sách kho hàng quản lý của người quan lý{{ $user->name}}</div>
                    <div class="panel-body">
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Các kho hang quản lý</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <th>
                                                @forelse($user->wares ?: [] as $ware)
                                                {{"|$ware->name|"}}
                                                @empty
                                                No data
                                            @endforelse
                                        </th>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.root.show', ['id' => $user->id]) }}"
                                               class="btn btn-primary">Sửa</a>
                                            <a href="{{ route('admin.root.destroy', ['id' => $user->id]) }}"
                                               class="btn btn-danger"
                                               onclick="event.preventDefault();
                                                        window.confirm('Bạn đã chắc chắn xóa chưa?') ?
                                                       document.getElementById('user-delete-{{ $user->id }}').submit() :
                                                       0;">Xóa</a>
                                            <form action="{{ route('admin.root.destroy', ['id' => $user->id]) }}"
                                                  method="post" id="user-delete-{{ $user->id }}">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
