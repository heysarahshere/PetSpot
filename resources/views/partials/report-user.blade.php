<div class="col-12" style="margin: 0 auto; text-align: center">
    <h2>Report a User</h2>
    <form name="report" method="POST" action="{{route('report-user')}}">

        <h3>Username</h3>
        <div class="form-row">
            <div class="form-group col-md-12">
                <input type="text" name="subject" id="subject" class="form-control"
                       placeholder="Username" required value="REPORTING: {{ $user->userName }}">
            </div>
        </div>
        <h3>Reason for Reporting</h3>
        <div class="form-row">
            <select class="form-control form-control-lg" id="reason"  name="reason">
                <option selected value="{{ old('reason') }}" required></option>
                <option>Illegal Activity</option>
                <option>Harassment or Bullying</option>
                <option>Over-Posting</option>
                <option>Hate Speech/Discrimination</option>
                <option>Nudity or Pornography</option>
                <option>Underage</option>
                <option>Impersonation</option>
                <option>Spam or Fraud</option>
            </select>
        </div>
        <h3 class="pt-2">Is there anything else we should know?</h3>
        <div class="form-row pt-2">
            <textarea rows="2" id="other" name="other"
                      class="form-control">{{ old('other') }}</textarea>
        </div>

        <input type="hidden" value="{{ $user->id }}" name="user_id" id="user_id">
        <div class="form-group pt-3">
            <button type="submit" class="btn ombre">Report User</button>
        </div>
        {{ csrf_field() }}
    </form>
</div>
