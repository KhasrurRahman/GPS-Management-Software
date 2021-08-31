<script>
    // load data table
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                total = this.api().ajax.json().sum_balance
                pageTotal = api
                    .column(1, {page: 'current'})
                    .data()
                    .sum()
                $(api.column(1).footer()).html(
                    'Tk ' + pageTotal + ' ( Tk ' + total + ' total)'
                );
            },
            "pageLength": 50,
            // "order": [
            //     [1, 'asc']
            // ],
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
                url: "{{ url('admin/history/billing_history_search_date') }}",
                type: 'POSt',
                data: function (d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                    d.email = $('#email').val();
                    d.phone = $('#phone').val();
                    d.name = $('#name').val();
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
                    data: 'bill_collected',
                    name: 'bill_collected'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                
                {
                    data: 'number_of_months',
                    name: 'number_of_months'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'time',
                    name: 'time'
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
