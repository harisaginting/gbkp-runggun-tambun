@if(Session::has('notification'))
    <div class="alert alert-info alert-block">
        <strong>{{ Session::get('notification') }}</strong>
    </div>
@endif