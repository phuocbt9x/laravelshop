@extends('admin.layout.main')
@include('admin.layout.form')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.1px;">
        <form class="form-horizontal" action="{{ route('product.store') }}" method="POST" id="form" enctype="multipart/form-data">
            @csrf
            @method('POST')
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
                                                <input type="text" class="form-control @error('name')  
                                                is-invalid @enderror"
                                                id="name" placeholder="Name"
                                                name="name" fdprocessedid="nvd9fh">
                                                @error('name')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control @error('price')  
                                                is-invalid @enderror" id="price" min="0"
                                                    name="price" placeholder="Price" fdprocessedid="nvd9fh">
                                                @error('price')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                            <div class="col-sm-10" id="quantity-div">
                                                <input type="number" class="form-control @error('quantity')  
                                                is-invalid @enderror" id="quantity" name="quantity"
                                                    placeholder="Quantity" fdprocessedid="c5qs9" >
                                                @error('quantity')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="quantity" class="col-sm-2 col-form-label">Manufacturer</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" fdprocessedid="4b7qpb" name="manufacturer_id"
                                                    id="manufacture_id">
                                                    <option>Choose manufacturer</option>
                                                    @foreach ($manufactures as $manufacture)
                                                        <option value="{{ $manufacture->id }}">
                                                            {{ $manufacture->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('manufacture_id')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="category" class="col-sm-2 col-form-label">Category</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" fdprocessedid="4b7qpb" name="category_id"
                                                    id="category_id">
                                                    <option>Choose category</option>
                                                    @foreach ($categorys as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                                @enderror
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
                                            <textarea class="form-control @error('decrisption')  
                                            is-invalid @enderror" rows="3" placeholder="Enter about product description" name="decrisption"></textarea>
                                            @error('decrisption')
                                                <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Thambnail</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('thumbnail')  
                                                is-invalid @enderror" id="customFile"
                                                    name="thumbnail" onchange="loadFile(event)">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                @error('thumbnail')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-center mw-100" id="preview_logo">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921"
                                                    alt="" style="width: 200px;" class="" id="blah">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="card-default">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input product-option" type="checkbox"
                                                id="customCheckbox1" value="option1">
                                            <label for="customCheckbox1" class="custom-control-label">Product
                                                option(s)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-secondary" id="doing" style="display:none">
                                <div class="card-header">
                                    <h3 class="card-title">Custom Elements</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6" >
                                            {{-- <div class="form-group" data-select2-id="48">
                                                <label>Size</label>
                                                <div class="select2-blue" data-select2-id="47">
                                                    <select class="select2 select2-hidden-accessible" multiple=""
                                                        name="size[]" data-placeholder="Select a State"
                                                        data-dropdown-css-class="select2-blue" style="width: 100%;"
                                                        data-select2-id="15" tabindex="-1" aria-hidden="true">
                                                        @foreach ($size as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('size')
                                                        <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group" data-select2-id="94">
                                                <label>Colour</label>
                                                <select class="select2 select2-hidden-accessible" multiple=""
                                                    name="colour[]" id="arrColour" data-placeholder="Select a State"
                                                    style="width: 100%;" data-select2-id="7" tabindex="-1"
                                                    aria-hidden="true">
                                                    @foreach ($colour as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('colour')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                            @foreach ($test as $key => $option)
                                                <div class="form-group" data-select2-id="48">
                                                    <label>{{$key}}</label>
                                                    <div class="select2-blue" >
                                                        <select class="select2 select2-hidden-accessible" multiple=""
                                                            name="{{$key.'[]'}}" data-placeholder="Select a State" 
                                                            data-dropdown-css-class="select2-blue" style="width: 100%;"
                                                            tabindex="-1" aria-hidden="true" id="{{$key}}">
                                                            @foreach ($option as $item)
                                                            
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->value }}
                                                                </option>
                                                            
                                                                @endforeach
                                                        </select>
                                                        @error('size')
                                                            <span id="exampleInputEmail1-error" class="error invalid-feedback mb-0" style="font-size: 15px">{{ $message }}</span>
                                                        @enderror
                                                       

                                                    </div>
                                                </div> 
                                            @endforeach
                                            <button type="submit" class="btn btn-secondary" fdprocessedid="l21zjs" id="arrColour">Go</button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group h">
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </section>
                </div>
                <div class="card-default">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="activated" name="activated" value="1">
                                            <label class="custom-control-label" for="activated">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="card-default">
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-success w-10" fdprocessedid="xfio8" style="width: 150px;height: 50px;" type="submit"
                            id="submit"><span class="h5">Next</span></button>
                    </div>
                </div>
            </div>
        <form>
    </div>
@endsection
@push('js')
    <script>
        $('.product-option').on('click', function() {
            var option = $('.product-option');
            $('#doing').slideToggle();
            if($(option).is(':checked')){
                $(option).parents().find("#quantity-div #quantity").attr('readonly', true);
            }
            else{
                $(option).parents().find("#quantity-div #quantity").attr('readonly', false);
            }
        })
        $('#form').submit(function() {
            $('.product-option').prop('checked', false);
        });
        $('#arrColour').on('click',function(event) {
            // event.preventDefault();
            // var btn = $('#arrColour');
            // //console.log(1);
            // var selectednumbers = [];
            
            // $(btn).siblings().find('select :selected').each(function(i,selected){
            //     selectednumbers[i] = $(selected).val();
            // });
            // $(btn).siblings().find('select').each(function(i,selecte){
            //     selectednumbers[i]= [$(selecte).attr("id")];
            // })
            // var arr = [];
            // selectednumbers.forEach(element => {
            //      $(btn).siblings().find('select :selected').each(function(a,selected){
            //         arr[element]= [$(selected).val()];
            //     })
            // });
            //  selectednumbers.each(function(i,item){
               
            //  })
           
            //  console.log($(btn).siblings().find('select :selected').serializeArray());
            event.preventDefault();
            var btn = $('#arrColour');
            
            // var selectednumbers = [];
            // $(btn).siblings().find('select').each(function(i,select){
            //     selectednumbers[i] =  $(select).val();
                // $(select).find('select :selected').each(function(a,selected){
                //     arrayProduct[a] = [
                //         {nameProduct: $(select).attr("id"),valueProduct: $(selected).val()}
                //     ]
                // });
            //})
            if ($(btn).siblings().find('select :selected').length != '') {
                var selectednumbers = [];
                var selectednumber = [];
                $(btn).siblings().find('select').each(function(i,select){
                    selectednumbers[i] =  $(select).val();
                })
                $.ajax({
                    url: '{!! route('product.api') !!}',
                    data: {
                        option: JSON.stringify(selectednumbers)
                    },
                    method: 'post',
                    success: function(data) {
                        var arr = [];
                        var result = '';
                        $('.h').show();
                        var da = JSON.parse(data);
                        $.each(JSON.parse(data), function(i, item) {
                            arr[i] = [item];
                        })
                        //show div productSku
                        $('.h').html((arr));
                        //thumbnail
                        if (window.File && window.FileList && window.FileReader) {
                            $(".images").on("change", function(e) {
                                var clickedButton = this;
                            
                                var files = e.target.files,
                                    filesLength = files.length;
                                for (var i = 0; i < filesLength; i++) {
                                    var f = files[i]
                                    var fileReader = new FileReader();
                                    fileReader.onload = (function(e) {
                                        var file = e.target;
                                        $(clickedButton).parents().find("#preview_logo #thumbnail_Sku").hide();
                                        $("<div class=\"d-flex justify-content-center mw-100 pip\" id=\"preview_logo\">" +
                                            "<img style=\"width: 100px\" class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                            "<br/><span class=\"remove\">x</span>" +
                                            "</div>").insertAfter(clickedButton);
                                        $(".remove").click(function(){
                                            $(this).parent(".pip").remove();
                                        });
                                    });
                                    fileReader.readAsDataURL(f);
                                }
                            });
                        } else {
                            alert("Your browser doesn't support to File API")
                        }
                        //quantity
                        var a = [];
                        $('input[name^="quantitySku"]').change(function(event){
                            event.preventDefault();
                            var quantity = $('input[name^="quantitySku"]');
                            if ($(quantity).length != '') {
                                console.log(30);
                                var arrQuantity = [];
                                console.log( $(quantity).val());
                                var el = document.getElementById('quantity_sku').value;
                                $("input[name^='quantitySku']").each(function(i,select) {
                                    arrQuantity[i] = ($(select).val());
                                });
                                console.log(JSON.stringify(arrQuantity));
                                $.ajax({
                                    url: '{!! route('product.apiQuantity') !!}',
                                    data: {
                                        quantity: JSON.stringify(arrQuantity)
                                    },
                                    method: 'post',
                                    success: function (response) {
                                        $('#quantity').val(response);
                                    }
                                });
                            }
                        })
                    }
                });
            } else {
                $('.h').hide();
            }
        });
        
            
        
        
        // $('#arrColour').on('click',function(event) {
        //     event.preventDefault();
        //     var btn = $('#arrColour');
        //     console.log(1);
        //     var selectednumbers = [];
        //     const  arrayProduct = [];
        //     $(btn).siblings().find('select').each(function(i,select){
        //         console.log($(select).val());
        //         $(select).find('select :selected').each(function(a,selected){
        //             arrayProduct[a] = [
        //                 {nameProduct: $(select).attr("id"),valueProduct: $(selected).val()}
        //             ]
        //         });
        //     })
        //     //const  arrayProduct = $(btn).siblings().find('select').val();
        //     console.log(arrayProduct);
        //     const groupBy = key => array =>
        //         array.reduce((objectsByKeyValue, obj) => {
        //             const value = obj[key];
        //             objectsByKeyValue[value] = (objectsByKeyValue[value] || []).concat(obj);
        //             return objectsByKeyValue;
        //         });
        //         const groupByBrand = groupBy('nameProduct');
            
        //     // console.log(JSON.stringify(
        //     //     groupByBrand(arrayProduct)
        //     // ));


        //     // $(btn).siblings().find('select').each(function(i,selecte){
        //     //     selectednumbers[i]= $(selecte).attr("id");
        //     // })
        //     // var arr = [];
        //     // selectednumbers.forEach(element => {
        //     //     //console.log(element);
        //     //     var bien = '#' + element + ':selected';
        //     //     console.log(bien);
        //     //     arr[element] = $(element).val();
        //     // });
        //     // console.log($('#Size :selected').val());  
        // })
    </script>
@endpush
