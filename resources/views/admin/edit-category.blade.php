@extends('admin.layout')
@section('page_title','Edit Category')
@section('category_active','active')
@section('content')
<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card-header d-flex justify-content-between" style="background-color: #e9e9e9;">
        <h4>Edit Category</h4>
        <div style="margin-top: -13px;">
            <a href="{{ url('admin/category') }}"><button class="btn btn-danger">Back</button></a>
        </div>
    </div>
    <div class="card-body">
        <div class="example">
            <form method="post" action="{{ url('admin/category/update') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 col-6">
                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                    <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @if($errors->has('category_name'))
                        <span class="text-danger ">{{ $errors->first('category_name') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleInputEmail1" class="form-label">Sr no</label>
                    <input type="text" name="cat_sku" value="{{ $category->cat_sku }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @if($errors->has('cat_sku'))
                        <span class="text-danger ">{{ $errors->first('cat_sku') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleInputEmail1" class="form-label">Authorize</label>
                    <select class="form-select" id="validationDefault04" name="category_authorize">
                        @if($category->category_authorize == 'all')
                        <option selected value="all">All</option>
                        <option  value="specific">Level C</option>
                        @elseif($category->category_authorize == 'specific')
                        <option selected value="specific">Level C</option>
                        <option value="all">All</option>
                        @endif
                    </select>
                </div>
                <input type="hidden" name="id" value="{{ $category->id }}">
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection