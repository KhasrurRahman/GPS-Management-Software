<form id="search_form" name="search_form">
    <div class="row">
        <div class="col-3">
            <label>Name:</label>
            <div class="form-group">
                <input type="text" class="form-control" name="search_name" id="search_name">
            </div>
        </div>

        <div class="col-3">
            <label>Mobile:</label>
            <div class="form-group">
                <input type="text" class="form-control" name="search_mobile" id="search_mobile">
            </div>
        </div>

        <div class="col-3">
            <label>Email:</label>
            <div class="form-group">
                <input type="text" class="form-control" name="search_email" id="search_email">
            </div>
        </div>

        <div class="col-3">
            <label>Ref. ID:</label>
            <div class="form-group">
                <input type="text" class="form-control" name="search_ref_id" id="search_ref_id">
            </div>
        </div>

        <div class="col-2">
            <label>Car Number:</label>
            <div class="form-group">
                <input type="text" class="form-control" name="search_car_number" id="search_car_number">
            </div>
        </div>

        <div class="col-2">
            <label>User Type</label>
            <select class="form-control search_box_select2" name="search_user_type" id="search_user_type">
                <option selected disabled>Please Select</option>
                <option value="2">Corporate User</option>
                <option value="1">Individual User</option>
            </select>
        </div>

        <div class="col-2">
            <label>Activation Status</label>
            <select class="form-control search_box_select2" name="search_activation_type" id="search_activation_type">
                <option selected disabled>Please Select</option>
                <option value="1">Expire User</option>
                <option value="0">Active User</option>
            </select>
        </div>
        
        <div class="col-2">
            <label>Payment Status</label>
            <select class="form-control search_box_select2" name="search_payment_status" id="search_payment_status">
                <option selected disabled>Please Select</option>
                <option value="1">Paid User</option>
                <option value="0">Unpaid User</option>
            </select>
        </div>


        <div class="col-3">
            <div class="form-group">
                <button type="submit" class="btn btn-success ml-2 btn-block" id="btnFiterSubmitSearch" style="margin-top: 30px">search</button>
            </div>
        </div>

        <div class="col-1">
            <div class="form-group">
                <button type="button" class="btn btn-danger btn-info" onclick="form_reset()" style="margin-top: 30px">Clear</button>
            </div>
        </div>


    </div>

</form>
