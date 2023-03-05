@extends('admin.layout')
@section('page_title','Inquiry')
@section('faq_active','active')
@section('content')

<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card">
        <div class="card-header" style="background-color: #e9e9e9;">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title btn" style="background: #e911e9 !important;">Faq</h4>
                </div>
                <div>
                    <h4 class="card-title btn" style="background: #e911e9 !important;">About Us</h4>
                </div>
                <div>
                    <h4 class="card-title btn" style="background: #e911e9 !important;">Certificates</h4>
                </div>
                <div>
                    <h4 class="card-title btn" style="background: #e911e9 !important;">Contact Us</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="faq">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ url('admin/faq/add') }}"><button class="btn btn-primary">Add Faq</button></a>
                    </div>
                    <div>
                        Search: <input type="text" id="searchbox">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="adminFaqTable">
                        <thead>
                        <tr>
                            <th>Sr no.</th>
                            <th>question</th>
                            <th>answer</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($faq as $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($val->question, 50, $end='...') }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($val->answer, 70, $end='...') }}</td>
                                <td>
                                    <a href="{{ url('admin/faq/edit/'.$val->id) }}" class="btn btn-warning actbtn" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="{{ url('admin/faq/delete/'.$val->id) }}" class="btn btn-danger actbtn" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
                        <h5>About Us</h5>
                    </div>
                    <div class="mt-3">
                        <a href="{{ url('admin/about/edit/'.$about->id) }}"><button class="btn btn-primary">Edit About Us</button></a>
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
                                <td style="white-space:pre-wrap; word-wrap:break-word">{{ $about->text }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-20">
        <div class="card-body">
            <div class="faq">
                <div>
                    <h5>About Us-Certificate</h5>
                    <div class="mt-3">
                        <a href="{{ url('admin/certificate/add') }}"><button class="btn btn-primary">Add Certificate</button></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="certificate">
                        <thead>
                        <tr>
                            <!-- <th></th> -->
                            <th>No</th>
                            <th>Certificates</th>
                            <th>Click</th>
                            <th>Certificate Name</th>
                            <th>Certificate</th>
                            <th>Certificate Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($certificate as $val)
                            <tr>
                                <!-- <td>
                                    <input class="certificate-toggle-class" data-id="{{ $val->id }}" {{ $val->is_deleted ? '' : 'checked' }} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                </td> -->
                                <td>{{ $val->id }}</td>
                                <td><a href="{{ asset('products/' . $val->pdf) }}" target="_blank"><i class="fa-solid fa-file-pdf fa-2x" style="color: #f53434;"></i></a></td>
                                <td>{{ $val->click }}</td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->certificate }}</td>
                                <td>{{ $val->certificate_date }}</td>
                                
                                <td>
                                    <a href="{{ url('admin/certificate/edit/'.$val->id) }}" class="btn btn-warning actbtn" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="{{ url('admin/certificate/delete/'.$val->id) }}" class="btn btn-danger actbtn" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
            <div class="faq">
                <div>
                    <h5>Contact Us</h5>
                    <div class="mt-3">
                        <a href="{{ url('admin/contact/add') }}"><button class="btn btn-primary">Add Contact-us</button></a>
                    </div>
                </div>
                <div class="table-responsive" id="">
                    <table class="table table-bordered table-striped" id="adminContactTable" >
                        <thead>
                        <tr>
                            <!-- <th></th> -->
                            <th>Sr no.</th>
                            <th>name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contact as $val)
                            <tr>
                                <!-- <td>
                                    <input class="contact-toggle-class" data-id="{{ $val->id }}" {{ $val->is_deleted ? '' : 'checked' }} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                </td> -->
                                <td>{{ $val->id }}</td>
                                <td style="white-space:pre-wrap; word-wrap:break-word">{{ $val->name }}</td>
                                <td>
                                    <a href="{{ url('admin/contact/edit/'.$val->id) }}" class="btn btn-warning actbtn" title="Edit"><i class="fas fa-edit"></i></a>
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
        var dataTable = $('#adminFaqTable').DataTable({
            "lengthChange": false,
            "bInfo": false,
            pageLength: 12,
        });
        $("#searchbox").on("keyup search input paste cut", function() {
            dataTable.search(this.value).draw();
        });
    } );

    $(document).ready( function () {
        var dataTable = $('#adminContactTable').DataTable({
            "lengthChange": false,
            "bInfo": false,
            pageLength: 12,
        });
        // $("#searchbox").on("keyup search input paste cut", function() {
        //     dataTable.search(this.value).draw();
        // });
    } );
    $(document).ready( function () {
        var dataTable = $('#certificate').DataTable({
            "lengthChange": false,
            "bInfo": false,
            pageLength: 6,
        });
        // $("#searchbox").on("keyup search input paste cut", function() {
        //     dataTable.search(this.value).draw();
        // });
    } );
</script>
@endsection