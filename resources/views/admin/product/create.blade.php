@extends('admin.layout.main')
@include('admin.layout.form')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.1px;">
        <form class="form-horizontal">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>General Form</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">General Form</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <div class="card card-default">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Information Form</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" placeholder="Name"
                                                    fdprocessedid="nvd9fh">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="price" min="0"
                                                    placeholder="Price" fdprocessedid="nvd9fh">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="quantity"
                                                    placeholder="Quantity" fdprocessedid="c5qs9">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="quantity" class="col-sm-2 col-form-label">Manufacturer</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" fdprocessedid="4b7qpb">
                                                    <option>Choose manufacturer</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="category" class="col-sm-2 col-form-label">Category</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" fdprocessedid="4b7qpb">
                                                    <option>Choose category</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Image Form</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Discription</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter about product description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Thambnail</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="card-default">
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-success w-10" onclick="stepper.next()" fdprocessedid="xfio8"
                            style="width: 150px;height: 50px;"><span class="h5">Next</span></button>
                    </div>
                </div>
            </div>
        <form>
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
