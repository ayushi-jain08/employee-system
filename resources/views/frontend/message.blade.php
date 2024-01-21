@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <h4>Success!</h4>
        {{ Session::get('success') }}
    </div>
@endif
