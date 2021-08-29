<script>
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
                $('#totat_subscriber').html(api.ajax.json().recordsTotal);
            },
            ajax: {
                url: "{{ url('admin/search_user') }}",
                type: 'POSt',
                data: function (d) {
                    d.username = $('#search_name').val();
                    d.mobile = $('#search_mobile').val();
                    d.email = $('#search_email').val();
                    d.ref_id = $('#search_ref_id').val();
                    d.search_car_number = $('#search_car_number').val();
                    d.search_user_type = $('#search_user_type').val();
                    d.search_activation_type = $('#search_activation_type').val();
                    d.search_payment_status = $('#search_payment_status').val();
                    d._token = '{{ csrf_token() }}'
                }
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false
            },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'car_number',
                    name: 'car_number'
                },
                {
                    data: 'monthly_bill',
                    name: 'monthly_bill'
                },
                {
                    data: 'assign_technician',
                    name: 'assign_technician'
                },
                {
                    data: 'note',
                    name: 'note',
                    searchable: false
                },
                {
                    data: 'expair_status',
                    name: 'expair_status',
                    searchable: false
                },
                {
                    data: 'payment_status',
                    name: 'payment_status',
                    searchable: false
                },
            ]
        });

        $('#search_form').on('submit', function (event) {
            event.preventDefault();
            table.draw(true);
        });
    });

    function form_reset() {
        document.getElementById("search_form").reset();
        $('.yajra-datatable').DataTable().ajax.reload(null, false);
    }
    
    // send sms to selected subscriber
        $('#send_selected_user_sms').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{route('admin.send_sms_to_selected_user')}}",
                type: "POST",
                data: {
                    user_id: $('#user_id').val(),
                    mobile: $('#mobile').val(),
                    rank_id: $('#rank_id').val(),
                    area_id: $('#area_id_search').val(),
                    building_id: $('#building_id_search').val(),
                    package_id: $('#search_package_id').val(),
                    house: $('#house').val(),
                    category: $('#search_category').val(),
                    status: $('#search_status').val(),
                    sms: $('#all_user_sms_body').val(),
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    if (response) {
                        toastr.success('Sms send Successfully', 'Send');
                    }
                },
                error: function (response) {
                    if (response.responseJSON.errors.sms) {
                        toastr.error('Please Write a Valid Sms', 'warning');
                    }
                    $('#all_user_sms_bodyError').text(response.responseJSON.errors.sms);
                }
            });
        });
</script>