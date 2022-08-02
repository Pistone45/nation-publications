@extends('layouts.admin')
@section('title') {{'View News'}} @endsection
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
                                        <strong class="card-title" v-if="headerText">View News</strong>
                                    </div>
                                    <div class="card-body">
                                        
    <h5>You can view the below publications: </h5>
    <br>
<div class="row">
@if(isset($subscriptions) && count($subscriptions)>0)
@foreach ($subscriptions as $subscription)
<div class="col-md-4">
    
<div class="card border-dark mb-3">
  <div class="card-header" align="center"><h5 class="card-title">{{ $subscription->subscription->name }}</h5></div>
  <div class="card-body text-dark">
 @if($subscription->subscription->id == 1)
    <img src="{{ asset('dashboard/images/nos.jpg') }}">
    @elseif($subscription->subscription->id == 2)
    <img src="{{ asset('dashboard/images/tn.jpg') }}">
    @elseif($subscription->subscription->id == 3)
    <img src="{{ asset('dashboard/images/wn.jpg') }}">
    @endif
    <br>
    <h6 style="margin-top: 15px;" class="card-title">From: <?php $date = date_create($subscription->time_from); echo date_format($date,"j M, Y"); ?></h6>
    <h6 class="card-title">Ending: <?php $date = date_create($subscription->time_to); echo date_format($date,"j M, Y"); ?></h6>
    <hr>
    <h6 class="card-title">Days Remaining:
        <?php

        $from = new DateTime(date("Y-m-d H:i:s"));

        $later = new DateTime(date($subscription->time_to));
echo $abs_diff = $later->diff($from)->format("%a");
?></h6>
    <hr>
    <a href="/subscriptions/newspaper/{{$subscription->id}}" style="margin-top: 10px;" class="btn btn-primary w-100">View Newspaper <i class="fa-solid fa-newspaper"></i></a>
  </div>
</div>
</div>
@endforeach
@else
<div class="alert alert-primary" role="alert">
  You are not subscribed to any publication. Click <a href="/subscriptions">here</a> to subscribe
</div>
@endif
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
