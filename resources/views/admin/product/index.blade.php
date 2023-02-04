@extends('admin.layout.main')
@include('admin.layout.table')
@push('css')
    <style>
        td.details-control {
            /* background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center; */
            cursor: pointer;
        }

        tr.shown td.details-control {
            /* background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center; */
            color: red
        }
    </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                </div>
                
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-row-reverse">
                                <a href="{{ route('product.create') }}" class="btn btn-primary ">
                                    <span>Create new</span>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            {{-- <th>
                                            </th> --}}
                                            <th><i class="far fa-regular fa-image"></i></th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Manufacturer</th>
                                            <th>Category</th>
                                            <th>Actions</th>
                                            {{-- <img src="" style=" border: 0; width: 100px; align-items: center;justify-content: center" class="img" /> --}}
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        
        
        var columns = [
            // {
            //     "className": 'details-control',
            //     "orderable": false,
            //     "data": null,
            //     "defaultContent": '',
            //     'render': function(){
            //         return '<i class="far fa-plus-square" aria-hidden="true"></i>'
            //     }
            // },
            {
                data: 'thumbnail',
                name: 'thumbnail'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'slug',
                name: 'slug'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'quantity',
                name: 'quantity'
            },
            {
                data: 'manufacturer',
                name: 'manufacturer'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'actions',
                name: 'actions'
            }
        ];
        renderTable("{!! route('product.index') !!}", columns);
        // $('#dataTable').DataTable({
        //     "paging": true,
        //     "lengthChange": true,
        //     "searching": true,
        //     "ordering": true,
        //     "orderable": false,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": false,
        //     "processing": true,
        //     "serverSide": true,
        //     //"bDestroy": true,
        //     ajax: "{{route('product.index')}}",
        //     columns: columns,
        //     "order": [
        //         [1, 'asc']
        //     ],
        // });
        
        // $('#dataTable tbody').on('click', 'td.details-control', function () {
        //     var tr = $(this).closest('tr');
        //     var tdi = tr.find("i.fa");
        //     console.log(tr);
        //     var row = table.row(tr);
        //     if (row.child.isShown()) {
        //         // This row is already open - close it.
        //         row.child.hide();
        //         tr.removeClass('shown');
        //     } else {
        //         // Open row.
        //         row.child('foo').show();
        //         tr.addClass('shown');
        //     }
        // }); 
        // function format(response) {
        //     console.log(response);
        //     return (
        //         '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
        //             '<tr>' +
        //                 '<td>Full name:</td>' +
        //                     '<td>' +
        //                         d.name +
        //                     '</td>' +
        //                 '</tr>' +
        //         '</table>'
        //     );
        //     console.log(1);
        // };
        // $(document).ready(function () {
        //     $.ajax({
        //         type: "get",
        //         url: "{{ route('product.index') }}",
        //         data: null,
        //         dataType: "json",
        //         success: function (response) {
        //             //console.log(response.data[0].name);
                    
        //         }
        //     });    
        // });
        //renderTable("{!! route('product.index') !!}", columns);

        // function format(data) {
        //     return (
        //         '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
        //             '<tr>' +
        //                 '<td>Full name:</td>' +
        //                     '<td>' +
        //                         data.name +
        //                     '</td>' +
        //                 '</tr>' +
        //         '</table>'
        //     );
        // };
        // $(document).ready(function () {
        //         $('#dataTable tbody').on('click', 'td.details-control', function () {
        //             var tr = $(this).closest('tr');
        //             var tdi = tr.find("i.fa");
        //             console.log(tr);
        //             var row = table.row(tr);
        //             if (row.child.isShown()) {
        //                 // This row is already open - close it.
        //                 row.child.hide();
        //                 tr.removeClass('shown');
        //             } else {
        //                 // Open row.
        //                 row.child('foo').show();
        //                 tr.addClass('shown');
        //             }
        //         });
        //     });
        
        
    </script>
@endpush