<div class="col-md-10" style="margin: 0 auto; text-align: center">
    <h2>Confirm old password</h2>
    <form method="POST" action="{{route('change-password')}}">
        <div class="form-row">
            <div class="form-group col-md-12">
                <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <input onchange="checkOld(this)" type="password" name="old_password_confirmation" id="old_password_confirmation"
                       class="form-control" placeholder="Re-type Old Password" required>
            </div>
        </div>
        <script language='javascript' type='text/javascript'>
            function checkOld(input) {
                if (input.value != document.getElementById('old_password').value) {
                    input.setCustomValidity('Must match old password.');
                } else {
                    // input is valid -- reset the error message
                    input.setCustomValidity('');
                }
            }
        </script>
        <h2>Enter new password</h2>
        <div class="form-row">
            <div class="form-group col-md-12">
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <input onchange="checkNew(this)" type="password" name="new_password_confirmation"
                       id="new_password_confirmation" class="form-control" placeholder="Confirm New Password" required>
            </div>
        </div>
        <script language='javascript' type='text/javascript'>
            function checkNew(input) {
                if (input.value != document.getElementById('new_password').value) {
                    input.setCustomValidity('Must match new password.');
                } else {
                    // input is valid -- reset the error message
                    input.setCustomValidity('');
                }
            }
        </script>
        <input type="hidden" value="" name="type" id="type">
        <div class="form-group pt-3">
            <button type="submit" class="btn ombre">Change Password</button>
        </div>
        {{ csrf_field() }}
    </form>
    <a data-toggle="modal" data-dismiss="modal">Cancel</a>
</div>
