@extends('layouts.admin')
@section('title') {{'View Receipt'}} @endsection
@section('content')
<br><br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('dashboard/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('dashboard/js/custom-editors.js') }}"></script>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">

            <br><br>


            <section>
                <div class="section__content section__content--p30">
                    <div class="container">
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

                                <div class="card">
                                    <div class="card-header">
                                        <i class="mr-2 fa fa-align-justify"></i>
                                        <strong class="card-title" v-if="headerText">View Receipt</strong>
                                    </div>
                                    <div class="card-body">

<div class="row">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Subscriber</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $receipt->user->first_name }} {{ $receipt->user->last_name }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Order No</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $receipt->order_no }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Date Issued</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php $date = date_create($receipt->created_at); echo date_format($date,"j M, Y"); ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Publication</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $receipt->subscription->name }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Duration</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                @if($duration < 2)
                    {{ $duration }} Month
                @else
                    {{ $duration }} Months
                @endif
                </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Status</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $status }}</p>
              </div>
            </div>

          </div>
        </div>
        <div class="row">


        </div>
      </div>


<div class="col-md-6"></div>
</div>

                                    </div>
                                </div>



                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>

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
            </section>custom-editors.js
            <!-- END PAGE CONTAINER-->

<script>
    $("input[type='number']").inputSpinner()
    $(".buttons-only").inputSpinner({buttonsOnly: true})
</script>
@endsection
