@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Xác nhận qua email gửi đến địa chỉ mail của bạn') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Một mail mới được gửi đến để xác nhận.') }}
                        </div>
                    @endif

                    {{ __('Trước khi bắt đầu, hãy check email và xác nhận qua đường link được gửi tới') }}
                    {{ __('Nếu không nhận được email') }}, <a href="{{ route('verification.resend') }}">{{ __('click vào đây để gửi lai') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
