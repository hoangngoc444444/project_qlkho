@extends('admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <a href="{{ route('admin.ware.index') }}" class="btn btn-primary">Danh sách kho hàng</a>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading">Thêm kho hàng</div>
                <div class="panel-body">
                    <form id="khoForm" action="{{ route('admin.ware.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Tên kho hàng</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên kho hàng"
                                value="{{ old('name') }}">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                            <label for="user_id">Tên người quản lý</label>
                            <select name="user_id" id="user_id" class="form-control">
                                    <option value="">Chọn người quản lý</option>
                                @if (count($users) > 0)
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                            <span class="help-block">{{ $errors->first('user_id') }}</span>
                        </div>
                        <button type="submit" class="btn btn-success">Tạo kho hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/addkho.js') }}" defer></script>
@endsection
