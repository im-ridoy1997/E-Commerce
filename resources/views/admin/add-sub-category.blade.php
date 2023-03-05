@extends('admin.layout')
@section('page_title','Add Sub-Category')
@section('category_active','active')
@section('content')
<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card-header d-flex justify-content-between" style="background-color: #e9e9e9;">
        <h4>Sub-Category Form</h4>
        <div style="margin-top: -13px;">
            <a href="{{ url('admin/sub-category/'.$id) }}"><button class="btn btn-danger">Back</button></a>
        </div>
    </div>
    <div class="card-body">
    <div class="example">
        <form method="post" action="" id="addSubCategory">
            @csrf
            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <span class="text-danger " id="category_name_error"></span>
            </div>
            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Sr no</label>
                <input type="text" name="cat_sku" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <span class="text-danger " id="cat_sku_error"></span>
            </div>
            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Authorize</label>
                <select class="form-select" id="validationDefault04" name="category_authorize">
                    <option selected value="all">All</option>
                    <option value="specific">Level C</option>
                </select>
            </div>
            <input type="hidden" name="id" value="{{ $id }}">
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </form>
    </div>
    </div>
</div>
@endsection