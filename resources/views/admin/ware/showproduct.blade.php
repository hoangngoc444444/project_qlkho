@extends('admin.master')
@section('content')
<div class="container-fluid">
    <div>
        <a href="{{ route('admin.root.index') }}" class="btn btn-primary">Danh sách kho quản lý</a>
        <a href="{{ route('admin.exportprd',['id' => $ware->id]) }}" class="btn btn-primary">Bảng excel danh sách sản phẩm</a>
        <a href="{{ route('admin.exportnote',['id' => $ware->id]) }}" class="btn btn-primary">Bảng excel các lần nhập xuất</a>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <h4>Danh sách các lần xuất nhập kho {!! "<b>$ware->name</b>" !!}</h4>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên lần nhập kho</th>
                        <th scope="col">loại</th>
                        <th scope="col">Ngày xuất nhập</th>
                        <th scope="col">Sản phẩm và số lượng xuất nhập</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($ware->notes ?: [] as $note)
                    <tr>
                        <td>{{ $note->id }}</td>
                        <td>{{ $note->name }}</td>
                        <td>{{ $note->type == 1 ? "Xuất" : "Nhập" }}</td>
                        <td>{{ $note->created_at }}</td>
                        <th>

                            @forelse($note->products ?: [] as $key => $product)
                            {{ 'Sp'.($key +1).':' }}
                            {{$product->name}}
                            Số lượng:{{$product->pivot->quantity}}
                            @empty
                            @endforelse
                        </th>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div class="col-md-6">
                <h4>Sản phẩm và số lượng trong kho hiện tại</h4>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ware->products ?: [] as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
