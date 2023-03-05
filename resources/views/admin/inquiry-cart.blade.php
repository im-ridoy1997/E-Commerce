@extends('admin.layout')
@section('page_title','Inquiry Cart')
@section('cart_active','active')
@section('content')

<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card">
        <div class="card-header" style="background-color: #e9e9e9;">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title">Inquiry Cart</h4>
                </div>
                <div>
                    Search: <input type="text" id="searchbox">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="memberCategoryTable">
                <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Year of <br>Establishment</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart as $val)
                    <tr>
                        <td>{{ $val->company_name }}</td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->country }}</td>
                        <td>{{ $val->year }}</td>
                        <td>
                            <a href="{{ url('admin/inquiry-cart-view/'. $val->id) }}" title="Delete" class="btn btn-success actbtn">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    <div class="card mt-20" id="record" style="display: none;">
        
    </div>
</div>
@endsection


@section('js')
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        var dataTable = $('#memberCategoryTable').DataTable({
            "ordering": false,
            "lengthChange": false,
            "bInfo": false,
            pageLength: 12,
        });
        $("#searchbox").on("keyup search input paste cut", function() {
            dataTable.search(this.value).draw();
        }); 
    } );
</script>
@endsection