<nav class="guide-nav navbar navbar-expand-md navbar-light">
    <div class="container">
        <div class="d-lg-none d-md-none d-flex flex-grow-1">
            <div class="navbar-brand">
                Survival Guide
            </div>

            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target=".navbar-guide-collapse" aria-controls="navbar-guide-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse navbar-guide-collapse guide-nav-items flex-grow-1 flex-column">
            <div class="search">
                <script async src="https://cse.google.com/cse.js?cx=004292872103075398046:z2zaxsglepy"></script>
                <div class="gcse-search"></div>
            </div>

            <ul class="nav flex-grow-1">
                <li class="blue">
                    <a data-toggle="collapse" data-target="#first-steps" @if(isset($firstSteps)) class="expanded" @endif>First steps</a>
                    <ul id="first-steps" class="nav collapse @if(isset($firstSteps)) in show @endif">
                        @component('guide.components.nav-item', ['page' => 'introduction', 'title' => 'Introduction', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'welcome-pack', 'title' => 'Welcome pack', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'orientation-week', 'title' => 'Orientation week', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'cards', 'title' => 'Cards', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'kos', 'title' => 'KOS & Classes registration', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'eduroam', 'title' => 'Eduroam', 'active' => $active])@endcomponent
                    </ul>
                </li>
                <li class="purple">
                    <a data-toggle="collapse" data-target="#about-ctu" @if(isset($aboutCtu)) class="expanded" @endif>CTU &amp; Useful information</a>
                    <ul id="about-ctu" class="nav collapse @if(isset($aboutCtu)) in show @endif">
                        @component('guide.components.nav-item', ['page' => 'academic-year', 'title' => 'Academic year calendar', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'campus', 'title' => 'Campus', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'classrooms', 'title' => 'Classrooms location', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'dormitories', 'title' => 'Dormitories', 'active' => $active])@endcomponent
                    </ul>
                </li>
                <li class="green">
                    <a data-toggle="collapse" data-target="#czech-it-out" @if(isset($czechItOut)) class="expanded" @endif>Czech it out!</a>
                    <ul id="czech-it-out" class="nav collapse @if(isset($czechItOut)) in show @endif">
                        @component('guide.components.nav-item', ['page' => 'visa', 'title' => 'Visa', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'visa-example-pictures', 'title' => 'Visa examples', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'health-care', 'title' => 'Health care', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'living-in-prague', 'title' => 'Living in Prague', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'transportation', 'title' => 'Transportation', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'money-exchange', 'title' => 'Money exchange', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'post-office', 'title' => 'Post office', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'phone', 'title' => 'Important numbers', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'culture-shock', 'title' => 'Culture shock', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'czech-phrases', 'title' => 'Czech phrases', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'funny-facts', 'title' => 'Funny facts', 'active' => $active])@endcomponent
                    </ul>
                </li>
                <li class="orange">
                    <a data-toggle="collapse" data-target="#isc-esn" @if(isset($iscEsn)) class="expanded" @endif>ESN</a>
                    <ul id="isc-esn" class="nav collapse @if(isset($iscEsn)) in show @endif">
                        @component('guide.components.nav-item', ['page' => 'esn-ctu-intro', 'title' => 'ESN CTU', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'esn-intro', 'title' => 'ESN', 'active' => $active])@endcomponent
                        @component('guide.components.nav-item', ['page' => 'esn-partners', 'title' => 'Our partners', 'active' => $active])@endcomponent
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
