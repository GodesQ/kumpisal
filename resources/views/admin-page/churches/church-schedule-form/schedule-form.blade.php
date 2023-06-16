<table class="table table-bordered schedule-table">
    <thead>
        <tr>
            <th width="30%">
                <h4>Day</h4>
            </th>
            <th width="50%">
                <h4>Time</h4>
            </th>
            <th width="20%" align="center">
                <h4>Action</h4>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="monday_sched" name="has_monday_sched" value="monday">
                    <label class="form-label" for="monday_sched">
                        <h5>Monday</h5>
                    </label>
                </div>
            </td>
            <td>
                <div id="monday_sched_container">
                    <div id="monday_repeater_form">
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <input type="time" name="monday_sched_starttime[]" class="form-control monday_sched_starttime">
                            </div>
                            <div class="col-lg-4">
                                <input type="time" name="monday_sched_endtime[]" class="form-control monday_sched_endtime">
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeater(this)"><i class="ti ti-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td align="center" valign="center">
                <button type="button" class="btn btn-primary" onclick="addRepeaterForm('monday_sched_container')">Add <i class="ti ti-plus"></i></button>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="tuesday_sched" name="has_tuesday_sched" value="tuesday">
                    <label class="form-label" for="tuesday_sched">
                        <h5>Tuesday</h5>
                    </label>
                </div>
            </td>
            <td>
                <div id="tuesday_sched_container">
                    <div id="tuesday_repeater_form">
                        <div class="row my-2" >
                            <div class="col-lg-4">
                                <input type="time" name="tuesday_sched_starttime[]" class="form-control tuesday_sched_starttime">
                            </div>
                            <div class="col-lg-4">
                                <input type="time" name="tuesday_sched_endtime[]" class="form-control tuesday_sched_endtime">
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeater(this)"><i class="ti ti-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td align="center" valign="center">
                <button type="button" class="btn btn-primary" onclick="addRepeaterForm('tuesday_sched_container')">Add <i class="ti ti-plus"></i></button>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="wednesday_sched" name="has_wednesday_sched" value="wednesday">
                    <label class="form-label" for="wednesday_sched">
                        <h5>Wednesday</h5>
                    </label>
                </div>
            </td>
            <td>
                <div id="wednesday_sched_container">
                    <div id="wednesday_repeater_form">
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <input type="time" name="wednesday_sched_starttime[]" class="form-control wednesday_sched_starttime">
                            </div>
                            <div class="col-lg-4">
                                <input type="time" name="wednesday_sched_endtime[]" class="form-control wednesday_sched_endtime">
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeater(this)"><i class="ti ti-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td align="center" valign="center">
                <button type="button" class="btn btn-primary" onclick="addRepeaterForm('wednesday_sched_container')">Add <i class="ti ti-plus"></i></button>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="thursday_sched" name="has_thursday_sched" value="thursday">
                    <label class="form-label" for="thursday_sched">
                        <h5>Thursday</h5>
                    </label>
                </div>
            </td>
            <td>
                <div id="thursday_sched_container">
                    <div id="thursday_repeater_form">
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <input type="time" name="thursday_sched_starttime[]" class="form-control thursday_sched_starttime">
                            </div>
                            <div class="col-lg-4">
                                <input type="time" name="thursday_sched_endtime[]" class="form-control thursday_sched_endtime">
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeater(this)"><i class="ti ti-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td align="center" valign="center">
                <button type="button" class="btn btn-primary" onclick="addRepeaterForm('thursday_sched_container')">Add <i class="ti ti-plus"></i></button>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="friday_sched" name="has_friday_sched" value="friday">
                    <label class="form-label" for="friday_sched">
                        <h5>Friday</h5>
                    </label>
                </div>
            </td>
            <td>
                <div id="friday_sched_container">
                    <div id="friday_repeater_form">
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <input type="time" name="friday_sched_starttime[]" class="form-control friday_sched_starttime">
                            </div>
                            <div class="col-lg-4">
                                <input type="time" name="friday_sched_endtime[]" class="form-control friday_sched_endtime">
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeater(this)"><i class="ti ti-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td align="center" valign="center">
                <button type="button" class="btn btn-primary" onclick="addRepeaterForm('friday_sched_container')">Add <i class="ti ti-plus"></i></button>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="saturday_sched" name="has_saturday_sched" value="saturday">
                    <label class="form-label" for="saturday_sched">
                        <h5>Saturday</h5>
                    </label>
                </div>
            </td>
            <td>
                <div id="saturday_sched_container">
                    <div id="saturday_repeater_form">
                        <div class="row my-2" >
                            <div class="col-lg-4">
                                <input type="time" name="saturday_sched_starttime[]" class="form-control saturday_sched_starttime">
                            </div>
                            <div class="col-lg-4">
                                <input type="time" name="saturday_sched_endtime[]" class="form-control saturday_sched_endtime">
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeater(this)"><i class="ti ti-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </td>
            <td align="center" valign="center">
                <button type="button" class="btn btn-primary" onclick="addRepeaterForm('saturday_sched_container')">Add <i class="ti ti-plus"></i></button>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sunday_sched" name="has_sunday_sched" value="sunday">
                    <label class="form-label" for="sunday_sched">
                        <h5>Sunday</h5>
                    </label>
                </div>
            </td>
            <td>
                <div id="sunday_sched_container">
                    <div id="sunday_repeater_form">
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <input type="time" name="sunday_sched_starttime[]" class="form-control sunday_sched_starttime">
                            </div>
                            <div class="col-lg-4">
                                <input type="time" name="sunday_sched_endtime[]" class="form-control sunday_sched_endtime">
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeater(this)"><i class="ti ti-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td align="center" valign="center">
                <button type="button" class="btn btn-primary" onclick="addRepeaterForm('sunday_sched_container')">Add <i class="ti ti-plus"></i></button>
            </td>
        </tr>
    </tbody>
</table>

@push('scripts')
    <script>
        function addRepeaterForm(container) {
            let parentContainer = document.querySelector(`#${container}`);
            let repeaterForm = parentContainer.children[0];

            let new_repeater_form = document.createElement('div');
            new_repeater_form.innerHTML = repeaterForm.innerHTML;

            parentContainer.appendChild(new_repeater_form);
        }

        function removeRepeater(e) {
           let parentRepeaterForm = e.parentElement.parentElement.parentElement;
            if(parentRepeaterForm.parentElement.children.length > 1) {
                parentRepeaterForm.remove();
            };
        }
    </script>
@endpush
