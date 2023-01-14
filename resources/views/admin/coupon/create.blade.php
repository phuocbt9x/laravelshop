@extends('admin.layout.main')
@include('admin.layout.form')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Coupon</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Infor Coupon</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text"
                                            class="form-control @error('name')
                                        is-invalid
                                        @enderror"
                                            id="exampleInputEmail1" name="name" placeholder="Enter name">
                                        @error('name')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0"
                                                style="font-size: 15px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select
                                            class="form-control @error('type')
                                            is-invalid
                                        @enderror"
                                            id="type" name="type">
                                            <option value="">Choose type of discount</option>
                                            <option value="0">Cash</option>
                                            <option value="1">Percentage off</option>
                                        </select>

                                        @error('type')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" id="stock" placeholder="Stock" name="stock"
                                            min="0"
                                            class="form-control @error('stock')
                                                is-invalid
                                            @enderror">
                                        @error('stock')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Time start:</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#reservationdatetime" fdprocessedid="x3y94h" name="time_start">
                                            <div class="input-group-append" data-target="#reservationdatetime"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Time end:</label>
                                        <div class="input-group date" id="reservationdatetimeEnd" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#reservationdatetimeEnd" fdprocessedid="x3y94h"  name="time_end">
                                            <div class="input-group-append" data-target="#reservationdatetimeEnd"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Value</label>
                                        <input type="number"
                                            class="form-control @error('value')
                                            is-invalid
                                        @enderror"
                                            id="exampleInputPassword1" name="value"
                                            placeholder="Please enter value" min="0">
                                        @error('value')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0"
                                                style="font-size: 15px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- /.card-body -->

                                    <div class="card-footer d-flex flex-row-reverse">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div>
                        <!-- /.card -->


                    </div>
                    <!--/.col (left) -->

                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('blah');
            output.src = URL.createObjectURL(event.target.files[0]);
            setTimeout(function() {
                $('#blah').html('<img src="imagse/load.gif">');
            }, 2000);

            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endpush
