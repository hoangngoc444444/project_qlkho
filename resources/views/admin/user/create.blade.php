@extends('admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <a href="{{ route('admin.root.index') }}" class="btn btn-primary">Danh sách quản lý</a>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading">Thêm quản lý</div>
                <div class="panel-body">
                    <form id="qlForm" action="{{ route('admin.root.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Họ tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên"
                                value="{{ old('name') }}">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Địa chỉ Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Địa chỉ Email"
                                value="{{ old('email') }}">
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        </div>
                        <button type="submit" class="btn btn-success">Tạo quản lý</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/addql.js') }}" defer></script>
@endsection
