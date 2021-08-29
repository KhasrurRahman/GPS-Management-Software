<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Subscriber Information</h3>
        </div>
        <div class="card-body">
            <a href="#" data-toggle="modal" data-target="#srch-rslt-mdl">
                <div class="card bg-warning">
                    <ul class="list-group list-group-flush">
                        <h1 id="totat_subscriber" class="text-center text-bold"></h1>
                        <button type="button" class="btn btn-warning btn-block" data-toggle="modal"
                                data-target="#srch-rslt-mdl">Show Search Result
                        </button>
                    </ul>
                </div>
            </a>
        </div>

        <form id="send_selected_user_sms" class="mt-0">
            <div class="card-body">

                <div class="form-group">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="all_user_sms_body">Sms Body:</label>
                            <textarea class="form-control" name="all_user_sms_body" id="all_user_sms_body" rows="6"></textarea>
                            <span id="all_user_sms_bodyError" class="text-red error_field"></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success">Send</button>
                </div>

            </div>
        </form>
    </div>
</div>

