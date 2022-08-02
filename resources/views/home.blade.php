@extends('layouts.admin')
@section('title') {{'Home'}} @endsection
@section('content')
<br><br>
        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <br><br>
<h1> &nbsp &nbsp &nbsp Welcome {{ Auth::user()->first_name }}</h1>
            <!-- STATISTIC-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

@if(Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Admin')
    
                            <div class="col-md-6 col-lg-3">     
                                <div class="statistic__item">
                                    <h2 class="number">{{ $user_count }}</h2>
                                    <span class="desc">All System Users</span>
                                     <a href="{{ asset('users') }}">
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </a>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">{{ $all_subs_count }}</h2>
                                    <span class="desc">Active Subscriptions</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">{{ $current_month_count }}</h2>
                                    <span class="desc">{{ Date('F') }} Subscribers</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">K{{ number_format($total) }}</h2>
                                    <span class="desc">total earnings</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-money"></i>
                                    </div>
                                </div>
                            </div>

@elseif(Auth::user()->role->name == 'Customer' || Auth::user()->role->name == 'customer')
          <div class="col-md-9">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Subscriptions</span>
                </p>
                @foreach($subscriptions as $subscription)

                <?php
                $from = new DateTime(date("Y-m-d H:i:s"));
                $later = new DateTime(date($subscription->time_to));
                $abs_diff = $later->diff($from)->format("%a");
                ?>

                <p class="mb-1" style="font-size: .77rem;">{{ $subscription->subscription->name }} <i>({{ $abs_diff }} days remaining)</i></p>

                @if($subscription->duration == 1)
                <div class="progress rounded" style="height: 5px;">
                  
                  <div class="progress-bar" role="progressbar" style="width: {{ $subscription->duration * 30  }}%" 
                    aria-valuemin="0" aria-valuemax="30"></div>
                </div>
                @elseif($subscription->duration == 3)
                <div class="progress rounded" style="height: 5px;">
                  
                  <div class="progress-bar" role="progressbar" style="width: {{ $subscription->duration * 30  }}%" 
                    aria-valuemin="0" aria-valuemax="90"></div>
                </div>
                @elseif($subscription->duration == 6)
                <div class="progress rounded" style="height: 5px;">
                  
                  <div class="progress-bar" role="progressbar" style="width: {{ $subscription->duration * 30  }}%" 
                    aria-valuemin="0" aria-valuemax="180"></div>
                </div>
                @elseif($subscription->duration == 12)
                <div class="progress rounded" style="height: 5px;">
                  
                  <div class="progress-bar" role="progressbar" style="width: {{ $subscription->duration * 30  }}%" 
                    aria-valuemin="0" aria-valuemax="360"></div>
                </div>
                @endif
                @endforeach
              </div>
            </div>
          </div>

                            <div class="col-md-6 col-lg-3">
                                <a href="{{ asset('subscriptions/view') }}">
                                <div class="statistic__item">
                                    <h2 class="number">{{ $sub_count }}</h2>
                                    <span class="desc">Active Subscriptions</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                                </a>
                            </div>

@endif

                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->


@if(Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Admin')

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">

<canvas id="myChart" width="100" height="100"></canvas>


                            </div>


                        </div>
                    </div>
                </div>
            </section>

@elseif(Auth::user()->role->name == 'Customer' || Auth::user()->role->name == 'customer')

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">


                        </div>
                    </div>
                </div>
            </section>

@endif



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


<script>
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Expired Subscribers', 'Active Subscribers'],
        datasets: [{
            label: 'Label',
            data: [{{$expired}}, {{$active}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

@endsection
