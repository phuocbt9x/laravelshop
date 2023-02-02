@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@push('js')
    <script src="{{ asset('assets/admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        
        function renderTable(url, columns) {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "orderable": false,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                "processing": true,
                "serverSide": true,
                //"bDestroy": true,
                ajax: url,
                columns: columns,
                "order": [
                    [1, 'asc']
                ]
            });
            // function format(data) {
            //     console.log(data);
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
        };
    </script>
    <script>
        function deleteItem(url) {
            console.log(url);
            var confirm = window.confirm(
                "Do you really want to delete this data! Data cannot be restored! Do you want to continue?");
            if (confirm) {
                $.post(
                    url, {
                        _method: 'delete'
                    },
                    function(respon) {
                        if (respon == 1) {
                            successMessage('Dữ liệu đã được xóa thành công!');
                            $('#dataTable').DataTable().clear().draw(true);
                        } else {
                            errorMessage('Data deletion failed!');
                        }
                    }
                );
            }
        }
    </script>
@endpush
