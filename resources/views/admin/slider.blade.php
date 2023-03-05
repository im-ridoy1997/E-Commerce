@extends('admin.layout')
@section('page_title','Slider')
@section('slider_active','active')
@section('content')

<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card mt-20">
        <div class="card-header" style="background-color: #e9e9e9;">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title btn" style="background: #e911e9 !important;">Sliders</h4>
                </div>
                <div>
                    <h4 class="card-title btn" style="background: #e911e9 !important;">Privacy Policy</h4>
                </div>
                <div>
                    <h4 class="card-title btn" style="background: #e911e9 !important;">Sitemap</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="Slider">
                <div>
                    <div>
                        <h5>Slider</h5>
                    </div>
                    <div class="mt-3">
                        <a href="{{ url('admin/slider/add') }}"><button class="btn btn-primary">Add Slider</button></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="adminSliderTable" style="width: 60% !important;">
                        <thead>
                        <tr>
                            <th>Sr no.</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($slider as $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td><img style="height: 40px;" src="{{ url('products/'.$val->image) }}"/></td>
                                <td>
                                    <a href="{{ url('admin/slider/edit/'.$val->id) }}" class="btn btn-warning actbtn" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="{{ url('admin/slider/delete/'.$val->id) }}" class="btn btn-danger actbtn" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-20">
        <div class="card-body">
            <div class="Slider">
                <div >
                    <div>
                        <h5>Privacy Policy</h5>
                    </div>
                    <div class="mt-3">
                        <a href="{{ url('admin/privacy/edit/'.$privacy->id) }}"><button class="btn btn-primary">Edit Privacy Policy</button></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="" style="width: 60% !important;">
                        <thead>
                        <tr>
                            <th>Text</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="white-space:pre-wrap; word-wrap:break-word">{{ $privacy->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-20">
        <div class="card-body">
            <div class="Slider">
                <div>
                    <div>
                        <h5>Site map</h5>
                    </div>
                    <div class="mt-3">
                        <a href="{{ url('admin/sitemap/add') }}"><button class="btn btn-primary">Add Site Map</button></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="adminSitemapTable" style="width: 60% !important;">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($sitemap as $val)
                            <tr>
                                <td>
                                    <input class="sitemap-toggle-class" data-id="{{ $val->id }}" {{ $val->is_deleted ? '' : 'checked' }} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                </td>
                                <td>{{ $val->link }}</td>
                                <td>
                                    <a href="{{ url('admin/sitemap/edit/'.$val->id) }}" class="btn btn-warning actbtn" title="Edit"><i class="fas fa-edit"></i></a>
                                    <!-- <a href="{{ url('admin/contact/delete/'.$val->id) }}" class="btn btn-danger actbtn" title="Delete"><i class="fas fa-trash-alt"></i></a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        var dataTable = $('#adminSliderTable').DataTable({
            "lengthChange": false,
            "bInfo": false,
            pageLength: 12,
        });
    } );
    $(document).ready( function () {
        var dataTable = $('#adminSitemapTable').DataTable({
            "lengthChange": false,
            "bInfo": false,
            pageLength: 12,
        });
    } );
</script>
@endsection