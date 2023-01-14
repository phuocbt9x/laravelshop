@extends('admin.layout.main')
@include('admin.layout.form')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Discount update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Discount</li>
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
                            <form action="{{ route('discount.update' , $discountModel) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control @error('name')
                                        is-invalid
                                        @enderror" id="exampleInputEmail1" name="name"
                                            placeholder="Enter name" value="{{ $discountModel->name ?? old(name) }}">
                                        @error('name')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
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
                                            <option value="0" @selected($discountModel->type === 0)>Cash</option>
                                            <option value="1" @selected($discountModel->type === 1)>Percentage off</option>
                                        </select>

                                        @error('type')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Value</label>
                                        <input type="text" class="form-control @error('value')
                                            is-invalid
                                        @enderror" id="exampleInputPassword1" name="value"
                                            placeholder="Value of discount"  value="{{ $discountModel->value  }}">
                                        @error('value')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                        @enderror        
                                    </div>
                                    {{-- <div class="form-group">
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
                                    </div> --}}
                                    
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