@extends('layouts.guide.layout')

@section('title', 'ISC &amp; ESN &ndash; ')

@section('content')
    <section id="isc-esn">
        <h1>ISC &amp; ESN</h1>
        <p>The International Student Club (ISC) at CTU in Prague was established in 1999.
            Our close cooperation with the CTU International Office has enabled rapid improvement
            of the overall international relations at our university.
            ISC at CTU promotes the highest standard of cultural awareness
            and international spirit in order to serve the needs of the modern community of students
            in the 21st century, thereby contributing to a better quality of education world-wide
            through creating a unique partnership among university students
            and sustaining the mutual understanding of our cultural differences.</p>
        <img src="{{ asset('img/saf/logo-isc-vertikalni-barevne.svg') }}" alt="Logo ISC CTU in Prague" title="Logo ISC CTU in Prague" />
        <img src="{{ asset('img/saf/logo-esn.png') }}" alt="Logo ESN" title="Logo ESN" />
    </section>

    <h2>Activities and events you can participate in with ISC</h2>

    <h3>Languages</h3>
    <dl>
        <dt>Language courses</dt>
            <dd><a href="https://www.isc.cvut.cz/activities/language-programs" target="_blank">https://www.isc.cvut.cz/activities/language-programs</a></dd>
            <dd>Do you wanna teach your native language? Contact our <a href="mailto:languages@isc.cvut.cz">Languages coordinator</a></dd>
        <dt>Café Lingea</dt>
            <dd>chill evenings when you speak English and one another language with the native speakers</dd>
        <dt>Tandem program</dt>
            <dd>you can sign up for the Tandem language programme by signing up at <a href="https://isc.cvut.cz/tandem/" target="_blank">https://isc.cvut.cz/tandem/</a></dd>
    </dl>

    <h3>Sports</h3>
    <ul>
        <li>We organise regular sports activities for you - football, floorball, tennis, basketball, volleyball and much more</li>
        <li>For more information visit <a href="https://www.isc.cvut.cz/activities/sports" target="_blank">https://www.isc.cvut.cz/activities/sports</a></li>
    </ul>


    <h3>Activities and trips</h3>
    <ul>
        <li>Trips in the Czech Republic and abroad during all the semester</li>
        <li>Hiking trips in the Czech countryside</li>
        <li>Bowling, laser tag, board games, paintball, dance courses</li>
        <li><a href="https://www.facebook.com/pg/isc.ctu.prague/events/" target="_blank">ISC events on Facebook</a></li>
    </ul>

    <h3>inteGREAT parties &amp; presentations</h3>
    <ul>
        <li>Do you wanna discover the beauty of other countries, traditional cuisines and dances?</li>
        <li>Once per week or two we organise inteGREAT parties where you, the international students at CTU,
            have the opportunity to present your country in an informal way</li>
        <li>Members of ISC help you with the preparation and give you some tips and advice</li>
        <li>Parties are held in various clubs in Prague</li>
        <li><a href="https://www.facebook.com/inteGREATParty/" target="_blank">inteGREAT Facebook page</a></li>
    </ul>

    <h2>ISC membership</h2>
    <p>You can get your membership in the ISC Point at any time in the semester. This membership
        enables you to get many opportunities through ISC. ISC is a voluntary organisation,
        and this small fee helps it to be self-sufficient. </p>

    <h3>What do you need?</h3>
    <ul>
        <li>CZK 500<strong> (cash, no credit card accepted, no foreign currencies accepted)</strong></li>
        <li>1 photo (27 x 35 mm)</li>
    </ul>

    <h3>What do you get?</h3>
    <ul>
        <li>The possibility to join all ISC activities prepared for international students (for free or at a favourable price)</li>
        <li>The possibility to join ISC trips (in Orientation Week and throughout the year)</li>
        <li>weekly info about upcoming activities</li>
        <li>access to the ISC Point and its facilities (e.g. computers, internet, etc.)</li>
        <li>discount for printing and copying in the ISC Point</li>
        <li>insurance for ISC activities</li>
    </ul>

    <h3>Free gifts for joining</h3>
    <ul>
        <li>a Czech Data SIM card with a favorable student tariff</li>
        <li>a unique &quot;I WAS THERE&quot; T-shirt</li>
        <li>ESNcard - discounts at <a href="https://www.esncard.org" target="_blank">www.esncard.org</a></li>
    </ul>

    <section id="partners">
        <h2>ESN partnership</h2>

        <h3>Vodafone</h3>
        <img src="{{ asset('img/guide/partners/logo-vodafone-2.png') }}" />
        <p>Stay in touch with your Erasmus friends and obtain a SIMcard with a favorable
            Erasmus student tariff together with an ISC membership! First month free with 3 GB data
            and free SMS to Vodafone. Then you get a 50% discount, so it's just 174 CZK (about &euro; 7).</p>
        <p><a href="https://www.esncz.org/partners/vodafone" target="_blank">www.esncz.org/partners/vodafone</a></p>
        <p>Don't forget that you should have enough balance on your account. Otherwise you will
            not be able to pay 174 CZK after each 30 days and the discount will be lost.</p>
        <p>How to top up your account? You have several options:</p>
        <ul>
            <li>Tobacco shops (with Sazka terminal)</li>
            <li>ATM machines (works with foreign debit card)</li>
            <li>Online (works with Czech debit card)</li>
            <li>Vodafone shops</li>
        </ul>
        <p></p>

        <h3>Ryanair</h3>
        <img src="{{ asset('img/guide/partners/logo-ryanair.jpg') }}" />
        <p><a href="https://esn.org/ryanair-faq" target="_blank">https://esn.org/ryanair-faq</a></p>
        <p>An exclusive partnership was launched in 2017 between the largest European airline, Ryanair, and the Erasmus Student Network.</p>
        <p>What are the benefits offered?</p>
        <ul>
            <li>For your discount to be valid you need to <strong>fill all fields in your profile</strong> at
                <a href="https://www.esncard.org" target="_blank">ESNcard.org</a> and have
                a <strong>registered and valid ESNcard!</strong></li>
            <li>This discount does not work with vouchers or promotional codes.</li>
            <li>For booking, use the <a href="https://www.ryanair.com/ie/en/plan-trip/explore/erasmus" target="_blank">dedicated portal</a>.</li>
            <li>15% discount on 8 single flights (or 4 return flights)</li>
            <li>Free check in luggage of 15 kg</li>
            <li>This is only applicable for flights booked at least <strong>28 days in advance</strong> and for travelling dates between <strong>1 September to 15 June</strong></li>
        </ul>
        <p></p>


        <h3>Leo Express</h3>
        <img src="{{ asset('img/guide/partners/leo.jpg') }}" />
        <p>Take the advantage of travelling on-board Leo Express connections with up to 15 % discount for all students with valid ESNcard.
           Enjoy comfortable and fast connections with outstanding services on all lines!</p>
        <p> Leo Express operates trains, buses and minibuses
           in 7 European countries such as Czech Republic, Slovakia, Germany, Austria, Poland, Ukraine and Ukraine. </p>
        <p><a href="https://www.esncz.org/partners/leo-express" target="_blank">www.esncz.org/partners/leo-express</a></p>
        <p>In order to book a ticket visit the page <a href="https://www.leoexpress.com" target="_blank">www.leoexpress.com</a>, select the date and time of your journey and make a reservation.
          To benefit from this exclusive discount, select "Adult” and add a Student discount in the reservation system to apply.
          Please, have your ESNcard with you when boarding Leo Express connections to prove your discount to the steward/driver.</p>
        <p></p>

        <h3>Grammarly</h3>
        <img src="{{ asset('img/guide/partners/grammarly.jpg') }}" />
        <p>Grammarly’s AI-powered products help people communicate more effectively.
           Millions of users rely on Grammarly every day to make their messages, documents, and social media posts clear, mistake-free, and impactful.</p>
        <p> With ESN Czech Republic you have a special 50 % discount for the Premium account.
           Just use this <a href="https://irbis.grammarly.com/api/discounts/CeYPkK" target="_blank">link</a> and enjoy Grammarly Premium for one year. </p>
        <p></p>

         <h3>Eurosender</h3>
         <img src="{{ asset('img/guide/partners/eurosender.png') }}" />
         <p>Travelling with only four T-Shirts, two pairs of Jeans and one pair of shoes. Sounds unrealistic? It is not,
           ESN Czech Republic and Eurosender can offer you the solution: Simply send your baggage home.</p>
          <p> All students in Czech Republic are now exclusively entitled to a special <strong>10% discount </strong>
             by entering the promo code <strong>ESNCZ</strong> when booking their Eurosender order </p>
          <p><a href="https://www.eurosender.com" target="_blank">Book now here.</a></p>
          <p></p>


        <h3>Flatio</h3>
        <img src="{{ asset('img/guide/partners/logo-flatio.png') }}" />
        <p>Choose the best flat from Flatio's offer of medium-term rents. View it with their virtual tour,
            view photos, reviews and the landlord's profile. For 50% off the booking fee, use the promo code &quot;ESNCZ&quot;.</p>
        <p><a href="https://www.esncz.org/partners/flatio" target="_blank">www.esncz.org/partners/flatio</a></p>
        <p><a href="https://bit.ly/2xKf51Y" target="_blank">Flatio offer in Prague</a></p>
        <p></p>

        <h3>Horror Escape Game &amp; Virtual Reality</h3>
        <img src="{{ asset('img/guide/partners/logo-thrillpark.png') }}" />
        <p>THRILL PARK is Prague’s horror theme park. It offers several fun and adrenaline-filled
            experiences that you will remember. Will you dare to enter Dungeon of Horror which is
            a thrilling haunted house? Will you and your friends solve a mysterious virtual
            reality escape game? Will you manage to survive a zombie apocalypse in virtual reality?
            Gather your friends come get your adrenaline shot at Žitná 44.
            With the ESN card, you get 20% off any experience!</p>
        <p><a href="https://esncard.org/discount/horror-escape-game-virtual-reality" target="_blank">esncard.org/discount/horror-escape-game-virtual-reality</a></p>
        <p></p>
    </section>

@stop
