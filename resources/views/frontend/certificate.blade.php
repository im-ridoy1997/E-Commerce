@extends('frontend.layout')
@section('page_title','Certificates')
@section('content')

 <!-- Page Title -->
 <!-- <div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>Certificates</h2>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <span>certificates</span>
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

<!-- Banner -->
<div class="banner-area-two">
    <div class="banner-slider owl-theme owl-carousel">
        
        @foreach($slider as $val)
        <div class="banner-item">
            
            <div class="first-img banner-img">
                <img src="{{ url('products/'.$val->image) }}" alt="Banner">
            </div>
            
            <!-- <div class="banner-img">
                <img src="{{ asset('frontend/images/banner/banner1.png') }}" alt="Banner">
            </div> -->
        </div>
        @endforeach

    </div>
</div>
<!-- End Banner -->

<!-- Rules -->

<div class="rules-area ptb-100">
    <div class="container">
        <h4>{{ GoogleTranslate::trans('Home -> About Us -> Certificate', app()->getLocale()) }}</h4>
        <table class="table table-bordered table-striped mt-2" id="certificate">
            <thead>
                <tr>
                    <th>{{ GoogleTranslate::trans('No', app()->getLocale()) }}</th>
                    <th>{{ GoogleTranslate::trans('Certificates', app()->getLocale()) }}</th>
                    <th>{{ GoogleTranslate::trans('Click', app()->getLocale()) }}</th>
                    <th>{{ GoogleTranslate::trans('Certificate Name', app()->getLocale()) }}</th>
                    <th>{{ GoogleTranslate::trans('Certificate', app()->getLocale()) }}</th>
                    <th>{{ GoogleTranslate::trans('Certificate Date', app()->getLocale()) }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($certificate as $val)
                <tr>
                    <td>{{ $val->id }}</td>
                    <td><a href="{{ asset('products/' . $val->pdf) }}" target="_blank"><i class="fa-solid fa-file-pdf fa-2x" style="color: #f53434;"></i></a></td>
                    <td>{{ $val->click }}</td>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->certificate }}</td>
                    <td>{{ $val->certificate_date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- End Rules -->

@endsection

@section('js')
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        var dataTable = $('#certificate').DataTable({
            "lengthChange": false,
            "bInfo": false,
            pageLength: 6,
            dom: 'Bfltip',
        });
    } );
</script>
@endsection