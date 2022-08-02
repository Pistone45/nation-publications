@extends('layouts.admin')
@section('title') {{'Subscription History'}} @endsection
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
                @if(session()->has('message'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif

                @if (session('error'))
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
        		
	            <div class="card border border-secondary">
                    <div class="card-header">
                        <strong class="card-title">Subscription History</strong>
                    </div>
                    <div class="card-body">

				<div id="" class="table table-bordered table-striped">
				                <table id="example1" class="table table-bordered table-striped example1">
				                  <thead>
				                    <tr>
                                      <th>Subscriber</th>
				                      <th>Subscription</th>
				                      <th>Copies</th>
				                      <th>Date From</th>
				                      <th>Date To</th>
				                      <th>Duration</th>
				                      <th>Status</th>
				                      <th>Receipt</th>
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
                    title: 'Subscriptions',
                    exportOptions: 
                    {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'excel',
                    title: 'Subscriptions',
                    exportOptions: 
                    {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'csv',
                    title: 'Subscriptions',
                    exportOptions: 
                    {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                }

                ],
        serverSide: true,
        ajax: {
                url: '{{ route('subscribers.datatable') }}',
            },
        columns: [
            {
                data: "user.first_name",
            "render": function (data, type, full, meta) {
                    return "<p><b>"+ full.user.first_name +" "+ full.user.last_name +"<b/><p/>";

            }
            },
            {data: 'subscription.name', name: 'subscription.name'},
            {data: 'copies', name: 'copies'},
            {
                data: "time_from",
                "render": function (value) {
                    if (value === null) return "";
                    return moment(value).format('DD/MM/YYYY');
                }
            },
            {
                data: "time_to",
                "render": function (value) {
                    if (value === null) return "";
                    return moment(value).format('DD/MM/YYYY');
                }
            },
            {
            data: "duration",
            "render": function (data, type, full, meta) {
            	var duration = full.duration;
            	if(duration > 1){
                return "<p>"+ full.duration +" Months</p>";

            	}else{
            		return "<p>"+ full.duration +" Month</p>";
            	}
            }
            },
            {data: 'status.name', name: 'status.name'},
            {
            "render": function (data, type, full, meta) {
            		return "<a href='/receipt/view/"+ full.id +"' class='btn btn-success'> <i class='fas fa fa-eye'></i></a> <a href='/receipt/"+ full.id +"' class='btn btn-success'> <i class='fa-solid fa-cloud-arrow-down'></i></a>";

            }
            }
            
        ]
    });
  });
</script>


@endsection
