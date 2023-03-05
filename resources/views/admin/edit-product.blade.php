@extends('admin.layout')
@section('page_title','Edit Product')
@section('product_active','active')
@section('content')

<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card-header d-flex justify-content-between" style="background-color: #e9e9e9;">
        <h4>Product Form</h4>
        <div>
            <a href="{{ url('admin/product') }}"><button class="btn btn-danger">Back</button></a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('admin/product/update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Product Name <span style="color: green !important;">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}" id="validationCustom01" >
                    @if($errors->has('name'))
                        <span class="text-danger ">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Item no <span style="color: green !important;">*</span></label>
                    <input type="text" class="form-control" name="sku" value="{{ $product->sku }}"  id="validationCustom01" >
                    @if($errors->has('sku'))
                        <span class="text-danger ">{{ $errors->first('sku') }}</span>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="exampleInputEmail1" class="form-label">Authorize <span style="color: green !important;">*</span></label>
                    <select class="form-select" id="validationDefault04" name="product_authorize">
                        @if($product->product_authorize == 'all')
                        <option selected value="all">All</option>
                        <option  value="specific">Level C</option>
                        @elseif($product->product_authorize == 'specific')
                        <option selected value="specific">Level C</option>
                        <option value="all">All</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Category <span style="color: green !important;">*</span></label>
                    <select class="form-select" id="validationDefault04" name="category" onchange="getCategoryValue(this.value)">
                        <option value="" selected>Select category</option>
                        @foreach($category as $cat)
                            @if($cat->id == $product->category)
                                <option value="{{ $cat->id }}" selected>{{ $cat->category_name }}</option>
                            @else
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if($errors->has('category'))
                        <span class="text-danger ">{{ $errors->first('category') }}</span>
                    @endif
                </div>
                <div class="col-md-6" id="sub-category">
                    <label for="validationCustom01" class="form-label">Sub Category <span style="color: green !important;">*</span></label>
                    <select class="form-select" id="validationDefault04" name="sub_category">
                        <option value="" selected>Select sub category</option>
                        @foreach($sub_category as $sub_cat)
                            @if($sub_cat->id == $product->sub_category)
                                <option value="{{ $sub_cat->id }}" selected>{{ $sub_cat->category_name }}</option>
                            @else
                                <option value="{{ $sub_cat->id }}">{{ $sub_cat->category_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if($errors->has('sub_category'))
                        <span class="text-danger ">{{ $errors->first('sub_category') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Size</label>
                    <input type="text" class="form-control" name="size" value="{{ $product->size }}"  id="validationCustom01" >
                    @if($errors->has('size'))
                        <span class="text-danger ">{{ $errors->first('size') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Size unit</label>
                    <input type="text" class="form-control" name="size_unit" value="{{ $product->size_unit }}"  id="validationCustom01" >
                    @if($errors->has('size_unit'))
                        <span class="text-danger ">{{ $errors->first('size_unit') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Weight</label>
                    <input type="text" class="form-control" name="weight" value="{{ $product->weight }}"  id="validationCustom01" >
                    @if($errors->has('weight'))
                        <span class="text-danger ">{{ $errors->first('weight') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Weight unit</label>
                    <input type="text" class="form-control" name="weight_unit" value="{{ $product->weight_unit }}"  id="validationCustom01" >
                    @if($errors->has('weight_unit'))
                        <span class="text-danger ">{{ $errors->first('weight_unit') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Color</label>
                    <input type="text" class="form-control" name="color" value="{{ $product->color }}"  id="validationCustom01" >
                    @if($errors->has('color'))
                        <span class="text-danger ">{{ $errors->first('color') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price Term</label>
                    <input type="text" class="form-control" name="price_term" value="{{ $product->price_term }}"  id="validationCustom01" >
                    @if($errors->has('price_term'))
                        <span class="text-danger ">{{ $errors->first('price_term') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Currency</label>
                    <input type="text" class="form-control" name="currency" value="{{ $product->currency }}"  id="validationCustom01" >
                    @if($errors->has('currency'))
                        <span class="text-danger ">{{ $errors->first('currency') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price</label>
                    <select class="form-select" id="validationDefault04" name="price">
                        @if($product->price == 0.0236)
                        <option value="">Select</option>
                        <option selected value="0.0236">0.0236</option>
                        <option value="0.0212">0.0212</option>
                        <option value="0.0197">0.0197</option>
                        @elseif($product->price == 0.0212)
                        <option value="">Select</option>
                        <option value="0.0236">0.0236</option>
                        <option selected value="0.0212">0.0212</option>
                        <option value="0.0197">0.0197</option>
                        @elseif($product->price == 0.0197)
                        <option value="">Select</option>
                        <option value="0.0236">0.0236</option>
                        <option value="0.0212">0.0212</option>
                        <option selected value="0.0197">0.0197</option>
                        @else
                        <option selected value="">Select</option>
                        <option value="0.0236">0.0236</option>
                        <option value="0.0212">0.0212</option>
                        <option value="0.0197">0.0197</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price Unit</label>
                    <input type="text" class="form-control" name="price_per_unit" value="{{ $product->price_per_unit }}"  id="validationCustom01" >
                    @if($errors->has('price_per_unit'))
                        <span class="text-danger ">{{ $errors->first('price_per_unit') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price Per Quantity</label>
                    <select class="form-select" id="validationDefault04" name="price_per_quantity">
                        @if($product->price_per_quantity == '5,000-50,000')
                        <option value="">Select</option>
                        <option selected value="5,000-50,000">5,000-50,000</option>
                        <option value="50,000-100,000">50,000-100,000</option>
                        <option value="200,000-">200,000-</option>
                        @elseif($product->price_per_quantity == '50,000-100,000')
                        <option value="">Select</option>
                        <option value="5,000-50,000">5,000-50,000</option>
                        <option selected value="50,000-100,000">50,000-100,000</option>
                        <option value="200,000-">200,000-</option>
                        @elseif($product->price_per_quantity == '200,000-')
                        <option value="">Select</option>
                        <option value="5,000-50,000">5,000-50,000</option>
                        <option value="50,000-100,000">50,000-100,000</option>
                        <option selected value="200,000-">200,000-</option>
                        @else
                        <option selected value="">Select</option>
                        <option value="5,000-50,000">5,000-50,000</option>
                        <option value="50,000-100,000">50,000-100,000</option>
                        <option value="200,000-">200,000-</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Price Quantity Unit</label>
                    <input type="text" class="form-control" name="price_quantity_unit" id="validationCustom01" value="{{ $product->price_quantity_unit }}">
                </div>
            </div>
            <div class="row mt-2">
                <label for="validationCustom01" class="form-label">CTN size(cm)</label>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Length</label>
                    <input type="text" class="form-control" name="ctn_length" value="{{ $product->ctn_length }}"  id="validationCustom01" >
                    @if($errors->has('ctn_length'))
                        <span class="text-danger ">{{ $errors->first('ctn_length') }}</span>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Height</label>
                    <input type="text" class="form-control" name="ctn_height" value="{{ $product->ctn_height }}"  id="validationCustom01" >
                    @if($errors->has('ctn_height'))
                        <span class="text-danger ">{{ $errors->first('ctn_height') }}</span>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">width</label>
                    <input type="text" class="form-control" name="ctn_width" value="{{ $product->ctn_width }}"  id="validationCustom01" >
                    @if($errors->has('ctn_width'))
                        <span class="text-danger ">{{ $errors->first('ctn_width') }}</span>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">G.W.(kgs)</label>
                    <input type="text" class="form-control" name="g_w" value="{{ $product->g_w }}"  id="validationCustom01" >
                    @if($errors->has('g_w'))
                        <span class="text-danger ">{{ $errors->first('g_w') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-2">
                <label for="validationCustom01" class="form-label">Package/CTN</label>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Inner pack</label>
                    <input type="text" class="form-control" name="inner_pack_qty" value="{{ $product->inner_pack_qty }}"  id="validationCustom01" >
                    @if($errors->has('inner_pack_qty'))
                        <span class="text-danger ">{{ $errors->first('inner_pack_qty') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Inner pack unit</label>
                    <input type="text" class="form-control" name="inner_pack_unit" value="{{ $product->inner_pack_unit }}"  id="validationCustom01" >
                    @if($errors->has('inner_pack_unit'))
                        <span class="text-danger ">{{ $errors->first('inner_pack_unit') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Mid pack</label>
                    <input type="text" class="form-control" name="mid_pack_qty" value="{{ $product->mid_pack_qty }}"  id="validationCustom01" >
                    @if($errors->has('mid_pack_qty'))
                        <span class="text-danger ">{{ $errors->first('mid_pack_qty') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Mid pack unit</label>
                    <input type="text" class="form-control" name="mid_pack_unit" value="{{ $product->mid_pack_unit }}"  id="validationCustom01" >
                    @if($errors->has('mid_pack_unit'))
                        <span class="text-danger ">{{ $errors->first('mid_pack_unit') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Big pack</label>
                    <input type="text" class="form-control" name="big_pack_qty" value="{{ $product->big_pack_qty }}"  id="validationCustom01" value="1">
                    @if($errors->has('big_pack_qty'))
                        <span class="text-danger ">{{ $errors->first('big_pack_qty') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Big pack unit</label>
                    <input type="text" class="form-control" name="big_pack_unit" value="{{ $product->big_pack_unit }}"  id="validationCustom01" value="pcs">
                    @if($errors->has('big_pack_unit'))
                        <span class="text-danger ">{{ $errors->first('big_pack_unit') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">MOQ</label>
                    <input type="text" class="form-control" name="moq" value="{{ $product->moq }}"  id="validationCustom01" >
                    @if($errors->has('moq'))
                        <span class="text-danger ">{{ $errors->first('moq') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">MOQ unit</label>
                    <input type="text" class="form-control" name="moq_unit" value="{{ $product->moq_unit }}"  id="validationCustom01" >
                    @if($errors->has('moq_unit'))
                        <span class="text-danger ">{{ $errors->first('moq_unit') }}</span>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">HS code</label>
                    <input type="text" class="form-control" name="hs_code" value="{{ $product->hs_code }}"  id="validationCustom01" >
                    @if($errors->has('hs_code'))
                        <span class="text-danger ">{{ $errors->first('hs_code') }}</span>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">Material Grade</label>
                    <input type="text" class="form-control" name="material_grade" value="{{ $product->material_grade }}"  id="validationCustom01" >
                    @if($errors->has('material_grade'))
                        <span class="text-danger ">{{ $errors->first('material_grade') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-8">
                    <label for="validationCustom01" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5">{{ $product->description }}</textarea>
                    @if($errors->has('big_pack_unit'))
                        <span class="text-danger ">{{ $errors->first('big_pack_unit') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-1">
                <label for="validationCustom01" class="form-label">Images</label>
                <div class="hdtuto lst increment mb-3 col-6 d-flex">
                    <input type="file" name="image[]" class="myfrm form-control" multiple>
                </div>
                @if($errors->has('image'))
                    <span class="text-danger pl-3">{{ $errors->first('image') }}</span>
                @endif
                <br>
            </div>
            <section id="gallery" class="mr-3 mt-3">
                <div>
                   <div id="image-gallery">
                      <div class="row" id="product_gallery">
                        @foreach($product->multipleImage as $image)
                        <?php 
                            $file_type = mime_content_type('products/'.$image->image);
                            $file_ext = explode('/', $file_type)[1];
                        ?>
                        @if($file_ext == 'mp4')
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                            <div class="img-wrapper img-edit">
                                <video height="111px" controls>
                                    <source src="{{URL::asset('products/'.$image->image)}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="img-overlay">
                                <a href="javascript:void(0)" onclick="galleryImageDelete({{ $image->id }},{{ $image->product_id }})"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                            <div class="img-wrapper img-edit">
                                <img src="{{ url('products/'.$image->image) }}" class="img-responsive">
                                <div class="img-overlay">
                                <a href="javascript:void(0)" onclick="galleryImageDelete({{ $image->id }},{{ $image->product_id }})"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                      </div>
                   </div>
                </div>
            </section>
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </div>
</div>

@endsection