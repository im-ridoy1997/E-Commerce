@extends('frontend.layout')
@section('page_title','Inquiry/Request a quote')
@section('content')

<!-- Page Title -->
<!-- <div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>FAQ</h2>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <span>FAQ</span>
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

<!-- Customer Service -->
<div class="common-faq-area ptb-100">
    <div class="container">
        <div style="text-align: center; margin-top: 5px;">
            <h3>{{ GoogleTranslate::trans('FAQs:', app()->getLocale()) }}</h3>
        </div>
        <div class="section-title mt-5">
            <h2>{{ GoogleTranslate::trans('Get Answer Of Your Questions', app()->getLocale()) }}</h2>
        </div>
        <div class="faq-item">
            <ul class="accordion">
                @foreach($faq as $val)
                <li>
                    <h3 class="faq-head">{{ $val->question }}</h3>
                    <div class="faq-content">
                        <p>{{ $val->answer }}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
<!-- End Customer Service -->

@endsection