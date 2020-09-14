<ul class="list-unstyled table">
    <li class="row bg-dark text-light font-weight-bold">
        <div class="col-3 col-md-2">@lang('tandem.list.name')</div>
        <div class="col">@lang('tandem.list.wants-to-teach')</div>
        <div class="col">@lang('tandem.list.wants-to-learn')</div>
    </li>
    @foreach($tandemUsers as $tandemUser)
        @component('tandem.components.tandem-user-list-item', ['tandemUser' => $tandemUser])
        @endcomponent
    @endforeach
</ul>
