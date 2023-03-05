@extends('admin.layout')
@section('page_title','Inquiry Cart View')
@section('cart_active','active')
@section('content')


<div class="card aos-init aos-animate mt-4"  data-aos="fade-up" data-aos-delay="800">
  <div class="card-header" style="background-color: #e9e9e9;">
  <div class="d-flex justify-content-between" >
      <div>
          <h4 class="card-title">Inquiry Cart View</h4>
      </div>
      <div style="margin-top: -13px;">
            <a href="{{ url('admin/inquiry-cart') }}"><button class="btn btn-danger">Back</button></a>
        </div>
  </div>
  </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table adminProductTable table-bordered table-striped" id="">
                <thead>
                    <tr>
                        <th>Item No</th>
                        <th>Product <br>Name</th>
                        <th>Photo</th>
                        <th>Size</th>
                        <th>Size <br>unit</th>
                        <th>Color</th>
                        <th>Material <br>Grade</th>
                        <th>Weight</th>
                        <th>Weight <br>unit</th>
                        <th>Package <br>/CTN</th>
                        <th>Quantity <br>/CTN</th>
                        <th>Quantity <br>unit</th>
                        <th>M3 <br>/CTN</th>
                        <th>G.W</th>
                        <th>MOQ</th>
                        <th>Moq <br>unit</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total <br>CTN </th>
                        <th>Total <br>Price </th>
                        <th>Total <br>M3 </th>
                        <th>Total <br>G.W kg </th>
                        <th>Client <br>Requirement</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $total_ctn = 0;
                    $total_price = 0;
                    @endphp
                    @foreach($product as $val)
                      @php
                        $total_ctn += $val->total_ctn;
                        $total_price += ($val->price * $val->moq);
                      @endphp
                        <tr class="product-tbl">
                            <td>{{ $val->sku }}</td>
                            <td title="{{ $val->name }}">{{ \Illuminate\Support\Str::limit($val->name, 15, $end='...') }}</td>
                            <td class="img-td">
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
                            </td>
                            <td>{{ $val->size }}</td>
                            <td>{{ $val->size_unit }}</td>
                            <td>{{ $val->color }}</td>
                            <td>{{ $val->material_grade }}</td>
                            <td>{{ $val->weight }}</td>
                            <td>{{ $val->weight_unit }}</td>
                            <td style="display: flex; justify-content:space-between; margin-top: 20px;">
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
                            <td>{{ $val->cbm_ctn }}</td>
                            <td>{{ $val->g_w }}</td>
                            <td>{{ $val->moq }}</td>
                            <td>{{ $val->moq_unit }}</td>
                            <td>{{$val->price_term}}<br>{{$val->currency}}<br>{{$val->price}}<br>{{$val->price_per_unit}}</td>
                            <td>{{ $val->moq }}</td>
                            <td>{{ $val->total_ctn }}</td>
                            <td>{{$val->currency}}<br>{{$val->price * $val->moq}}</td>
                            <td>{{$val->cbm_ctn * $val->total_ctn}}</td>
                            <td>{{$val->g_w * $val->total_ctn}}</td>
                            <td title="{{ $val->requirement }}">{{ \Illuminate\Support\Str::limit($val->requirement, 15, $end='...') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h6>Total Ctn: <span>@php echo $total_ctn; @endphp</span></h6>
            <h6>Total Price: <span>@php echo $total_price; @endphp</span></h6>
            </div>
        </div>
    </div>
</div>
@endsection
