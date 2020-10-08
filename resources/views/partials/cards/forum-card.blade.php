<a href="{{route('forum-details', ['id' => $post->id])}}">
    <div class="card col-xs-8 col-sm-12 mr-2 my-2">
        <div class="card-body row p-0 mt-2" style="object-fit: cover; overflow: hidden">
            <div class="col-sm-3 col-md-2 forum-thumb m-0">
                @if($post->img)
                    {!! $post->img !!}
                @else
                    <img src='https://pet-spot-bucket.s3.us-west-2.amazonaws.com/empty_dog.jpg' alt="Pet Avatar"/>
                @endif
            </div>

            <div class="col-sm-9 col-md-10 pl-2 ml-0 card-text">
                <div class="float-right m-3 row">
                    <p style="color: #d13b16;"><i class="fa fa-comments"></i> {{count($post->comments)}}</p>
                </div>
                <h2 class="m-0" style="font-weight: bold;">{{$post->title}}</h2>
                <p>Posted by {{$post->author}} {{$post->created_at->diffForHumans()}}</p>
                <p style="color: #d13b16;">{{$post->address_address}}</p>
            </div>
        </div>
    </div>
</a>
