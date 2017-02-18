<div class="menu-wrapper">
    <div class="container">
        <div class="row">
            <div class="collapse navbar-collapse navbar-main-collapse col-sm-9">
                <ul class="nav navbar-nav admin-nav">
                    <li><a href="{{ url('partak/') }}" @if(Request::is('partak')) class="active" @endif>Dashboard</a></li>
                    @can('acl', 'users.view')
                    <li><a href="{{ url('partak/users') }}" @if(Request::is('partak/users/*')) class="active" @endif>Users</a></li>
                    @endcan
                    <li><a href="{{ url('partak/trips') }}" @if(Request::is('partak/trips') || Request::is('partak/trips/*')) class="active"@endif>Trips</a></li>

                    @can('acl', 'events.view')
                        <li><a href="{{ url('partak/events') }}" @if(Request::is('partak/events') || Request::is('partak/events/*')) class="active"@endif>Events</a></li>
                    @endcan

                </ul>
            </div>
        </div>
    </div>
</div><!-- /menu-wrapper -->