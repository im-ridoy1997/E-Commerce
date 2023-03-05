@extends('admin.layout')
@section('page_title','Member')
@section('member_active','active')
@section('content')

<div class="card aos-init aos-animate mt-4" data-aos="fade-up" data-aos-delay="800">
    <div class="card">
        <div class="card-header" style="background-color: #e9e9e9;">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title">Registration</h4>
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
                    <th>No</th>
                    <th>Approved</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Country</th>
                    <th>IP</th>
                    <th>Website</th>
                    <th>Email</th>
                    <th>Register's Local Time</th>
                    <th>Approval Time</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($member as $val)
                    <tr>
                        <td>{{ $val->id }}</td>
                        <td>
                        <input class="toggle-class" data-bs-toggle="modal" data-bs-target="#memberApproveModal" data-id="{{ $val->id }}" {{ $val->approve ? 'checked' : '' }} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                        </td>
                        <td><a href="javascript:void(0)" onclick="getIndividualMemberRecord('{{ $val->id }}')">{{ $val->name }}</a></td>
                        <td>{{ $val->company_name }}</td>
                        <td>{{ $val->country }}</td>
                        <td>{{ $val->ip_address }}</td>
                        <td>{{ $val->website }}</td>
                        <td>{{ $val->email }}</td>
                        <td>{{ $val->register_time }}</td>
                        <td>{{ $val->approve_time }}</td>
                        <td title="{{ $val->message }}">{{ \Illuminate\Support\Str::limit($val->message, 15, $end='...') }}</td>
                        <td>
                            <a href="javascript:void(0)" title="Delete" onclick="setValueForMemberDeleteModal('{{$val->id}}')" data-bs-toggle="modal" data-bs-target="#memberDeleteModal" title="Member delete."><i class="fas fa-trash-alt"></i></a>
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

<!-- Member delete Modal Start -->
<div class="modal fade" id="memberDeleteModal" tabindex="-1" aria-labelledby="memberDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="memberDeleteModalLabel">Member Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sure to Delete to Trash Bin?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" id="member-delete-modal-btn" class="btn btn-primary"  data-id="">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Member delete Modal End -->

<!-- Member Approve Modal Start -->
<div class="modal fade" id="memberApproveModal" tabindex="-1" aria-labelledby="memberApproveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="memberApproveModalLabel">Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="member-approve-modal-body">

      </div>
      <div class="modal-footer">
        <a href="{{ url('/admin/member') }}" class="btn btn-secondary">No</a>
        <button type="submit" id="member-Approve-modal-btn" class="btn btn-primary"  data-id="" data-approve="">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Member Approve Modal End -->
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