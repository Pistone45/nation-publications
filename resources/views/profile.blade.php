@extends('layouts.admin')
@section('title') {{'Profile'}} @endsection
@section('content')

<?php
          $email= Auth::user()->email;
         
          // Removing Spaces
          $email = trim($email);
         
          // Make all Lower Case
          $email = strtolower($email);

          // Generating Hash
          $email_hash = md5($email);

        ?>

<br><br>
        <!-- PAGE CONTAINER-->
        <div class="page-container2">

            <br><br>


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

                                <div class="card">
                                    <div class="card-header">
                                        <i class="mr-2 fa fa-align-justify"></i>
                                        <strong class="card-title" v-if="headerText">Profile</strong>
                                    </div>
                                    <div class="card-body">

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://www.gravatar.com/avatar/<?php echo $email_hash?>?s=500" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
            <p class="text-muted mb-1">{{ Auth::user()->email }}</p>
            <p class="text-muted mb-4">{{ Auth::user()->region->name }}</p>
          </div>
        </div>

      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->phone }}</p>
              </div>
            </div>

          </div>
        </div>
        <div class="row">


        </div>
      </div>
    </div>
                                    </div>
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


@endsection
