<div class="modal fade" id="assign_technician" tabindex="-1" role="dialog" aria-labelledby="assign_technicianLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form  id="technician_assign_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assign_technicianLabel">Assign Technician</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="hidden_user_id" name="user_id">
                        <input type="hidden" value="" id="hidden_order_id" name="order_id">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Technician Name</label>
                            <select class="form-control" id="technican_data" name="technician_id" required>
                                <option selected disabled>Select Technician</option>
                                @foreach($technician as $technician_data)
                                    <option value="{{$technician_data->id}}">{{$technician_data->name}}</option>
                                @endforeach
                            </select>
                             <span id="technician_idError" class="text-red error_field"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Collect Amount</label>
                            <input type="number" class="form-control" id="collect_amount" name="collect_amount">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="0" onclick="hidetable()" name="for_repair" id="for_repair"> Only For Repair</label>
                        </div>
                        <table class="table table-bordered" id="dynamic_field">
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>

                </form>

            </div>
        </div>
    </div>