@extends('admin.layout')
@section('page_title','Sub-Category')
@section('category_active','active')
@section('content')
{{ request()->get('id') }}
<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card">
        <div class="card-header d-flex justify-content-between" style="background-color: #e9e9e9;">
            <div>
                <h4 class="card-title">Sub-Category</h4>
            </div>
            <div>
                Search: <input type="text" id="searchbox">
            </div>
            <div style="margin-top: -13px;">
                <a href="{{ url('admin/sub-category/add/'.$id) }}"><button class="btn btn-primary">Add Sub-Category</button></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table" id="adminCategoryTable">
                <thead>
                <tr>
                    <th>Sr no.</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Authorize</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sub_category as $val)
                    <tr>
                        <td>{{ $val->cat_sku }}</td>
                        <td>{{ $main_category }}</td>
                        <td>{{ $val->category_name }}</td>
                        <td>
                            @if($val->category_authorize == 'specific')
                            {{ "Level C" }}
                            @else
                            {{ $val->category_authorize }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/sub-category/edit/'.$val->id) }}" class="btn btn-warning actbtn" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="{{ url('admin/sub-category/delete/'.$val->id.'/'.$val->parent_id) }}" class="btn btn-danger actbtn" title="Delete"><i class="fas fa-trash-alt"></i></a>
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