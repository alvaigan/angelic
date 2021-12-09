@if (session('success') && !is_array(session('success')))
<div class="row">
    <div class="col">
        <div class="alert alert-success alert-elevate fade show" role="alert">
            <div class="alert-icon"><i class="flaticon2-checkmark"></i></div>
            <div class="alert-text">
                Success!
                <br>
                {{ session('success') }}</a>
            </div>
        </div>
    </div>
</div>
@endif

@if (session('error') && !is_array(session('error')))
<div class="row">
    <div class="col">
        <div class="alert alert-danger alert-elevate fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-close"></i></div>
            <div class="alert-text">
                Whoops! Something went wrong.
                <br>
                {{ session('error') }}
            </div>
        </div>
    </div>
</div>
@endif