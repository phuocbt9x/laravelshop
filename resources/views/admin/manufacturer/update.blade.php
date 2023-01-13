@extends('admin.layout.main')
@include('admin.layout.form')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manufacturer update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
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
                                <h3 class="card-title">Information update</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('manufacturer.update' , $manufactureModel) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control @error('name')
                                        is-invalid
                                        @enderror" id="exampleInputEmail1" name="name"
                                            placeholder="Enter name" value="{{ $manufactureModel->name ?? old(name) }}">
                                        @error('name')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('logo')
                                                is-invalid
                                                @enderror" id="exampleInputFile" name="logo" id="logo" onchange="loadFile(event)">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        @error('logo')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                        @enderror
                                        <div class="d-flex justify-content-center mw-100" id="preview_logo" >
                                            <img src="{{ asset($manufactureModel->logo) }}" alt="" style="width: 200px;" class="" id="blah">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Website</label>
                                        <input type="text" class="form-control @error('website')
                                            is-invalid
                                        @enderror" id="exampleInputPassword1" name="website"
                                            placeholder="Link to manufacturer website"  value="{{ $manufactureModel->website ?? old(website) }}">
                                        @error('website')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                        @enderror        
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                      
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="number" class="form-control @error('phone')
                                            is-invalid
                                            @enderror" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text" name="phone"
                                            value="{{ $manufactureModel->phone ?? old(phone) }}"
                                            >    
                                            @error('phone')
                                                <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                            @enderror
                                          
                                        <!-- /.input group -->
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" value="1" name="activated">
                                            <label class="custom-control-label" for="customSwitch1">Toggle this custom
                                                switch element</label>
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
@push('js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('blah');
            output.src = URL.createObjectURL(event.target.files[0]);
            setTimeout(function(){$('#blah').html('<img src="imagse/load.gif">');  },2000);

            output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endpush