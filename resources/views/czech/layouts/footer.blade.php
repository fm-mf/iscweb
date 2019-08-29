<footer class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <h3>Sociální sítě</h3>
            @include('partials.social-media')
        </div>
        <div class="col-sm-4">
            <h3>Pro stálé návštěvníky</h3>
            <ul class="list-unstyled">
                <li><a href="{{ action('Partak\DashboardController@index') }}">ParťákNet</a></li>
                <li>
                    <a href="{{ action('Buddyprogram\ListingController@listExchangeStudents') }}">Buddy Program</a>
                </li>
                <li><a href="{{ url('blog') }}">ISC Blog</a></li>
            </ul>
        </div>
        <div class="col-12" style="text-align: center">
            <p><a href="{{ url('/privacy') }}">Zásady zpracování a ochrany osobních údajů</a></p>
            <p>&copy; {{ \Carbon\Carbon::today()->year }} | {{ $officialName }}</p>
        </div>
    </div>
</footer>
