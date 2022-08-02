@extends('layouts.admin')
@section('title') {{'Roles'}} @endsection
@section('content')
<br><br>
        <!-- PAGE CONTAINER-->
        <div class="page-container2">

            <br><br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Roles</li>
  </ol>
</nav>


            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                        <div class="col-md-8">

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
<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addUser">Add Role <i class="fas fa-plus"></i></button>
                                <div class="card">
                                    <div class="card-header">
                                        <i class="mr-2 fa fa-align-justify"></i>
                                        <strong class="card-title" v-if="headerText">Roles</strong>
                                    </div>
                                    <div class="card-body">

                <div class="table-responsive">
                        <?php
                        if(isset($roles) && count($roles)>0){ 
                          $modal = 0;
                          ?>
                                <table id="example1" class="table table-bordered table-hover">
                                  <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                          <?php

                          foreach($roles as $role){ 
                            $modal++;
                          ?>
                                    <tr>
                                      <td>{{ ucfirst(trans($role->name)) }}</td>
                              <td>{{ $role->description }}</td>
                              <td><button class="btn btn-success" data-toggle="modal" data-target="#editModal<?php echo $modal; ?>"> <i class="fas fa-edit"></i></button></td>
                              <td><button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $modal; ?>"> <i class="fas fa-trash"></i></button></td>
                                    </tr>


<!-- delete Modal -->
<div class="modal fade" id="deleteModal<?php echo $modal; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $role['name']; ?>?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <button class="btn btn-success btn-block" data-dismiss="modal">No</button>
      <form action="/roles/{{ $role->id }}" method="POST">
      <input type="hidden" name="role_name" value="<?php echo $role['name']; ?>">
        @method('DELETE')
        @csrf
        <br>
        <button type="submit" class="btn btn-danger btn-block">Yes</button>
      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- edit Modal -->
<div class="modal fade" id="editModal<?php echo $modal; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo $role['name']; ?> Role?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('roles.update', ['role' => $role]) }}" method="POST">
        @method('PATCH')
        <div class="container">
      <input type="hidden" name="role_id" value="<?php echo $role['id']; ?>">
      <input type="hidden" name="role_name" value="<?php echo $role['name']; ?>">

                        @csrf

                        <div class="form-group row">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="<?php echo $role['name']; ?>" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                          <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $role->description }}</textarea>
                        </div>

                        <div class="form-group row mb-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update Role
                                </button>
                        </div>
                    </div>

      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

                          <?php
                            
                          } ?>

                                  </tbody>
                                </table>
                                <?php
                                      }else {
                                        echo "No Roles Available";
                                      }
                        ?>
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
            </section>
            <!-- END PAGE CONTAINER-->


@endsection
