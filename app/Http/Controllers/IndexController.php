<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        //seo
        $meta_desc = "Chuyên cung cấp các loại sản phẩm thời trang nam nữ";

        //--seo
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $all_product = DB::table('product')->where('product_status', '0')->orderby('product_id', 'desc')->limit(4)->get();
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);
    }

    public function search(Request $request)
    {
        if (($_POST['keywords_submit'])) {
            $cate_product = DB::table('category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
            $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
            $keywords = $request->keywords_submit;
            $search_product = DB::table('product')->where('product_name', 'like', '%' . $keywords . '%')->get();
        } else {
            return redirect()->to('/');
        }
        return view('pages.detail.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product);
    }

}
