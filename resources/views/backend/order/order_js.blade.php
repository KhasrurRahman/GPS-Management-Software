<script>
    // load data table
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            "order": [
                [1, 'asc']
            ],
            "columnDefs": [{
                "className": "dt-center",
                "targets": "_all"
            }],
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            },
            drawCallback: function (settings) {
                var api = this.api();
                $('#total_data').html(api.ajax.json().recordsTotal);
            },
            ajax: {
                url: "{{ url('admin/order_search') }}",
                type: 'POSt',
                data: function (d) {
                    d._token = '{{ csrf_token() }}'
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false, orderable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'package',
                    name: 'package'
                },

                {
                    data: 'total_amount',
                    name: 'total_amount'
                },
                {
                    data: 'Payment_status',
                    name: 'Payment_status'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        $('#search_form').on('submit', function (event) {
            event.preventDefault();
            table.draw(true);
        });
    });

    // clear search form
    function form_reset() {
        document.getElementById("search_form").reset();
        $('.yajra-datatable').DataTable().ajax.reload(null, false);
    }


    function complete_order(id) {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })
        swalWithBootstrapButtons({
            title: 'Are you sure Want To Active this user?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Active it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    type: 'get',
                    url: '{{ url('admin/complete_order') }}/' + id,
                    success: function (response) {
                        if (response) {
                            toastr.success('Completed Successful', 'Successful');
                            $('.yajra-datatable').DataTable().ajax.reload(null, false);
                        }
                    }
                });
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }
</script>
