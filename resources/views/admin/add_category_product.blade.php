@extends('admin_layout')
@section('admin_content')
    <?php
    use Illuminate\Support\Facades\Session;
    ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
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
                        <form role="form" action="{{ URL::to('/save-category-product') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" name="category_product_name" class="form-control"
                                    id="exampleInputEmail1" placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc"
                                    id="exampleInputPassword1" placeholder="Mô tả danh mục"> </textarea>
                            </div>
                            <div class="form-group">
                                <select name="category_product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
