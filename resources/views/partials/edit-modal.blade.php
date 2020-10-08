<div class="col-md-10" style="margin: 0 auto; text-align: center">
    <h1 id="alertTitle">Update Alert</h1>
    <form method="POST" action="{{route('update-alert')}}">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="alert_state">State</label>
                <select required id="alert_state" name="alert_state" class="form-control">
                    <option value="{{ old('state') }}" selected></option>
                    <option>Alaska</option>
                    <option>Alabama</option>
                    <option>Arkansas</option>
                    <option>Arizona</option>
                    <option>California</option>
                    <option>Colorado</option>
                    <option>Connecticut</option>
                    <option>District of Columbia</option>
                    <option>Delaware</option>
                    <option>Florida</option>
                    <option>Georgia</option>
                    <option>Hawaii</option>
                    <option>Iowa</option>
                    <option>Idaho</option>
                    <option>Illinois</option>
                    <option>Indiana</option>
                    <option>Kansas</option>
                    <option>Kentucky</option>
                    <option>Louisiana</option>
                    <option>Massachusetts</option>
                    <option>Maryland</option>
                    <option>Maine</option>
                    <option>Michigan</option>
                    <option>Minnesota</option>
                    <option>Missouri</option>
                    <option>Mississippi</option>
                    <option>Montana</option>
                    <option>North Carolina</option>
                    <option>North Dakota</option>
                    <option>Nebraska</option>
                    <option>New Hampshire</option>
                    <option>New Jersey</option>
                    <option>New Mexico</option>
                    <option>Nevada</option>
                    <option>New York</option>
                    <option>Ohio</option>
                    <option>Oklahoma</option>
                    <option>Oregon</option>
                    <option>Pennsylvania</option>
                    <option>Puerto Rico</option>
                    <option>Rhode Island</option>
                    <option>South Carolina</option>
                    <option>South Dakota</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Utah</option>
                    <option>Virginia</option>
                    <option>Vermont</option>
                    <option>Washington</option>
                    <option>Wisconsin</option>
                    <option>West Virginia</option>
                    <option>Wyoming</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="alert_type">Animal Type:</label>
                <select required id="alert_type" name="alert_type" class="form-control">
                    <option value="{{ old('alert_type') }}" selected></option>
                    <option>Cat</option>
                    <option>Dog</option>
                    <option>Bird</option>
                    <option>Other</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="alert_state">Notify me at:</label>
                <input class="form-control" style="text-align: center" type="email" id='alert_email'
                       name='alert_email' value="{{ old('alert_email') }}" placeholder="Email" required>
            </div>
                <input type="hidden" id='alert_hidden_id' name='alert_hidden_id' value="">
        </div>
        <input type="hidden" value="" name="type" id="type">
        <div class="form-group pt-3">
            <button type="submit" class="btn ombre">Update Alert</button>
        </div>
        {{ csrf_field() }}
    </form>
    <a data-toggle="modal" data-dismiss="modal">Cancel Alert Update</a>
</div>
