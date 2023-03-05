@extends('admin.layout')
@section('page_title','Edit About')
@section('faq_active','active')
@section('content')
<div class="card aos-init aos-animate mt-4"  data-aos="fade-up" data-aos-delay="800">
    <div class="card-header d-flex justify-content-between" style="background-color: #e9e9e9;">
        <h4>Privacy Form</h4>
        <div style="margin-top: -13px;">
            <a href="{{ url('admin/faq') }}"><button class="btn btn-danger">Back</button></a>
        </div>
    </div>
    <div class="card-body">
    <div class="example">
        <form method="post" action="{{ url('admin/about/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Text</label>
                <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="8">{{ $about->text }}</textarea>
            </div>
            <input type="hidden" name="id" value="{{ $about->id }}">
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </form>
    </div>
    </div>
</div>
@endsection