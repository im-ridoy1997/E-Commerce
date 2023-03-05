@extends('admin.layout')
@section('page_title','Edit Sitemap')
@section('slider_active','active')
@section('content')
<div class="card aos-init aos-animate mt-4"  data-aos="fade-up" data-aos-delay="800">
    <div class="card-header d-flex justify-content-between" style="background-color: #e9e9e9;">
        <h4>Sitemap Form</h4>
        <div style="margin-top: -13px;">
            <a href="{{ url('admin/slider') }}"><button class="btn btn-danger">Back</button></a>
        </div>
    </div>
    <div class="card-body">
    <div class="example">
        <form method="post" action="{{ url('admin/sitemap/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Link</label>
                <input type="text" name="link" id="link" value="{{ $sitemap->link }}" class="myfrm form-control">
            </div>
            <input type="hidden" name="id" value="{{ $sitemap->id }}">
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </form>
    </div>
    </div>
</div>
@endsection