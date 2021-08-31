<form id="search_form" name="search_form">
    <div class="row">
        <div class="col-3">
            <label>Start Date</label>
            <input class="form-control form-control" type="date" id="start_date"  name="start_date">
        </div>
        
        <div class="col-3">
            <label>End Date</label>
            <input class="form-control form-control" type="date" id="end_date"  name="end_date">
        </div>
        
        <div class="col-3">
            <label>User Name</label>
            <input class="form-control form-control" type="text" id="name"  name="name">
        </div>
        
        <div class="col-3">
            <label>User Phone</label>
            <input class="form-control form-control" type="text" id="phone"  name="phone">
        </div>
        
        <div class="col-3">
            <label>User Email</label>
            <input class="form-control form-control" type="text" id="email"  name="email">
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
