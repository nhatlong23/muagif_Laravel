@extends('admin_layout')
@section('admin_content')
    <?php
    use Illuminate\Support\Facades\Session;
    ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
                </header>
                <?php
                $mess = Session::get('mess');
                if ($mess) {
                    echo '<span class="text-alert">', $mess . '</span>';
                    Session::put('mess', null);
                }
                ?>
                <div class="panel-body">
                    @foreach ($edit_brand_product as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{ URL::to('/update-brand-product/' . $edit_value->brand_id) }}"
                                method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{ $edit_value->brand_name }}" name="brand_product_name"
                                        class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1">{{ $edit_value->brand_desc }} </textarea>
                                </div>
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
