@extends('layout.client.layout')

@section('title', 'Sign In')
@section('content')
    <div class="container">
        <div class="row view-acc">
            <div class="col-xs-12 col-sm-2" style="padding: 20px">
                <a class="col-xs-2 col-sm-12 a-title" href="{{ route('view.acc') }}">Xem Thông Tin</a>
                <a class="col-xs-3 col-sm-12 a-title" href="{{ route('view.his') }}">Lịch sử đặt hàng</a>
            </div>
            <div style="padding: 30px" class="col-xs-12 col-sm-10">
                <div class="row a-input">
                    <div class="col-12">
                        <table>
                            <tr>
                                <td>Name</td>
                                <td>Phone</td>
                                <td>Address</td>
                                <td>Total</td>
                                <td>Payment</td>
                                <td>Status</td>
                                <td>Date</td>
                                <td></td>
                            </tr>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->total }} VND</td>
                                    <td>{{ $order->payment }}</td>
                                    <td>@php echo $order->status == 1 ? 'đang xử lý' : '';@endphp
                                        @php echo $order->status == 2 ? 'Đang giao hàng' : '';@endphp
                                        @php echo $order->status == 3 ? 'Đã nhận hàng' : '';@endphp
                                        @php echo $order->status == 5 ? 'Đã hủy' : '';@endphp
                                    </td>
                                    <td>{{ $order->date }}</td>
                                    @if ($order->status == 1)
                                        <td><a href="{{ route('view.his.huy', $order->id) }}">Hủy</a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
