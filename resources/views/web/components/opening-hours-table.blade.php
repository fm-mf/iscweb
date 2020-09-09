<table class="opening-hours">
    @foreach($openingHours as $day => $hours)
        <tr>
            <th>@lang("web.days.{$day}")</th>
            @if(hash_equals($hours, 'Closed'))
                <td>@lang('web.closed')</td>
            @else
                <td>{{ str_replace('-', '–', $hours) }}</td>
            @endif
        </tr>
    @endforeach
</table>
