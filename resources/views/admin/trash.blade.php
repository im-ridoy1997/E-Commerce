@extends('admin.layout')
@section('page_title','Trash')
@section('trash_active','active')
@section('content')

<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card">
        <!-- <div class="card-header" style="background-color: #e9e9e9;">
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
        </div> -->
        <div class="card-body">
            <div class="faq">
                <div class="d-flex justify-content-between">
                    <div>
                        <button class="btn btn-secondary">Category</button>
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="openTrashRecoverModel()">Recover</button>
                    </div>
                    <div>
                        <button class="btn btn-danger" onclick="openTrashDeleteModel()">Delete</button>
                    </div>
                    <div>
                        Search: <input type="text" id="categoryBox">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="adminCategoryTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="category_chk_all" class="category_chk_all"></th>
                                <th>Sr no.</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $val)
                            <tr>
                                <td>
                                    <input type="checkbox" name="category_id[]" value="{{ $val->id }}" class="category_chk_child" >
                                </td>
                                <td>{{ $val->cat_sku }}</td>
                                <td>{{ $val->category_name }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger actbtn" title="Delete" onclick="singleTrashCategoryDelete('{{$val->id}}')"><i class="fas fa-trash-alt"></i></a>
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
            <div class="product">
                <div class="d-flex justify-content-between">
                    <div>
                        <button class="btn btn-secondary">Product</button>
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="openTrashProductRecoverModel()">Recover</button>
                    </div>
                    <div>
                        <button class="btn btn-danger" onclick="openTrashProductDeleteModel()">Delete</button>
                    </div>
                    <div>
                        Search: <input type="text" id="productBox">
                    </div>
                </div>
                <div class="table-responsive mt-1">
                    <table class="table table-bordered table-striped" id="adminProductTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="product_chk_all" class="product_chk_all"></th>
                                <th>Sr no.</th>
                                <th>name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($product as $val)
                            <tr>
                                <td>
                                    <input type="checkbox" name="product_id[]" value="{{ $val->id }}" class="product_chk_child" >
                                </td>
                                <td>{{ $val->sku }}</td>
                                <td>{{ $val->name }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger actbtn" title="Delete" onclick="singleTrashProductDelete('{{$val->id}}')"><i class="fas fa-trash-alt"></i></a>
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
            <div class="member">
                <div class="d-flex justify-content-between">
                    <div>
                        <button class="btn btn-secondary">Registration</button>
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="openTrashMemberRecoverModel()">Recover</button>
                    </div>
                    <div>
                        <button class="btn btn-danger" onclick="openTrashMemberDeleteModel()">Delete</button>
                    </div>
                    <div>
                        Search: <input type="text" id="memberBox">
                    </div>
                </div>
                <div class="table-responsive mt-1">
                    <table class="table table-bordered table-striped" id="adminMemberTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="member_chk_all" class="member_chk_all"></th>
                                <th>Sr no.</th>
                                <th>name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($member as $val)
                            <tr>
                                <td>
                                    <input type="checkbox" name="member_id[]" value="{{ $val->id }}" class="member_chk_child" >
                                </td>
                                <td>{{ $val->id }}</td>
                                <td>{{ $val->name }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger actbtn" title="Delete" onclick="singleTrashMemberDelete('{{$val->id}}')"><i class="fas fa-trash-alt"></i></a>
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

<!-- Trash Category Recover Modal Start -->
<div class="modal fade" id="trashRecoverModal" tabindex="-1" aria-labelledby="trashRecoverModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trashRecoverModalLabel">Recover</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to recover?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" id="trash-recover-btn" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Trash Recover Modal End -->

<!-- Trash Category Delete Modal Start -->
<div class="modal fade" id="trashDeleteModal" tabindex="-1" aria-labelledby="trashDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trashDeleteModalLabel">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete permanently?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" id="trash-delete-btn" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Trash Category Delete Modal End -->

<!-- Trash Product Recover Modal Start -->
<div class="modal fade" id="trashProductRecoverModal" tabindex="-1" aria-labelledby="trashProductRecoverModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trashProductRecoverModalLabel">Recover</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to recover?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" id="trash-product-recover-btn" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Trash Recover Modal End -->

<!-- Trash Product Delete Modal Start -->
<div class="modal fade" id="trashProductDeleteModal" tabindex="-1" aria-labelledby="trashProductDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trashProductDeleteModalLabel">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete permanently?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" id="trash-product-delete-btn" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Trash Product Delete Modal End -->

<!-- Trash Member Recover Modal Start -->
<div class="modal fade" id="trashMemberRecoverModal" tabindex="-1" aria-labelledby="trashMemberRecoverModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trashMemberRecoverModalLabel">Recover</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to recover?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" id="trash-member-recover-btn" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Trash Recover Modal End -->

<!-- Trash Member Delete Modal Start -->
<div class="modal fade" id="trashMemberDeleteModal" tabindex="-1" aria-labelledby="trashMemberDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trashMemberDeleteModalLabel">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete permanently?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" id="trash-member-delete-btn" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Trash Member Delete Modal End -->

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
        $("#categoryBox").on("keyup search input paste cut", function() {
            dataTable.search(this.value).draw();
        });
    } );
    $(document).ready( function () {
        var dataTable = $('#adminProductTable').DataTable({
            "lengthChange": false,
            "bInfo": false,
            pageLength: 12,
        });
        $("#productBox").on("keyup search input paste cut", function() {
            dataTable.search(this.value).draw();
        });
    } );
    $(document).ready( function () {
        var dataTable = $('#adminMemberTable').DataTable({
            "lengthChange": false,
            "bInfo": false,
            pageLength: 12,
        });
        $("#memberBox").on("keyup search input paste cut", function() {
            dataTable.search(this.value).draw();
        });
    } );
</script>
@endsection