<div class="guide-nav">           
    <ul class="nav nav-stacked">
        <li class="blue"><a data-toggle="collapse" data-target="#first-steps" @if(isset($firstSteps)) class="expanded" @endif>First steps</a>
            <ul id="first-steps" class="nav nav-stacked collapse @if(isset($firstSteps)) in @endif">
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'introduction']) }}"{!! $active == 'introduction' ? 'class="active"' : '' !!}>Introduction</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'welcome-pack']) }}"{!! $active == 'welcome-pack' ? 'class="active"' : '' !!}>Welcome pack</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'orientation-week']) }}"{!! $active == 'orientation-week' ? 'class="active"' : '' !!}>Orientation week</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'cards']) }}"{!! $active == 'cards' ? 'class="active"' : '' !!}>Cards</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'kos']) }}"{!! $active == 'kos' ? 'class="active"' : '' !!}>KOS &amp; Classes registration</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'eduroam']) }}"{!! $active == 'eduroam' ? 'class="active"' : '' !!}>Eduroam</a></li>
            </ul>
        </li>
        <li class="purple"><a data-toggle="collapse" data-target="#about-ctu" @if(isset($aboutCtu)) class="expanded" @endif>CTU &amp; Useful information</a>
            <ul id="about-ctu" class="nav nav-stacked collapse @if(isset($aboutCtu)) in @endif">
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'academic-year']) }}"{!! $active == 'academic-year' ? 'class="active"' : '' !!}>Academic year calendar</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'campus']) }}"{!! $active == 'campus' ? 'class="active"' : '' !!}>Campus</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'dormitories']) }}"{!! $active == 'dormitories' ? 'class="active"' : '' !!}>Dormitories</a></li>
            </ul>
        </li>
        <li class="green"><a data-toggle="collapse" data-target="#czech-it-out" @if(isset($czechItOut)) class="expanded" @endif>Czech it out!</a>
            <ul id="czech-it-out" class="nav nav-stacked collapse @if(isset($czechItOut)) in @endif">
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'visa']) }}"{!! $active == 'visa' ? 'class="active"' : '' !!}>Visa</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'visa-example-pictures']) }}"{!! $active == 'visa-example-pictures' ? 'class="active"' : '' !!}>Visa examples</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'health-care']) }}"{!! $active == 'health-care' ? 'class="active"' : '' !!}>Health care</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'living-in-prague']) }}"{!! $active == 'living-in-prague' ? 'class="active"' : '' !!}>Living in Prague</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'transportation']) }}"{!! $active == 'transportation' ? 'class="active"' : '' !!}>Transportation</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'money-exchange']) }}"{!! $active == 'money-exchange' ? 'class="active"' : '' !!}>Money exchange</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'post-office']) }}"{!! $active == 'post-office' ? 'class="active"' : '' !!}>Post office</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'phone']) }}"{!! $active == 'phone' ? 'class="active"' : '' !!}>Important numbers</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'culture-shock']) }}"{!! $active == 'culture-shock' ? 'class="active"' : '' !!}>Culture shock</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'czech-phrases']) }}"{!! $active == 'czech-phrases' ? 'class="active"' : '' !!}>Czech phrases</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'funny-facts']) }}"{!! $active == 'funny-facts' ? 'class="active"' : '' !!}>Funny facts</a></li>
            </ul>
        </li>
        <li class="orange"><a data-toggle="collapse" data-target="#isc-esn" @if(isset($iscEsn)) class="expanded" @endif>ISC & ESN</a>
            <ul id="isc-esn" class="nav nav-stacked collapse @if(isset($iscEsn)) in @endif">
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'isc-intro']) }}"{!! $active == 'isc-intro' ? 'class="active"' : '' !!}>ISC</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'esn-intro']) }}"{!! $active == 'esn-intro' ? 'class="active"' : '' !!}>ESN</a></li>
                <li><a href="{{ action('Guide\PageController@showPage', ['page' => 'esn-partners']) }}"{!! $active == 'esn-partners' ? 'class="active"' : '' !!}>Our Partners</a></li>
            </ul>
        </li>
    </ul>
</div>