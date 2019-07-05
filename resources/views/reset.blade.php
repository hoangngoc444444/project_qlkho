@extends('admin.master')
@section('content')
<div class="container">
    <form action="{{ route('admin.reset') }}" method="POST">
        {{ csrf_field() }}
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Reset mật khẩu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td><input type="checkbox" name="users[{{ $user->name }}]" value="{{ $user->id }}">Chọn</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No data</td>
                </tr>
                @endforelse
                <button type="submit" class="btn btn-success">Reset mật khẩu</button>
            </tbody>
        </table>
    </form>
</div>
@endsection
