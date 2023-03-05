@extends('admin.layout')
@section('page_title','Product')
@section('product_active','active')
@section('content')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.2.1/css/fixedColumns.dataTables.min.css">

@endsection
<style>
  /* Ensure that the demo table scrolls */
  th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>
<div class="card aos-init aos-animate mt-4"  data-aos="fade-up" data-aos-delay="800">
  <div class="card-header" style="background-color: #e9e9e9;">
      <div class="d-flex justify-content-between" >
          <div>
              <h4 class="card-title">Product</h4>
          </div>
          <div>
            Search: <input type="text" id="searchbox">
          </div>
      </div>
      <br>
      <div class="d-flex justify-content-between" >
          <div style="margin-top: -13px;">
            <a class="btn btn-primary product-header-btn" href="javascript:void(0)" onclick="openAuthorizeModel()">Level C</a>
          </div>
          <div style="margin-top: -13px;">
            <a class="btn btn-danger product-header-btn" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</a>
          </div>
          <div style="margin-top: -13px;">
              <!-- <a href="javascript:void(0)"  class="btn btn-warning product-header-btn" onclick="showAllToLevelC()">Show all Level C</a> -->
              <a href="{{ url('admin/show-all-to-level-c') }}"  class="btn btn-warning product-header-btn">Show all Level C</a>
          </div>
          <div style="margin-top: -13px;">
              <a href="{{ url('admin/product/add') }}" data-bs-toggle="modal" data-bs-target="#batchUploadModal" class="btn btn-primary product-header-btn">Batch Upload</a>
          </div>
          <div style="margin-top: -13px;">
              <a href="{{ url('admin/product/export') }}" class="btn btn-secondary product-header-btn">Batch Download</a>
          </div>
          <div style="margin-top: -13px;">
              <a href="{{ url('admin/product/add') }}"><button class="btn btn-primary product-header-btn">Add Product</button></a>
          </div>
      </div>
  </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="adminProductTable table-bordered stripe row-border order-column" style="width:100%;border-color:#d9dee5;" id="adminProductTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chk_all" class="chk_all"></th>
                        <th>Click</th>
                        <th>Item No</th>
                        <th>Product <br>Name</th>
                        <th>Photo</th>
                        <th>Category</th>
                        <th>Sub <br>category</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Size <br>unit</th>
                        <th>Color</th>
                        <th>Material <br>Grade</th>
                        <th>Weight</th>
                        <th>Weight <br>unit</th>
                        <th>Package <br>/CTN</th>
                        <th>Quantity <br>/CTN</th>
                        <th>Quantity <br>unit</th>
                        <th>Cartoon <br>size</th>
                        <th>CBM <br>/CTN</th>
                        <th>G.W</th>
                        <th>MOQ</th>
                        <th>Moq <br>unit</th>
                        <th>HS <br>Code</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $val)
                      @if($val->product_authorize == 'specific')
                        <tr class="product-tbl">
                            <td>
                              <input type="checkbox" name="id[]" value="{{ $val->id }}" class="chk_child" >
                            </td>
                            <td class="product-authorize-color">
                              <a href="javascript:void(0)" class="btn btn-success btn-click actbtn" onclick="setValueForClickModal('{{$val->id}}')" data-bs-toggle="modal" data-bs-target="#clickModal" title="Make click value 0.">{{ $val->click }}</i></a>
                            </td>
                            <td class="product-authorize-color"><a style="color: orange !important;" href="{{ url('admin/product/edit/'.$val->id) }}">{{ $val->sku }}</a></td>
                            <td class="product-authorize-color" title="{{ $val->name }}">{{ \Illuminate\Support\Str::limit($val->name, 15, $end='...') }}</td>
                            <td class="img-td">
                              @if($val->image != null)
                                <?php 
                                  $file_type = mime_content_type('products/'.$val->image->image);
                                  $file_ext = explode('/', $file_type)[1];
                                ?>
                                @if($file_ext == 'mp4')
                                  <video width="60" height="50"  controls>
                                      <source src="{{URL::asset('products/'.$val->image->image)}}" type="video/mp4">
                                      Your browser does not support the video tag.
                                  </video>
                                @else
                                  <a target="_blank" href="{{ url('products/'.$val->image->image) }}">
                                    <img src="{{ url('products/'.$val->image->image) }}"/>
                                  </a>
                                @endif
                                @else
                                  <a >
                                    <img src=""/>
                                  </a>
                              @endif
                            </td>
                            <td class="product-authorize-color">{{ $val->categoryName->category_name }}</td>
                            <td class="product-authorize-color">{{ $val->subCategoryName->category_name }}</td>
                            <td class="product-authorize-color">
                              @if($val->price > 0)
                              {{ $val->currency }}<br>{{ $val->price }}<br>{{ $val->price_per_unit}}
                              @else
                              @endif
                            </td>
                            <td class="product-authorize-color">{{ $val->size }}</td>
                            <td class="product-authorize-color">{{ $val->size_unit }}</td>
                            <td class="product-authorize-color">{{ $val->color }}</td>
                            <td class="product-authorize-color">{{ $val->material_grade }}</td>
                            <td class="product-authorize-color">{{ $val->weight }}</td>
                            <td class="product-authorize-color">{{ $val->weight_unit }}</td>
                            <td class="product-authorize-color" style="display:flex;padding-top: 21px !important;">
                              @if($val->inner_pack_qty)
                              <p style="padding-right: 2px;">{{ $val->inner_pack_qty }}</p>
                              @endif
                              @if($val->inner_pack_unit)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->inner_pack_unit }}</p>
                              @endif
                              @if($val->mid_pack_qty)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->mid_pack_qty }}</p>
                              @endif
                              @if($val->mid_pack_unit)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->mid_pack_unit }}</p>
                              @endif
                              @if($val->big_pack_qty && $val->big_pack_qty > 1)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->big_pack_qty }}</p>
                              @endif
                              @if($val->big_pack_unit && $val->big_pack_qty > 1)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->big_pack_unit }}</p>
                              @endif
                            </td>
                            <td class="product-authorize-color">{{ $val->quantity_ctn }}</td>
                            <td class="product-authorize-color">{{ $val->quantity_unit }}</td>
                            <td class="product-authorize-color">{{ $val->ctn_length }}</td>
                            <td class="product-authorize-color">{{ $val->cbm_ctn }}</td>
                            <td class="product-authorize-color">{{ $val->g_w }} kgs</td>
                            <td class="product-authorize-color">{{ $val->moq }}</td>
                            <td class="product-authorize-color">{{ $val->moq_unit }}</td>
                            <td class="product-authorize-color">{{ $val->hs_code }}</td>
                            <td class="product-authorize-color" title="{{ $val->description }}">{{ \Illuminate\Support\Str::limit($val->description, 15, $end='...') }}</td>
                            
                        </tr>
                      @else
                        <tr class="product-tbl">
                            <td>
                              <input type="checkbox" name="id[]" value="{{ $val->id }}" class="chk_child" >
                            </td>
                            <td>
                              <a href="javascript:void(0)" class="btn btn-success btn-click actbtn" onclick="setValueForClickModal('{{$val->id}}')" data-bs-toggle="modal" data-bs-target="#clickModal" title="Make click value 0.">{{ $val->click }}</i></a>
                            </td>
                            <td><a href="{{ url('admin/product/edit/'.$val->id) }}">{{ $val->sku }}</a></td>
                            <td title="{{ $val->name }}">{{ \Illuminate\Support\Str::limit($val->name, 15, $end='...') }}</td>
                            <td class="img-td">
                              @if($val->image != null)
                              <?php 
                                $file_type = mime_content_type('products/'.$val->image->image);
                                $file_ext = explode('/', $file_type)[1];
                              ?>
                              @if($file_ext == 'mp4')
                                <video width="60" height="50"  controls>
                                    <source src="{{URL::asset('products/'.$val->image->image)}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                              @else
                                <a target="_blank" href="{{ url('products/'.$val->image->image) }}">
                                  <img src="{{ url('products/'.$val->image->image) }}"/>
                                </a>
                              @endif
                              @else
                                <a>
                                  <img src=""/>
                                </a>
                              @endif
                            </td>
                            <td>{{ $val->categoryName->category_name }}</td>
                            <td>{{ $val->subCategoryName->category_name }}</td>
                            <td>
                              @if($val->price > 0)
                              {{ $val->currency }}<br>{{ $val->price }}<br>{{ $val->price_per_unit}}
                              @else
                              @endif
                            </td>
                            <td>{{ $val->size }}</td>
                            <td>{{ $val->size_unit }}</td>
                            <td>{{ $val->color }}</td>
                            <td>{{ $val->material_grade }}</td>
                            <td>{{ $val->weight }}</td>
                            <td>{{ $val->weight_unit }}</td>
                            <td style="display:flex;padding-top: 21px !important;">
                              @if($val->inner_pack_qty)
                              <p style="padding-right: 2px;">{{ $val->inner_pack_qty }}</p>
                              @endif
                              @if($val->inner_pack_unit)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->inner_pack_unit }}</p>
                              @endif
                              @if($val->mid_pack_qty)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->mid_pack_qty }}</p>
                              @endif
                              @if($val->mid_pack_unit)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->mid_pack_unit }}</p>
                              @endif
                              @if($val->big_pack_qty && $val->big_pack_qty > 1)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->big_pack_qty }}</p>
                              @endif
                              @if($val->big_pack_unit && $val->big_pack_qty > 1)
                              <p style=" border-left: 1px solid;padding-left: 2px;padding-right: 2px;">{{ $val->big_pack_unit }}</p>
                              @endif
                            </td>
                            <td>{{ $val->quantity_ctn }}</td>
                            <td>{{ $val->quantity_unit }}</td>
                            <td>{{ $val->ctn_length }}</td>
                            <td>{{ $val->cbm_ctn }}</td>
                            <td>{{ $val->g_w }} kgs</td>
                            <td>{{ $val->moq }}</td>
                            <td>{{ $val->moq_unit }}</td>
                            <td>{{ $val->hs_code }}</td>
                            <td title="{{ $val->description }}">{{ \Illuminate\Support\Str::limit($val->description, 15, $end='...') }}</td>
                        </tr>
                      @endif
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!-- Click Modal Start -->
<div class="modal fade" id="clickModal" tabindex="-1" aria-labelledby="clickModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="clickModalLabel">Click</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want make click value 0.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" id="product-click-modal-btn" class="btn btn-primary"  data-product_id="">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Click Modal End -->

