@extends('layouts.admin')
@section('title') {{'Users'}} @endsection
@section('content')
<br><br>
        <!-- PAGE CONTAINER-->
        <div class="page-container2">


<br>
<br>
<br>

<section>
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-md-12">
	            <div class="card border border-secondary">
                    <div class="card-header">
                        <strong class="card-title">Users</strong>
                    </div>
                    <div class="card-body">

				<div id="" class="table table-bordered table-striped">
				                <table id="example1" class="table table-bordered table-striped example1">
				                  <thead>
				                    <tr>
				                      <th>Email</th>
				                      <th>First Name</th>
				                      <th>Last Name</th>
				                      <th>Date Added</th>
				                      <th>Role</th>
				                      <th>Action</th>
				                      <th>Action</th>
				                      <th>Action</th>
				                    </tr>
				                  </thead>
				                  <tbody>

				                  </tbody>
				                </table>
				              </div>

                    </div>
                </div>	
        	</div>

        </div>
    </div>
</div>
</section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © {{ date('Y') }} Nation Publications. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END PAGE CONTAINER-->

<!-- jQuery -->
<script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<script>
 var table = $(function () {
    $("#example1").DataTable({
        processing: true,
        order: [[ 3, "desc" ]],
        dom: 'lBfrtip',
        "responsive": false, "autoWidth": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
         buttons: [
                {
                    extend: 'pdf',
                    title: 'Users',
                    exportOptions: 
                    {
                    columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                {
                    extend: 'excel',
                    title: 'Users',
                    exportOptions: 
                    {
                    columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                {
                    extend: 'csv',
                    title: 'Users',
                    exportOptions: 
                    {
                    columns: [ 0, 1, 2, 3, 4 ]
                    }
                }

                ],
        serverSide: true,
        ajax: {
                url: '{{ route('users.datatable') }}',
            },
        columns: [
            {data: 'email', name: 'email'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {
                data: "created_at",
                "render": function (value) {
                    if (value === null) return "";
                    return moment(value).format('DD/MM/YYYY');
                }
            },
            {data: 'role.name', name: 'role.name'},
            {
            "render": function (data, type, full, meta) {
                return "<a href='users/reset-password/" + full.id + "' class='btn btn-secondary'><i class='fas fa-unlock-alt'></i></a>";
            }
            }
            ,
            {
            "render": function (data, type, full, meta) {
                return "<a href='users/edit/" + full.id + "' class='btn btn-success'><i class='fas fa-edit'></i></a>";
            }
            }
            ,
            {
            "render": function (data, type, full, meta) {
                return "<a href='users/delete/" + full.id + "' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
            }
            }
        ]
    });
  });
</script>


@endsection
