@extends('admin.layout.main')
@include('admin.layout.form')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ ucfirst($option->name) }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Options</li>
                            <li class="breadcrumb-item active">{{ $option->name }}</li>
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
                                <h3 class="card-title">Value Option Update</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('value.update', [$option->slug, $optionValueModel->slug]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="option_id" value="{{ $option->id }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="value">Value</label>
                                        <input value="{{ $optionValueModel->value }}" type="text" id="value"
                                            placeholder="Enter value" name="value"
                                            class="form-control @error('value')
                                                is-invalid
                                            @enderror">
                                        @error('value')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input @checked($optionValueModel->activated) type="checkbox" class="custom-control-input"
                                                id="activated" name="activated" value="1">
                                            <label class="custom-control-label" for="activated">Active</label>
                                        </div>
                                    </div>
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
