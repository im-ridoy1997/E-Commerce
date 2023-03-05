@extends('frontend.layout')
@section('page_title','Privacy Policy')
@section('content')

 <!-- Page Title -->
 <!-- <div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>Privacy Policy</h2>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <span>Privacy Policy</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="title-img">
        <img src="{{ asset('frontend/images/page-title1.jpg') }}" alt="About">
        <img src="{{ asset('frontend/images/shape16.png') }}" alt="Shape">
        <img src="{{ asset('frontend/images/shape17.png') }}" alt="Shape">
        <img src="{{ asset('frontend/images/shape18.png') }}" alt="Shape">
    </div>
</div> -->
<!-- End Page Title -->

<!-- Rules -->
<div class="rules-area ptb-100">
    <div class="container">
        <div style="text-align: center; margin-top: 20px;">
            <h3>{{ GoogleTranslate::trans('Privacy Policy:', app()->getLocale()) }}</h3>
        </div>
        <div class="rules-item mt-5" style="white-space:pre-wrap; word-wrap:break-word">
            {{ $privacy->name }}
        </div>

    </div>
</div>
<!-- End Rules -->

@endsection