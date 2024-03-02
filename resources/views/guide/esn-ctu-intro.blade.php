@extends('guide.layouts.subpage')

@section('subtitle', 'ESN CTU')

@section('subpage')
    <section id="esn-ctu-intro">
        <h2>{{ $shortName }}</h2>

         @component('guide.components.section-nav', ['items' => [
            'activities' => [
                'title' => 'Activities and events you can participate in with ESN',
                'items' => [
                    'languages' => 'Languages',
                    'sports' => 'Sports',
                    'activities-trips' => 'Activities and trips',
                    'culture-evenings' => 'inteGREAT parties &amp; presentations',

                ]
            ],
            'membership' => [
                'title' => 'ESN membership',
                'items' => [
                    'membership-requirements' => 'What do you need?',
                    'membership-benefits' => 'What do you get?',
                    'membership-gifts' => 'Free gifts for joining'
                ]
            ]
        ]])
        @endcomponent

{{--        TODO say something about ISC and renaming--}}
        <p>The Erasmus Student Network (ESN) at CTU in Prague was established in 1999.
            Our close cooperation with the CTU International Office has enabled rapid improvement
            of the overall international relations at our university.
            ESN at CTU promotes the highest standard of cultural awareness
            and international spirit in order to serve the needs of the modern community of students
            in the 21st century, thereby contributing to a better quality of education world-wide
            through creating a unique partnership among university students
            and sustaining the mutual understanding of our cultural differences.</p>

        <p><strong>Since 2003, {{ $fullName }} is a proud member of ESN Czech Republic.</strong></p>
        <img src="{{ asset('img/logos/esn-ctu-logo-colour.svg') }}" alt="Logo ESN CTU in Prague" title="Logo ESN CTU in Prague" />
    </section>

    <h3 id="activities">Activities and events you can participate in with ESN</h3>

    <h4 id="languages">Languages</h4>
    <dl>
        <dt>Language courses</dt>
            <dd><a href="https://www.esn.cvut.cz/activities/language-programs" target="_blank">https://www.esn.cvut.cz/activities/language-programs</a></dd>
            <dd>Do you wanna teach your native language? Contact our <a href="mailto:languages@esn.cvut.cz">Languages coordinator</a></dd>
        <dt>Café Lingea</dt>
            <dd>chill evenings when you speak English and one another language with the native speakers</dd>
        <dt>Tandem program</dt>
            <dd>you can sign up for the Tandem language programme by signing up at <a href="https://esn.cvut.cz/tandem/" target="_blank">https://esn.cvut.cz/tandem/</a></dd>
    </dl>

    <h4 id="sports">Sports</h4>
    <ul>
        <li>We organise regular sports activities for you - football, floorball, tennis, basketball, volleyball and much more</li>
        <li>For more information visit <a href="https://www.esn.cvut.cz/activities/sports" target="_blank">https://www.esn.cvut.cz/activities/sports</a></li>
    </ul>


    <h4 id="activities-trips">Activities and trips</h4>
    <ul>
        <li>Trips in the Czech Republic and abroad during all the semester</li>
        <li>Hiking trips in the Czech countryside</li>
        <li>Bowling, laser tag, board games, paintball, dance courses</li>
        <li><a href="https://www.facebook.com/pg/esn.ctu.prague/events/" target="_blank">ESN CTU events on Facebook</a></li>
    </ul>

    <h4 id="culture-evenings">inteGREAT parties &amp; presentations</h4>
    <ul>
        <li>Do you wanna discover the beauty of other countries, traditional cuisines and dances?</li>
        <li>Once per week or two we organise inteGREAT parties where you, the international students at CTU,
            have the opportunity to present your country in an informal way</li>
        <li>Members of ESN help you with the preparation and give you some tips and advice</li>
        <li>Parties are held in various clubs in Prague</li>
    </ul>

    <h3 id="membership">ESN membership</h3>
    <p>You can get your membership in the ESN Point at any time in the semester. This membership
        enables you to get many opportunities through ESN. ESN is a voluntary organisation,
        and this small fee helps it to be self-sufficient. </p>

    <h4 id="membership-requirements">What do you need?</h4>
    <ul>
        <li>CZK {{ $membershipFee }}<strong> (cash, no credit card accepted, no foreign currencies accepted)</strong></li>
        <li>1 photo (27 x 35 mm)</li>
    </ul>

    <h4 id="membership-benefits">What do you get?</h4>
    <ul>
        <li>The possibility to join all ESN activities prepared for international students (for free or at a favourable price)</li>
        <li>The possibility to join ESN trips (in Orientation Week and throughout the year)</li>
        <li>access to the ESN Point and its facilities (e.g. computers, internet, etc.)</li>
        <li>discount for printing and copying in the ESN Point</li>
        <li>insurance for ESN activities</li>
    </ul>

    <h4 id="membership-gifts">Free gifts for joining</h4>
    <ul>
        <li>a Czech Data SIM card with a favorable student tariff</li>
        <li>a unique &quot;I WAS THERE&quot; T-shirt</li>
        <li>ESNcard - discounts at <a href="https://www.esncard.org" target="_blank">www.esncard.org</a></li>
    </ul>
@stop
