@if (count($errors->all()))
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
