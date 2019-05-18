@if(Session::has('errorMessage'))
    <div class="alert alert-danger">
    <p>{{Session::get('errorMessage')}}</p>
    </div>
@endif

@if(Session::has('successMessage'))
    <div class="alert alert-success">
    <p>{{Session::get('successMessage')}}</p>
    </div>
@endif