@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/home') }}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng của bạn</li>
                </ol>
            </div>
            <!--/breadcrums-->

            <div class="register-req">
                <p>Vui lòng sử dụng Đăng ký và Thanh toán để dễ dàng truy cập vào lịch sử đặt hàng của bạn hoặc sử dụng
                    Thanh toán với tư cách Khách</p>
            </div>
            <!--/register-req-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-10 clearfix">
                        <div class="bill-to">
                            <p>Thông tin gửi hàng</p>
                            <div class="form-one">
                                <form action="{{ URL::to('/save-checkout-customer/') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="email" name="shipping_email" placeholder="Email*">
                                    <input type="text" name="shipping_name" placeholder="Họ và tên">
                                    <input type="text" name="shipping_address" placeholder="Địa chỉ">
                                    <input type="text" name="shipping_phone" placeholder="Phone">
                                    <textarea name="shipping_notes" placeholder="Ghi chú về đơn đặt hàng của bạn" rows="16"></textarea>

                                    <input class="btn btn-primary btn-sm" type="submit" name="send_order" value="Gửi">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Xem lại và thanh toán</h2>
            </div>
            <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
        </div>
    </section>
    <!--/#cart_items-->
@endsection
