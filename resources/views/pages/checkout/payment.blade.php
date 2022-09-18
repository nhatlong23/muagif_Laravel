@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/home') }}">Trang chủ</a></li>
                    <li class="active">Xem Lại Giỏ Hàng</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <?php
                $content = \Cart::getContent();
                // echo '<pre>';
                // print_r($content);
                // echo '</pre>';
                ?>
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Image</td>
                            <td class="description">Mô tả</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($content as $v_content)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img
                                            src="{{ URL::to('uploads/product/' . $v_content->attributes->image) }}"
                                            width="50" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $v_content->name }}</a></h4>
                                    <p>Tile: {{ $v_content->product_title }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($v_content->price) . ' ' . 'VNĐ' }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <form method="post" action="{{ URL::to('/update-cart-quantity') }}">
                                            {{ csrf_field() }}
                                            <input class="cart_quantity_input" type="text" name="cart_quantity"
                                                value="{{ $v_content->quantity }}" size="2">
                                            <input class="cart_quantity_input" type="hidden" name="id_cart"
                                                value="{{ $v_content->id }}">

                                            <input class="cart_quantity_input" type="submit" value="Cập nhật"
                                                name="update_qty" value="{{ $v_content->id }}">
                                        </form>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        <?php
                                        $subtotal = $v_content->price * $v_content->quantity;
                                        echo number_format($subtotal) . ' ' . 'VNĐ';
                                        ?>
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete"
                                        href="{{ URL::to('/delete-to-cart/' . $v_content->id) }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="review-payment">
                <h2>Xem lại và thanh toán</h2>
            </div>
            <br>
            <form method="POST" action="{{ URL::to('/order-place') }}">
                {{ csrf_field() }}
                <div class="payment-options">
                    <span>
                        <label><input name="payment_option" value="1" type="checkbox"> ATM</label>
                    </span>
                    <span>
                        <label><input name="payment_option" value="2" type="checkbox"> Trả tiền mặt</label>
                    </span>
                    <span>
                        <label><input type="checkbox"> Paypal</label>
                    </span>
                    <input class="btn btn-primary btn-sm" type="submit" name="send_order_place" value="Đặt hàng">

                </div>
            </form>
        </div>
    </section>
    <!--/#cart_items-->
@endsection
