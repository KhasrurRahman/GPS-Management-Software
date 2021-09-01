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
                url: "{{ url('admin/complain_search') }}",
                type: 'POSt',
                data: function (d) {
                    d._token = '{{ csrf_token() }}'
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },

                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'complain',
                    name: 'complain'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
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

</script>
