<div class="col-12" style="margin: 0 auto; text-align: center">
    <h2>Report Post by {{ $post->author }}</h2>
    <form name="report" method="POST" action="{{route('send-report')}}">

        <h3>Post Name</h3>
        <div class="form-row">
            <div class="form-group col-md-12">
                <input type="text" name="subject" id="subject" class="form-control"
                       placeholder="Post Name" required value="REPORTING: {{ $post->title }}">
            </div>
        </div>
        <h3>Reason for Reporting</h3>
        <div class="form-row">
                <select class="form-control form-control-lg" id="reason"  name="reason">
                    <option selected value="{{ old('reason') }}" required></option>
                    <option>Vulgar or Offensive</option>
                    <option>Wrong Forum Category</option>
                    <option>Spam or Commercial</option>
                    <option>Over-Posting</option>
                    <option>Not Relevant/Annoying</option>
                    <option>Safety Issue/Fraud/Illegal</option>
                    <option>Posted in Error</option>
                </select>
            </div>
        <h3 class="pt-2">Is there anything else we should know?</h3>
        <div class="form-row pt-2">
            <textarea rows="2" id="other" name="other"
                      class="form-control">{{ old('other') }}</textarea>
        </div>

            <input type="hidden" value="{{ $post->id }}" name="post_id" id="post_id">
        <div class="form-group pt-3">
            <button type="submit" class="btn ombre">Report Post</button>
        </div>
        {{ csrf_field() }}
    </form>
</div>
