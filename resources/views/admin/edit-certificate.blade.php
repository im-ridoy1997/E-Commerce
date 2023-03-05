@extends('admin.layout')
@section('page_title','Edit Certificate')
@section('faq_active','active')
@section('content')
<div class="card aos-init aos-animate mt-4"  data-aos="fade-up" data-aos-delay="800">
    <div class="card-header d-flex justify-content-between" style="background-color: #e9e9e9;">
        <h4>Certificate Form</h4>
        <div style="margin-top: -13px;">
            <a href="{{ url('admin/faq') }}"><button class="btn btn-danger">Back</button></a>
        </div>
    </div>
    <div class="card-body">
    <div class="example">
        <form method="post" action="{{ url('admin/certificate/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" id="name" value="{{ $certificate->name }}" class="myfrm form-control">
            </div>
            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Pdf</label>
                <input type="file" name="pdf" id="pdf" class="myfrm form-control">
            </div>
            <input type="hidden" name="id" value="{{ $certificate->id }}">
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </form>
    </div>
    </div>
</div>
@endsection