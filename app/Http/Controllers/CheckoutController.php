<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Darryldecode\Cart\Cart;

session_start();
class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function login_checkout()
    {
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $customer_id = DB::table('customer')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }

    public function checkout()
    {
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;
        $shipping_id = DB::table('shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }

    public function payment()
    {
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function order_place(Request $request)
    {
        // insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = \Cart::getTotal();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('order')->insertGetId($order_data);

        //insert order details
        $content = \Cart::getContent();
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->quantity;
            DB::table('order_details')->insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {
            echo 'Thanh toán bằng thẻ ATM';
        } else if ($data['payment_method'] == 2) {
            \Cart::clear();
            return view('pages.checkout.handcash');
        } else {
            echo 'Thanh toán bằng thẻ ghi nợ';
        }
        return Redirect::to('/payment');
    }

    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/');
    }

    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    //order Admin
    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
            ->select('order.*', 'customer.customer_name')
            ->orderby('order.order_id', 'desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }

    public function view_order($order_id)
    {
        $this->AuthLogin();
        $order_by_id = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
            ->join('shipping', 'order.shipping_id', '=', 'shipping.shipping_id')
            ->join('order_details', 'order.order_id', '=', 'order_details.order_id')
            ->select('order.*', 'customer.*', 'shipping.*', 'order_details.*')
            ->first();
        $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
    }

    public function delete_order($order_id)
    {
        $this->AuthLogin();
        DB::table('order')->where('order_id', $order_id)->delete();
        Session::put('message', 'Xóa đơn hàng thành công');
        return Redirect::to('/manage_order');
    }
}
