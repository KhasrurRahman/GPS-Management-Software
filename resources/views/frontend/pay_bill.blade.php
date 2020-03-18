@extends('frontend.layout.app')
@section('title','Pay Bill')
@push('css')
@endpush
@section('content')



   <div class="tm-padding-section" style="height: 700px;background: #19A6B4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 justify-content-center" style="margin-top: 7%;">
                            <form action="#" class="tm-form tm-login-form tm-form-bordered" style="background: #F8F8F8">
                                @csrf
                                <h4 class="text-center">Enter Your Registered Phone Number</h4>
                                <div class="tm-form-inner">
                                    <div class="tm-form-field">
                                        <label for="login-email">Phone Number*</label>
                                        <input type="number" id="search" required="required" name="phone" autocomplete="off">
                                    </div>
                                    <div class="loader" style="display: none">
                                        <img src="{{asset('public/assets/frontend/images/bg/abc.gif')}}" alt="" style="width: 50px;height:50px;">
                                    </div>

                                    <div class="alert alert-success text-center w-100" id="message" style="display: none"></div>
                                    <div class="alert alert-danger text-center w-100" id="message2" style="display: none"></div>
                                    <p id="show_bill" style="display: none;color: #0d8d2d;font-weight: bold">Your Mothly Bill: </p>
                                    <p id="show_due_month" style="display: none;color: #0d8d2d;font-weight: bold">Number Of Due Months: </p>
                                    <p id="total_due" style="display: none;color: red;font-weight: bold">Your Total Due: </p>

                                    <div class="tm-form-field" id="payment_button" style="display: none">
                                        <a href="" class="btn btn-primary btn-block" data-toggle="modal" data-target="#payment_status" style="color: white">Pay Bill<b></b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                <div class="col-lg-6 justify-content-center">
                   <img src="{{asset('public/assets/frontend/images/bg/SSLCommerz-Pay-With-logo-All-Size-04.png')}}" alt="logo">
                </div>

            </div>
        </div>
   </div>


  <!-- Modal -->
<div class="modal fade" id="payment_status" tabindex="-1" role="dialog" aria-labelledby="payment_statusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="" method="post" id="form">
            @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="payment_statusLabel">Update Payment Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Number Of Month</label>
                    <input type="number" class="form-control" id="month" placeholder="Number Of Months" name="number_of_months" onkeyup="calculateAmount()">
                    <input type="hidden" id="user_id" value="" name="user_id">
                    <input type="hidden" id="monthly_bill" value="">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">payment Amount</label>
                    <input readonly type="number" class="form-control" id="amount" placeholder="Amount" name="amount" value="">
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Pay</button>
      </div>
         </form>
    </div>
  </div>
</div>




@endsection
@push('js')

<script>
            $(document).ready(function () {

                function fetch_customer_data(query) {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('phone_number_search') }}",
                        method:"POST",
                        data:{query: query, _token: _token},
                        success:function(data)
                        {
                            if(data !== 'null'){
                                $('#message2').hide();
                                $('#show_bill').show();
                                $('#show_due_month').show();
                                $('#total_due').show();
                                $('#message').show();
                                $('#message').text('User matched');
                                $('#payment_button').show();
                                a = document.getElementById('form');
                                a.setAttribute("action", "/safetygpstracker/bill_payment_pay/"+data.user.id);
                                document.getElementById('user_id').value = data.user.id;
                                document.getElementById('monthly_bill').value = data.user.monthly_bill;
                                $("#show_bill").empty();
                                document.getElementById('show_bill').append('Your Mothly Bill: '+data.user.monthly_bill);
                                $("#show_due_month").empty();
                                document.getElementById('show_due_month').append('Number Of Due Months: '+data.due_month);
                                $("#total_due").empty();
                                document.getElementById('total_due').append('Your Total Due: '+data.due_month * data.user.monthly_bill);
                            }else{
                                $('.loader').show();
                                setTimeout(function() { $('.loader').hide(); }, 500);
                                $('#message').hide();
                                $('#show_bill').hide();
                                $('#show_due_month').hide();
                                $('#total_due').hide();
                                $('#message2').show();
                                $('#payment_button').hide();
                                $('#message2').text('No data Found');
                            }
                        }
                       })
                      }


                $(document).on('keyup', '#search', function () {
                    var query = $(this).val();
                    fetch_customer_data(query);
                });


            });
</script>



<script>
    function calculateAmount() {
                var months = document.getElementById("month").value;
                var monthly_bill = document.getElementById("monthly_bill").value;

                var tot_price = months * monthly_bill;
                var divobj = document.getElementById('amount');
                divobj.value = tot_price;
            }
</script>
@endpush
