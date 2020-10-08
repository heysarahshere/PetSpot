@if(count($errors->all()))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger mb-0 text-center">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
