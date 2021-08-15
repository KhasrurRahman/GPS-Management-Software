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

    function hidetable() {
        var x = document.getElementById("dynamic_field");
        if (x.style.display === "none") {
            x.style.display = "";
        } else {
            x.style.display = "none";
        }
    }

    function user_id(user_id, order_id) {
        document.getElementById('hidden_user_id').value = user_id;
    }

    $('#technican_data').change(function () {
        var technician_id = $(this).val();
        if (technician_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('admin/ajax_search_for_assign_tech') }}/" + technician_id,
                success: function (res) {

                    if (res) {
                        $("#dynamic_field").empty();
                        $.each(res, function (key, value) {
                            $("#dynamic_field").append(
                                '<tr class="dynamic-added"><td><select class="form-control" id="device_id" name="device_id[]"><option value="' +
                                value.id + '" selected>' + value.model +
                                '</option></select><td><input type="number" name="quantity[]" value="' +
                                value.quantity +
                                '" placeholder="Enter Quantity" class="form-control name_list" max="' +
                                value.quantity + '" min="0" id="quantity"/></td></tr>');
                        });

                    } else {
                        $("#dynamic_field").empty();
                    }
                }
            });
        } else {
            $("#dynamic_field").empty();

        }
    });

    // save assigen techinician
    $('#technician_assign_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('admin.technician_assign') }}",
            type: "POST",
            data: {
                user_id: $('#hidden_user_id').val(),
                technician_id: $('#technican_data').val(),
                assign_reason: $('#assign_reason').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#assign_technician').modal('hide');
                $("#technician_assign_form")[0].reset();
                $('#technician_idError').text(' ');
                $('.yajra-datatable').DataTable().ajax.reload(null, false);
                toastr.success('Technician Assign  Successful', 'Success');
            },
            error: function (response) {
                $('#technician_idError').text(response.responseJSON.errors.technician_id);
            }
        });
    });

    // expair user
    function expier_user(id) {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })
        swalWithBootstrapButtons({
            title: 'Are you sure Want To Expire this user?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Expire it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    type: 'get',
                    url: '{{ url('admin/user_delete') }}/' + id,
                    success: function (response) {
                        if (response) {
                            toastr.success('Expired Successful', 'Successful');
                            $('.yajra-datatable').DataTable().ajax.reload(null, false);
                        }
                    }
                });
            } else if (
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

    function active_user(id) {
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
                    url: '{{ url('admin/active_user') }}/' + id,
                    success: function (response) {
                        if (response) {
                            toastr.success('Activated Successful', 'Successful');
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

    // open sms model
    function open_send_sms_modal(id) {
        $('#send_personalsms').modal('show');
        document.getElementById('personal_sms_body_user_id').value = id;
    }

    // send personal sms
    $('#send_personal_sms').on('submit', function (event) {
        event.preventDefault();
        $('#personal_sms_bodyError').text('');
        $.ajax({
            url: '{{ url('admin/sms/single_sms') }}',
            type: "POST",
            data: {
                user_id: $('#personal_sms_body_user_id').val(),
                personal_sms_body: $('#personal_sms_body').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response) {
                    $('#send_personalsms').modal('hide');
                    $("#personal_sms_body").val('');
                    toastr.success('Sms send Successfully', 'Send');
                }
            },
            error: function (response) {
                if (response.responseJSON.errors.personal_sms_body) {
                    toastr.error('Please Write a Valid Sms', 'warning');
                }
                $('#personal_sms_bodyError').text(response.responseJSON.errors.personal_sms_body);
            }
        });
    });

    // Billing Schedule
    $('#bill_shedule_form').on('submit', function (event) {
        event.preventDefault();
        $('#noteError').text('');
        $('#schedule_dateError').text('');
        $.ajax({
            url: '{{ url('admin/bill_schedule') }}',
            type: "POST",
            data: {
                note: $('#note').val(),
                schedule_date: $('#schedule_date').val(),
                user_id: $('#billing_user_id').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response) {
                    $('#bill_shedule').modal('hide');
                    $("#schedule_date").val('');
                    $("#note").val('');
                    toastr.success('Billing Schedule Save Successful', 'Successful');
                }
            },
            error: function (response) {
                $('#noteError').text(response.responseJSON.errors.note);
                $('#schedule_dateError').text(response.responseJSON.errors.schedule_date);
            }
        });
    });

    function bill_user_id(user_id) {

        document.getElementById('billing_user_id').value = user_id;
    }

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function show_devices(id) {
        $('#active_panel').html(
            '<div class="loader"> <span></span> <span></span> <span></span> <span></span> <span></span> </div>');
        $('#inactive_panel').html(
            '<div class="loader"> <span></span> <span></span> <span></span> <span></span> <span></span> </div>');
        $('#inactive_button').html('Active Devices');
        $('#active_button').html('InActive Devices');
        $('#object_expaire_dateError').html('');
        $('#all_object').modal('show');
        $.ajax({
            url: '{{ url('admin/show_devices') }}/' + id,
            type: "GET",
            success: function (response) {
                // console.log(response.active)
                if (response == "user not found") {
                    toastr.error('', 'Not Find');
                } else {
                    $('#active_panel').html(response.active)
                    $('#inactive_panel').html(response.inactive)
                }
            },
            error: function (response) {
                if (response.responseJSON.errors.personal_sms_body) {
                    toastr.error('Please Write a Valid Sms', 'warning');
                }
            }
        });
    }

    // action on active object
    $('#active_object_form').on('submit', function (event) {
        event.preventDefault();
        $('.active_button').html(
            '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        var favorite = [];
        $.each($("input[name='object_name_active']:checked"), function () {
            favorite.push($(this).val());
        });
        $.ajax({
            url: '{{ url('admin/deactive_object') }}',
            type: "POST",
            data: {
                user_id: $('#object_user_id').val(),
                active_object: favorite,
                _token: '{{ csrf_token() }}'
            },

            success: function (response) {
                console.log(response);
                if (response) {
                    $('#all_object').modal('hide');
                    $("#active_panel").val('');
                    $("#inactive_panel").val('');
                    toastr.success('Object InActive Successful', 'Successful');
                }
            },
            error: function (response) {

            }
        });
    });


    // action on inactive object
    $('#inactive_object_form').on('submit', function (event) {
        event.preventDefault();
        $('.active_button').html(
            '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        var favorite = [];
        $.each($("input[name='object_name_inactive']:checked"), function () {
            favorite.push($(this).val());
        });
        $.ajax({
            url: '{{ url('admin/active_object') }}',
            type: "POST",
            data: {
                user_id: $('#object_user_id').val(),
                active_object: favorite,
                expaire_date: $('#object_expaire_date').val(),
                _token: '{{ csrf_token() }}'
            },

            success: function (response) {
                console.log(response);
                if (response) {
                    $('#all_object').modal('hide');
                    $("#active_panel").val('');
                    $("#inactive_panel").val('');
                    toastr.success('Object Active Successful', 'Successful');
                }
            },
            error: function (response) {
                $('#object_expaire_dateError').text(response.responseJSON.errors.expaire_date);
                $('#inactive_button').html('Active Devices');
                $('#active_button').html('InActive Devices');
            }
        });
    });
</script>
