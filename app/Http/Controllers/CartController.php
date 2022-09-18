<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Redirect;

session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('product')->where('product_id', $productId)->first();
        $data['id'] = $product_info->product_id;
        $data['quantity'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['title'] = $product_info->product_title;
        $data['price'] = $product_info->product_price;
        $data['attributes']['image'] = $product_info->product_image;
        \Cart::add($data);
        return Redirect::to('/show_cart');
    }

    public function show_cart()
    {
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function delete_to_cart($id)
    {
        \Cart::remove($id);
        return Redirect::to('/show_cart');
    }

    public function update_cart_quantity(Request $request)
    {
        $id = $request->id_cart;
        $qty = $request->cart_quantity;
        \Cart::update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $qty
            ),
        ));
        return Redirect::to('/show_cart');
    }
}
