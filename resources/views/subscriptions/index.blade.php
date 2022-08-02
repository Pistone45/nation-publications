@extends('layouts.admin')
@section('title') {{'Subscribe'}} @endsection
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
                                        <strong class="card-title" v-if="headerText">Subscribe</strong>
                                    </div>
                                    <div class="card-body">

<div class="row">


@foreach ($subscriptions as $subscription)
<div class="col-md-4">
<div class="card border-dark mb-3">
  <div class="card-header" align="center"><h5 class="card-title">{{ $subscription->name }}</h5></div>
  <div class="card-body text-dark">
    @if($subscription->id == 1)
  	<img style="padding-top: 10px;" src="{{ asset('dashboard/images/nos.jpg') }}">
    <br><br>
    @elseif($subscription->id == 2)
  	<img style="padding-top: 20px;" src="{{ asset('dashboard/images/tn.jpg') }}">
    @elseif($subscription->id == 3)
  	<img style="padding-top: 15px;" src="{{ asset('dashboard/images/wn.jpg') }}">
    @endif
  	<hr>
    <h6 class="card-title">Price: K{{ number_format($subscription->price) }}</h6>
    <hr>
    <form action="{{ route('subscriptions.subscribe') }}" method="POST">
    	@csrf

  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Duration</label>
    <select name="duration" class="form-control" id="exampleFormControlSelect1">
      <option value="1">1 Month</option>
      <option value="3">3 Months</option>
      <option value="6">6 Months</option>
      <option value="12">12 Months</option>
    </select>
  </div>

    <label>Select Copies</label>
    <input type="number" min="1" max="10" name="copies" step="1" required value="1">
	<input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
    <button type="submit" style="margin-top: 10px;" class="btn btn-primary w-100">Subscribe <i class="fa-solid fa-circle-plus"></i></button>
    </form>
  </div>
</div>
</div>
@endforeach

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
