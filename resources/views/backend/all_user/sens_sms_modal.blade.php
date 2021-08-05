<div class="modal fade" id="send_personalsms" tabindex="-1" role="dialog" aria-labelledby="send_personalsmsLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="send_personalsmsLabel">Send Personal Sms</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="sms_body_content">
                    <form id="send_personal_sms">
                        <div class="form-group">
                            <input type="hidden" id="personal_sms_body_user_id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="sms_body">Sms Body:</label>
                                    <textarea class="form-control" name="sms_body" id="personal_sms_body"
                                              rows="3"></textarea>
                                    <span id="personal_sms_bodyError" class="text-red error_field"></span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Personal Sms</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
