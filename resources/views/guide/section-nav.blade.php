<ul class="section-navigation">
  @foreach ($items as $id => $title)
  <li>
    @if (!is_array($title))
    <a href="#{{ $id }}">{{ $title }}</a>
    @else
    <a href="#{{ $id }}">{{ $title['title'] }}</a>
    @component('guide.section-nav', ['items' => $title['items']])
    @endcomponent
    @endif
  </li>
  @endforeach
</ul>
