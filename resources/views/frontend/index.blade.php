@extends('frontend.layout')
@section('page_title','Index')
@section('content')


<!-- Video -->
<div class="video-area">
    <div class="container-fluid">
        <div class="row">

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
                                                <a class="wishlist" href="#">
                                                    <i class='bx bx-heart'></i>
                                                </a>
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
                                                    <i class='bx bx-plus' style="color: #434E6E !important;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-6 col-lg-3 mix {{ str_replace(' ','_',$product->categoryName->category_name); }} center-table">
                                            <div class="products-item">
                                                <div class="top">
                                                <a class="wishlist" href="#">
                                                    <i class='bx bx-heart'></i>
                                                </a>
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
                                                    <i class='bx bx-plus' style="color: #434E6E !important;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        <div class="col-sm-6 col-lg-3 mix {{ str_replace(' ','_',$product->categoryName->category_name); }} center-table">
                                            <div class="products-item">
                                                <div class="top">
                                                    <a class="wishlist" href="#">
                                                        <i class='bx bx-heart'></i>
                                                    </a>
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
                                                    <i class='bx bx-plus' style="color: #434E6E !important;"></i>
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