<!-- Product Authorize Modal Start -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Product delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sure to delete to trash bin?
      </div>
      <div class="modal-body">
        <button type="button" id="product-delete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- Product Authorize Modal End -->

<!-- Product Authorize Modal Start -->
<div class="modal fade" id="productAuthorizeModal" tabindex="-1" aria-labelledby="productAuthorizeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productAuthorizeModalLabel">Product Authorize</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button type="button" id="product-authorize-restrict" class="btn btn-primary" data-val="specific">Restrict to Level C</button>
        <button type="button" id="product-authorize-release" class="btn btn-secondary" data-val="all">Release to all</button>
      </div>
    </div>
  </div>
</div>
<!-- Product Authorize Modal End -->

<!-- Batch Upload Modal Start -->
<div class="modal fade" id="batchUploadModal" tabindex="-1" aria-labelledby="batchUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="batchUploadModalLabel">Batch Upload</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('admin/batch-upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Excel File</label>
                <input type="file" name="excel_file" id="excel_file">
                <span class="text-danger" id="excel_error"></span>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Product Authorize Modal End -->


@endsection


@section('js')
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>
<script>
    $(document).ready( function () {
      var dataTable = $('#adminProductTable').DataTable({
            "lengthChange": false,
            "bInfo": false,
            pageLength: 12,
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            fixedColumns:   {
                left: 5,
            }
        }
      );
      $("#searchbox").on("keyup search input paste cut", function() {
        dataTable.search(this.value).draw();
      });
    } );
    
</script>
@endsection