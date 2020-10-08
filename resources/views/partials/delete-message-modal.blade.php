<div class="col-md-10" style="margin: 0 auto; text-align: center">
    <h2 id="alertTitle">Delete Message?</h2>
    <form method="POST" action="{{route('delete-message')}}">
        <p style="color: #3e3e3e; font-weight: bold">The message will still be visible to others in the conversation.</p>
        <input type="hidden" value="" name="message_id" id="message_id">
        <input type="hidden" value="" name="thread_id" id="thread_id">
        <div class="form-group pt-3">
            <button type="submit" class="btn ombre">Delete</button>
            <button data-toggle="modal" data-dismiss="modal" class="btn rev-ombre">Cancel</button>
        </div>
        {{ csrf_field() }}
    </form>
</div>
