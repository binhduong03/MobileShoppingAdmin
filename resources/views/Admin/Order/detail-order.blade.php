@extends('index')
@section('index-content')

<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Thông tin đơn hàng (#{{ $order->order_id }})</h2>

    <div class="row">
        <!-- Thông tin người mua -->
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body fw-bold border-0">
                    Thông tin người mua
                </div>
                <div class="card-body p-3">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td>Tên khách hàng</td>
                                <td>{{ $order->user->username ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $order->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td>{{ $order->phone ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Thông tin vận chuyển -->
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body fw-bold border-0">
                    Thông tin vận chuyển
                </div>
                <div class="card-body p-3">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td>Họ tên</td>
                                <td>{{ $order->user->username ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $order->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td>{{ $order->phone  ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Địa chỉ nhận hàng -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body fw-bold border-0">
                    Địa chỉ nhận hàng
                </div>
                <div class="card-body p-3">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td>{{ $order->address ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Thông tin đơn hàng -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body fw-bold border-0">
                    Đơn hàng
                </div>
                <div class="card-body p-3">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($orderDetails as $detail)
                                @php
                                    $subtotal = $detail->quantity * $detail->price;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <div class="d-inline-block w-8 h-8 mr-2">
                                            @if ($detail->product && $detail->product->image)
                                                <img class="img-fluid rounded-full" 
                                                    src="{{ asset('public/backend/assets/img/product/' . $detail->product->image) }}" 
                                                    alt="{{ $detail->product->name }}" loading="lazy" />
                                            @endif
                                        </div>
                                        {{ $detail->product->name ?? 'N/A' }}
                                    </td>
                                    <td class="align-middle">{{ $detail->quantity }}</td>
                                    <td class="align-middle">{{ number_format($detail->price) }} VNĐ</td>
                                    <td class="align-middle">{{ number_format($subtotal) }} VNĐ</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td><td></td>
                                <td>Tạm tính</td>
                                <td>{{ number_format($total) }} VNĐ</td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td>Tổng tiền</td>
                                <td>{{ number_format($total) }} VNĐ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ URL::to('Admin/all-order') }}" class="btn btn-secondary">Quay lại</a>
</div>

@endsection
