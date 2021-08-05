<div class="modal fade" id="bill_shedule" tabindex="-1" role="dialog" aria-labelledby="bill_sheduleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="bill_shedule_form" >
                <div class="modal-header">
                    <h5 class="modal-title" id="bill_sheduleLabel">Billing Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" id="billing_user_id" name="user_id">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Comment</label>
                        <input type="text" class="form-control" placeholder="Comment" name="note" id="note"/>
                        <span id="noteError" class="text-red error_field"></span>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">Schedule date</label>
                        <input type="date" class="form-control" placeholder="Schedule Date" name="date" id="schedule_date">
                        <span id="schedule_dateError" class="text-red error_field"></span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>