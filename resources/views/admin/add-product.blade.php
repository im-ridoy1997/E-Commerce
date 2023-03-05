@extends('admin.layout')
@section('page_title','Add Product')
@section('product_active','active')
@section('content')

<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card-header d-flex justify-content-between" style="background-color: #e9e9e9;">
        <h4>Product Form</h4>
        <div style="margin-top: -13px;">
            <a href="{{ url('admin/product') }}"><button class="btn btn-danger">Back</button></a>
        </div>
    </div>
    <div class="card-body">
        <form action="" id="addProductForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Product Name <span style="color: green !important;">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" >
                    <span class="text-danger " id="name_error"></span>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Item no <span style="color: green !important;">*</span></label>
                    <input type="text" class="form-control" name="sku" id="sku" >
                    <span class="text-danger " id="sku_error"></span>
                </div>
                <div class="col-md-3">
                    <label for="exampleInputEmail1" class="form-label">Authorize <span style="color: green !important;">*</span></label>
                    <select class="form-select" id="validationDefault04" name="product_authorize">
                        <option selected value="all">All</option>
                        <option value="specific">Level C</option>
                    </select>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Category <span style="color: green !important;">*</span></label>
                    <select class="form-select" id="validationDefault04" name="category" onchange="getCategoryValue(this.value)" id="category">
                        <option value="" selected>Select category</option>
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger " id="category_error"></span>
                </div>
                <div class="col-md-6" id="sub-category" style="display: none;">
                    <label for="validationCustom01" class="form-label">Sub Category <span style="color: green !important;">*</span></label>
                    <select class="form-select" id="validationDefault04" name="sub_category" id="sub_category">
                        <option value="" selected>Select sub category</option>
                        @foreach($sub_category as $sub_cat)
                            <option value="{{ $sub_cat->id }}">{{ $sub_cat->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger " id="sub_category_error"></span>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Size</label>
                    <input type="text" class="form-control" name="size" id="size" >
                    <span class="text-danger " id="size_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Size unit</label>
                    <input type="text" class="form-control" name="size_unit" id="size_unit" >
                        <span class="text-danger " id="size_unit_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Weight</label>
                    <input type="text" class="form-control" name="weight" id="weight" >
                    <span class="text-danger " id="weight_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Weight unit</label>
                    <input type="text" class="form-control" name="weight_unit" id="weight_unit" >
                    <span class="text-danger " id="weight_unit_error">{{ $errors->first('weight_unit') }}</span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Color</label>
                    <input type="text" class="form-control" name="color" id="color" >
                    <span class="text-danger " id="color_error"></span>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price Term</label>
                    <input type="text" class="form-control" name="price_term" id="validationCustom01" >
                    <span class="text-danger "></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Currency</label>
                    <input type="text" class="form-control" name="currency" id="validationCustom01" >
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price</label>
                    <select class="form-select" id="validationDefault04" name="price">
                        <option selected value="">Select</option>
                        <option value="0.0236">0.0236</option>
                        <option value="0.0212">0.0212</option>
                        <option value="0.0197">0.0197</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price Unit</label>
                    <input type="text" class="form-control" name="price_per_unit" id="validationCustom01" >
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price Per Quantity</label>
                    <select class="form-select" id="validationDefault04" name="price_per_quantity">
                        <option selected value="">Select</option>
                        <option value="5,000-50,000">5,000-50,000</option>
                        <option value="50,000-100,000">50,000-100,000</option>
                        <option value="200,000-">200,000-</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price Quantity Unit</label>
                    <input type="text" class="form-control" name="price_quantity_unit" id="validationCustom01">
                </div>
            </div>
            <div class="row mt-2">
                <label for="validationCustom01" class="form-label">CTN size(cm)</label>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Length</label>
                    <input type="text" class="form-control" name="ctn_length" id="ctn_length" >
                    <span class="text-danger " id="ctn_length_error"></span>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Height</label>
                    <input type="text" class="form-control" name="ctn_height" id="ctn_height" >
                    <span class="text-danger " id="ctn_height_error"></span>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">width</label>
                    <input type="text" class="form-control" name="ctn_width" id="ctn_width" >
                    <span class="text-danger " id="ctn_width_error"></span>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">G.W.(kgs)</label>
                    <input type="text" class="form-control" name="g_w" id="validationCustom01" >
                    <span class="text-danger "></span>
                </div>
            </div>
            <div class="row mt-2">
                <label for="validationCustom01" class="form-label">Package/CTN</label>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Inner pack</label>
                    <input type="text" class="form-control" name="inner_pack_qty" id="inner_pack_qty" >
                    <span class="text-danger " id="inner_pack_qty_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Inner pack unit</label>
                    <input type="text" class="form-control" name="inner_pack_unit" id="inner_pack_unit" >
                    <span class="text-danger " id="inner_pack_unit_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Mid pack</label>
                    <input type="text" class="form-control" name="mid_pack_qty" id="mid_pack_qty" >
                    <span class="text-danger " id="mid_pack_qty_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Mid pack unit</label>
                    <input type="text" class="form-control" name="mid_pack_unit" id="mid_pack_unit" >
                    <span class="text-danger " id="mid_pack_unit_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Big pack</label>
                    <input type="text" class="form-control" name="big_pack_qty" id="big_pack_qty" value="1">
                    <span class="text-danger " id="big_pack_qty_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Big pack unit</label>
                    <input type="text" class="form-control" name="big_pack_unit" id="big_pack_unit" value="pcs">
                    <span class="text-danger " id="big_pack_unit_error"></span>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">MOQ</label>
                    <input type="text" class="form-control" name="moq" id="moq" >
                    <span class="text-danger " id="moq_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">MOQ unit</label>
                    <input type="text" class="form-control" name="moq_unit" id="moq_unit" >
                    <span class="text-danger " id="moq_unit_error"></span>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">HS code</label>
                    <input type="text" class="form-control" name="hs_code" id="hs_code" >
                    <span class="text-danger " id="hs_code_error"></span>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Material Grade</label>
                    <input type="text" class="form-control" name="material_grade" id="validationCustom01" >
                    <span class="text-danger "></span>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-8">
                    <label for="validationCustom01" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                    <span class="text-danger " id="description_error"></span>
                </div>
            </div>
            <div class="row mt-1">
                <label for="validationCustom01" class="form-label">Images</label>
                <div class="hdtuto lst increment mb-3 col-6 d-flex">
                    <input type="file" name="image[]" id="image" class="myfrm form-control" multiple>
                </div>
                <span class="text-danger pl-3" id="image_error"></span>
                <br>
            </div>
            
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </div>
</div>





@endsection