@extends('frontend.layout')
@section('page_title','Index')
@section('content')


<!-- Video -->
<div class="video-area">
    <div class="container-fluid">
        <div class="row">

            <!-- <div class="col-sm-3 col-lg-2">
                <div class="video-left">
                    <form>

                        <div class="form-group">
                            <div class="dropdown">
                                <button class="btn btn-video-left dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="flaticon-carrot icon"></i>
                                    Vegetable
                                    <i class='bx bx-chevron-down icon-two'></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <li>
                                        <a class="dropdown-item" href="#">Seasonal vegetable</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Leafy vegetable</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Stem vegetable</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="dropdown">
                                <button class="btn btn-video-left dropdown-toggle" type="button" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="flaticon-apple icon"></i>
                                    Fruits
                                    <i class='bx bx-chevron-down icon-two'></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                    <li>
                                        <a class="dropdown-item" href="#">Action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="dropdown">
                                <button class="btn btn-video-left dropdown-toggle" type="button" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="flaticon-meat icon"></i>
                                    Chicken
                                    <i class='bx bx-chevron-down icon-two'></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
                                    <li>
                                        <a class="dropdown-item" href="#">Action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="dropdown">
                                <button class="btn btn-video-left dropdown-toggle" type="button" id="dropdownMenu5" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="flaticon-meat-1 icon"></i>
                                    Meat
                                    <i class='bx bx-chevron-down icon-two'></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu5">
                                    <li>
                                        <a class="dropdown-item" href="#">Action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="dropdown">
                                <button class="btn btn-video-left dropdown-toggle" type="button" id="dropdownMenu6" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="flaticon-fish icon"></i>
                                    Fish
                                    <i class='bx bx-chevron-down icon-two'></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu6">
                                    <li>
                                        <a class="dropdown-item" href="#">Action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="dropdown">
                                <button class="btn btn-video-left dropdown-toggle" type="button" id="dropdownMenu7" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="flaticon-milk icon"></i>
                                    Milk
                                    <i class='bx bx-chevron-down icon-two'></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu7">
                                    <li>
                                        <a class="dropdown-item" href="#">Action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="dropdown">
                                <button class="btn btn-video-left dropdown-toggle" type="button" id="dropdownMenu8" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="flaticon-breakfast icon"></i>
                                    Breakfast
                                    <i class='bx bx-chevron-down icon-two'></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu8">
                                    <li>
                                        <a class="dropdown-item" href="#">Action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="dropdown">
                                <button class="btn btn-video-left dropdown-toggle" type="button" id="dropdownMenu9" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="flaticon-eggs icon"></i>
                                    Egg
                                    <i class='bx bx-chevron-down icon-two'></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu9">
                                    <li>
                                        <a class="dropdown-item" href="#">Action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </form>
                </div>
            </div> -->

            <div class="col-sm-12 col-lg-12">
                <div class="video-slider owl-theme owl-carousel">
                @foreach($slider as $val)
                    <div class="video-item video-bg-two">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="inner-two">
                                    <h2>Buy All Things From One Place</h2>
                                    <a class="common-btn three" href="{{ url('/shop') }}">
                                        Shop Now
                                        <img src="{ asset('frontend/assets/images/shape1.png') }}" alt="Shape">
                                        <img src="{ asset('frontend/assets/images/shape2.png') }}" alt="Shape">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="products-area container three pb-100">
                    <div class="row">
                        <div style="display: flex; justify-content: flex-end;">
                        {{ $products->links("pagination::bootstrap-4") }}
                        </div>
                        
                        <div class="col-lg-12">
                            <div id="Container" class="row justify-content-center">
                                @foreach($products as $product)
                                    @if($product->image != null)
                                        <?php 
                                            $file_type = mime_content_type('products/'.$product->image->image);
                                            $file_ext = explode('/', $file_type)[1];
                                        ?>
                                        @if($file_ext == 'mp4')
                                        <div class="col-sm-6 col-lg-3 mix {{ str_replace(' ','_',$product->categoryName->category_name); }} center-table">
                                            <div class="products-item">
                                                <div class="top">
                                                    <!-- <a class="wishlist" href="javascript:void(0)" onclick="addToCart('{{ $product->id }}')">
                                                        <i class='bx bx-plus'></i>
                                                    </a> -->
                                                    <video height="100px" controls>
                                                        <source src="{{URL::asset('products/'.$product->image->image)}}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    <div class="inner mt-2">
                                                        <h3><a href="{{ url('/single-product/'.$product->id ) }}" onclick="clickAddForProduct('{{ $product->id }}')">{{ $product->sku }}</a></h3>
                                                        <h3>
                                                            <a href="{{ url('/single-product/'.$product->id ) }}" onclick="clickAddForProduct('{{ $product->id }}')">{{ $product->name }}</a>
                                                        </h3>
                                                        <span>
                                                        @if(Auth::guard('member')->user())
                                                            @if($product->price)
                                                                {{ $product->currency }} {{ $product->price}} {{ $product->price_per_unit}}
                                                            @else
                                                            @endif
                                                        @else
                                                        @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="bottom">
                                                    <a class="cart-text" href="javascript:void(0)" onclick="addToCart('{{ $val->id }}')">Add in inquiry cart</a>
                                                    <i class='bx bx-plus'></i>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-6 col-lg-3 mix {{ str_replace(' ','_',$product->categoryName->category_name); }} center-table">
                                            <div class="products-item">
                                                <div class="top">
                                                    <!-- <a class="wishlist" href="javascript:void(0)" onclick="addToCart('{{ $product->id }}')">
                                                        <i class='bx bx-plus'></i>
                                                    </a> -->
                                                    <img style="height: 100px !important;" src="{{ url('products/'.$product->image->image) }}" alt="Products">
                                                    <div class="inner mt-2">
                                                        <h3><a href="{{ url('/single-product/'.$product->id ) }}" onclick="clickAddForProduct('{{ $product->id }}')">{{ $product->sku }}</a></h3>
                                                        <h3>
                                                            <a href="{{ url('/single-product/'.$product->id ) }}" onclick="clickAddForProduct('{{ $product->id }}')">{{ $product->name }}</a>
                                                        </h3>
                                                        <span>
                                                        @if(Auth::guard('member')->user())
                                                            @if($product->price)
                                                            {{ $product->currency }} {{ $product->price}} {{ $product->price_per_unit}}
                                                            @else
                                                            @endif
                                                        @else
                                                        @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="bottom">
                                                    <a class="cart-text" href="javascript:void(0)" onclick="addToCart('{{ $val->id }}')">Add in inquiry cart</a>
                                                    <i class='bx bx-plus'></i>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        <div class="col-sm-6 col-lg-3 mix {{ str_replace(' ','_',$product->categoryName->category_name); }} center-table">
                                            <div class="products-item">
                                                <div class="top">
                                                    <!-- <a class="wishlist" href="javascript:void(0)" onclick="addToCart('{{ $product->id }}')">
                                                        <i class='bx bx-plus'></i>
                                                    </a> -->
                                                    <img style="height: 100px !important;" src="{{ url('products/') }}" alt="Products">
                                                    <div class="inner mt-2">
                                                        <h3><a href="{{ url('/single-product/'.$product->id ) }}" onclick="clickAddForProduct('{{ $product->id }}')">{{ $product->sku }}</a></h3>
                                                        <h3>
                                                            <a href="{{ url('/single-product/'.$product->id ) }}" onclick="clickAddForProduct('{{ $product->id }}')">{{ $product->name }}</a>
                                                        </h3>
                                                        <span>
                                                        @if(Auth::guard('member')->user())
                                                            @if($product->price)
                                                            {{ $product->currency }} {{ $product->price}} {{ $product->price_per_unit}}
                                                            @else
                                                            @endif
                                                        @else
                                                        @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="bottom">
                                                    <a class="cart-text" href="javascript:void(0)" onclick="addToCart('{{ $val->id }}')">Add in inquiry cart</a>
                                                    <i class='bx bx-plus'></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
    
                    <div class="text-center">
                        <a class="common-btn three" href="{{ url('/shop') }}">
                            Load More Products
                            <img src="assets/images/shape1.png" alt="Shape">
                            <img src="assets/images/shape2.png" alt="Shape">
                        </a>
                    </div>
    
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Video -->








@endsection