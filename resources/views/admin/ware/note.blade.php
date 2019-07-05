@extends('admin.master')
@section('content')
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-3">
        <form id="xuatnhapForm" action="{{ route('admin.storenote') }}" method="POST">
                {{ csrf_field() }}
        <div class="panel-heading" style="color:brown;font-size: large;margin:10px">Nhập thông tin xuất nhập kho của {!! "<b>$ware->name</b>" !!}</div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên xuất nhập kho"
                        value="{{ old('name') }}">
                    <span class="help-block">{{ $errors->first('name') }}</span>
                </div>

                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="type">Chọn loại xuất kho hay nhập kho</label><br>
                    <input type="radio" name="type" value="1">Xuất
                    <input type="radio" name="type" value="2"> Nhập<br>
                    <span class="help-block">{{ $errors->first('type') }}</span>
                </div>
            <input type="hidden" id="wareid" name="id" value="{{ $ware->id }}">
            <span class="help-block">{{ $errors->first('productname') }}</span>
            <br>
            <span class="help-block">{{ $errors->first('productname.*') }}</span>
            <br>
            <span class="help-block">{{ $errors->first('quantity.*') }}</span>
                <fieldset id="buildyourform">
                    <legend>Nhập hàng hóa và số lượng hàng hóa</legend>
                </fieldset>
                <input type="button" value="Nhập hàng và số lượng hàng" class="add" id="add" />

                <button type="submit" class="btn btn-success">Tạo xuất nhập kho</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/input.js') }}" defer></script>
<script src="{{ asset('js/addxuatnhap.js') }}" defer></script>
@endsection
@section('css')
<script src="{{ asset('css/input.css') }}" defer></script>
@endsection

