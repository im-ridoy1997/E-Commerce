@extends('admin.layout')
@section('page_title','Category')
@section('category_active','active')
@section('content')

<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card">
        <div class="card-header" style="background-color: #e9e9e9;">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title">Category</h4>
                </div>
                <div>
                    Search: <input type="text" id="searchbox">
                </div>
                <div style="margin-top: -13px;">
                    <a href="{{ url('admin/category/add') }}"><button class="btn btn-primary">Add Category</button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="adminCategoryTable">
                <thead>
                <tr>
                    <th>Sr no.</th>
                    <th>Categories</th>
                    <th>Authorize</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $val)
                    <tr>
                        <td>{{ $val->cat_sku }}</td>
                        <td>{{ $val->category_name }}</td>
                        <td>
                            @if($val->category_authorize == 'specific')
                            {{ "Level C" }}
                            @else
                            {{ $val->category_authorize }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/sub-category/'.$val->id) }}" class="btn btn-secondary actbtn add-sub-category-btn" title="Add Sub-category"><i class="far fa-plus-square"></i></a>
                            <a href="{{ url('admin/category/edit/'.$val->id) }}" class="btn btn-warning actbtn" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="{{ url('admin/category/delete/'.$val->id) }}" class="btn btn-danger actbtn" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
        var dataTable = $('#adminCategoryTable').DataTable({
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