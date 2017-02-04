<div class="menu-wrapper">
    <div class="container">
        <div class="row">
            <div class="collapse navbar-collapse navbar-main-collapse col-sm-9">
                <ul class="nav navbar-nav admin-nav">
                    <li><a href="{{ url('partak/') }}" @if(Request::is('partak')) class="active" @endif>Dashboard</a></li>
                    <li><a href="{{ url('partak/users/buddies') }}" @if(Request::is('partak/users/*')) class="active" @endif>Users</a></li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- /menu-wrapper -->