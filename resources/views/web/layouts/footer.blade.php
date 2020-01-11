<footer class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <h3>Our channels</h3>
            @include('partials.social-media')
        </div>
        <div class="col-sm-4">
            <h3>Czech members</h3>
            <ul class="list-unstyled">
                <li><a href="{{ route('partak.index') }}">ParťákNet</a></li>
                <li><a href="{{ route('buddy-home') }}">Buddy Program</a></li>
                <li><a href="{{ url('blog') }}">ISC Blog</a></li>
            </ul>
        </div>
        <div class="col-12" style="text-align: center">
            <p><a href="{{ url('/privacy') }}">Privacy policies</a></p>
            <p>© {{ \Carbon\Carbon::today()->year }} | {{ $officialName }}</p>
        </div>
    </div>
</footer>
