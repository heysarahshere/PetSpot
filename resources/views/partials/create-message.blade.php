<div class="col-12" style="margin: 0 auto; text-align: center">
    <h2>Reply to {{ $post->author }}</h2>
    <form name="private-message" method="POST" action="{{route('send-message')}}">

        <h3>Subject</h3>
        <div class="form-row">
            <div class="form-group col-md-12">
                <input type="text" name="subject" id="subject" class="form-control"
                       placeholder="Subject" value="RE: {{ $post->title }}">
            </div>
        </div>
        <h3>Message</h3>
        <div class="form-row">
            <textarea rows="5" id="content" name="content"
                      class="form-control my-comment">{!! old('message') !!}</textarea>
        </div>

        <input type="hidden" value="{{ $post->user_id }}" name="receiver_id" id="receiver_id">
        <div class="form-group pt-3">
            <button type="submit" class="btn ombre">Send Message</button>
        </div>
        {{ csrf_field() }}
    </form>
</div>
