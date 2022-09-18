@extends('admin_layout')
@section('admin_content')
    <?php
    use Illuminate\Support\Facades\Session;
    ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
                <?php
                $mess = Session::get('mess');
                if ($mess) {
                    echo '<span class="text-alert">', $mess . '</span>';
                    Session::put('mess', null);
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/save-product') }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="product_name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Tên sản phẩm" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="text" data-validation="number" name="product_price" class="form-control"
                                    id="exampleInputEmail1" placeholder="Giá sản phẩm" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" name="product_title" class="form-control" id="exampleInputEmail1"
                                    placeholder="title sản phẩm" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="ckeditor1"
                                    placeholder="Mô tả sản phẩm" required autocomplete="off"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="ckeditor2"
                                    placeholder="Nội dung sản phẩm" required autocomplete="off"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    @foreach ($cate_product as $key => $cate)
                                        <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Brand</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach ($brand_product as $key => $brand)
                                        <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
