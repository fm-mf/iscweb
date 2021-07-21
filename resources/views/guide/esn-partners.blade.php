@extends('guide.layouts.subpage')

@section('subtitle', 'ESN & ISC Partners')

@section('subpage')
    <section id="partners">
        <h1>ESN & ISC partners</h1>
        <p>
            Use your ESNcard and take advantage of these offers.
            For more discounts all over Europe check the
            <a href="https://esncard.org" target="_blank" rel="noopener">ESNcard.org</a>.
            Register your ESNcard there! (Especially useful if you want to travel with Ryanair.)
        </p>
        <p>
            You do not have your ESNcard yet? Become an
            <a href="https://isc.cvut.cz/guide/isc-intro" target="_blank">ISC member</a>!
        </p>

        <h2>Vodafone</h2>
        <img src="{{ asset('img/guide/partners/vodafone.png') }}" alt="Vodafone logo" class="square-logo" />
        <p>
            Stay in touch with your Erasmus friends and obtain a SIMcard with a favorable
            Erasmus student tariff together with an ISC membership! First month free with 3 GB data
            and free SMS to Vodafone. Then you get a 50% discount, so it's just 174 CZK (about € 7).
        </p>
        <p>
            <a href="https://www.esncz.org/partners/vodafone" target="_blank" rel="noopener">
                www.esncz.org/partners/vodafone
            </a>
        </p>
        <p>
            Don't forget that you should have enough balance on your account. Otherwise you will
            not be able to pay 174 CZK after each 30 days and the discount will be lost.
        </p>
        <p>
            How to top up your account? You have several options:
        </p>
        <ul>
            <li>Tobacco shops (with Sazka terminal)</li>
            <li>ATM machines (works with foreign debit card)</li>
            <li>Online (works with Czech debit card)</li>
            <li>Vodafone shops</li>
        </ul>

        <h2>SmartGuide</h2>
        <img src="{{ asset('img/guide/partners/smart-guide.png') }}" alt="SmartGuide logo" class="square-logo" />
        <p>
            Discover Prague in an interactive and fun way! SmartGuide turns your smart phone
            into a private guide. Tours around highlights and hidden gems. Integrated maps
            and GPS. Photos, audio and text descriptions work together.
        </p>
        <p>
            Download the app via this <a href="https://getgui.de/CVUTVIP" target="_blank" rel="noopener">link</a>
            and activate the <strong>premium account for free with the CVUTVIP promo code!</strong>
        </p>

        <h2>Ryanair</h2>
        <img src="{{ asset('img/guide/partners/ryanair.svg') }}" alt="Ryanair logo" />
        <p><a href="https://esn.org/ryanair-faq" target="_blank" rel="noopener">https://esn.org/ryanair-faq</a></p>
        <p>
            An exclusive partnership was launched in 2017 between the largest European airline,
            Ryanair, and the Erasmus Student Network.
        </p>
        <p>
            What are the benefits offered?
        </p>
        <ul>
            <li>
                For your discount to be valid you need to <strong>fill all fields in your profile</strong>
                at <a href="https://www.esncard.org" target="_blank" rel="noopener">ESNcard.org</a>
                and have a <strong>registered and valid ESNcard!</strong>
            </li>
            <li>This discount does not work with vouchers or promotional codes.</li>
            <li>
                For booking, use the
                <a href="https://www.ryanair.com/ie/en/plan-trip/explore/erasmus" target="_blank" rel="noopener">
                    dedicated portal
                </a>.
            </li>
            <li>10% discount on 4 single flights (or 2 return flights)</li>
            <li>Free check in luggage of 20 kg</li>
            <li>
                This is only applicable for flights booked at least <strong>28 days in advance</strong>
                and for travelling dates between <strong>1 September to 15 June</strong>
            </li>
        </ul>

        <h2>FlixBus</h2>
        <img src="{{ asset('img/guide/partners/flixbus.svg') }}" alt="FlixBus logo" />
        <p>
            FlixBus is a young mobility provider that has been changing the way millions of people travel in Europe.
            As a combination of tech-startup, e-commerce-platform and transportation company,
            FlixBus was able to establish Europe's largest intercity bus network in the shortest amount of time.
        </p>
        <p><a href="https://esncard.org/flixbus" target="_blank" rel="noopener">Enjoy 10% discount with your voucher.</a></p>
        <p>*You can claim up to 12 vouchers per ESNcard.</p>

        <!--
        <h2>Revolut</h2>
        <img src="{{ asset('img/guide/partners/revolut.svg') }}" alt="Revolut logo" />
        <p>
            Revolut is an online bank that provides its customers with
            <strong>free accounts, free currency exchange, and free payment cards</strong>.
            Revolut card can be used all over the world to pay and withdraw money without
            any fees (note: banks can have some fees e.g. Česká spořitelna). Revolut has
            an app that allows you to send money to other Revolut account within seconds
            and for free, so it's perfect for managing your expenses with your friends.
        </p>
        <p>
            If you are still not sure what Revolut is, take a look at
            <a href="https://www.youtube.com/watch?v=QabM_PvBtsI">this short video</a>
            or read through <a href="https://www.revolut.com/">their website</a>.
        </p>
        <p>
            Use <a href="https://revolut.ngih.net/kGWO3">this link</a> to order the Revolut card for FREE!
        </p>
        -->
        <h2>Grammarly</h2>
        <img src="{{ asset('img/guide/partners/grammarly.jpg') }}" alt="Grammarly logo" />
        <p>
            Grammarly’s AI-powered products help people communicate more effectively.
            Millions of users rely on Grammarly every day to make their messages, documents,
            and social media posts clear, mistake-free, and impactful.
        </p>
        <p>
            With ESN Czech Republic you have a special <strong>50 % discount on the Premium account</strong>.
            Just use this <a href="https://irbis.grammarly.com/api/discounts/CeYPkK" target="_blank" rel="noopener">link</a>
            and enjoy Grammarly Premium for one year.
        </p>

        <h2>Eurosender</h2>
        <img src="{{ asset('img/guide/partners/eurosender.svg') }}" alt="Eurosender logo" />
        <p>
            Travelling with only four T-Shirts, two pairs of Jeans and one pair of shoes. Sounds unrealistic? It is not,
            ESN Czech Republic and Eurosender can offer you the solution: Simply send your baggage home.
        </p>
        <p>
            All students in Czech Republic are now exclusively entitled to a special <strong>10% discount </strong>
            by entering the promo code <strong>ESNCZ</strong> when booking their Eurosender order.
        </p>
        <p>
            <a href="https://www.eurosender.com" target="_blank">Book now here</a>
        </p>

        <h2>The Economist</h2>
        <img src="{{ asset('img/guide/partners/economist.png') }}" alt="The Economist logo" />
        <p>
            As an ESN member, you can take advantage of this offer and save 20%
            on the annual student subscription rate of The Economist. You will
            also receive one copy of Intelligent Life, the bi-monthly lifestyle
            magazine from The Economist as a gift.
        </p>
        <p><a href="https://subscription.economist.com/OA/partners/ESN/12420offer" target="_blank">Subscribe here.</a></p>

        <h2>My Conscious Space</h2>
        <img src="{{ asset('img/guide/partners/my_conscious_space.png') }}" alt="My Conscious Space logo" />
        <p>
            My Conscious Space creates a safe online container for your self-development and healing. We offer a space with guidance, where we support each other on our self-discovery journey. Everything is reachable online from the warmth of your home. Choose what suits you the best: yoga, meditation, breathing techniques, deep relaxation, women circles or full/new moon ceremonies. All the events are LIVE, using Zoom platform.
        </p>
        <p><a href="https://myconscious.space/isc/" target="_blank" rel="noopener">Enjoy Three Weeks of Unlimited Yoga for 15 euro.</a></p>

        <h2>Loď Pivovar</h2>
        <img src="{{ asset('img/guide/partners/lod_pivovar.png') }}" alt="Pivolod logo" />
        <p>
            Restaurant with its own brewery, where you can enjoy Czech cuisine, beer garden and summer terrace with bar, BBC and relaxing lounge.
            All this awaits you on three decks of a unique project in Czech waters.
        </p>
        <p>Check it out at <a href="https://www.lodpivovar.cz/" target="_blank">www.lodpivovar.cz</a></p>
        <p>Upon showing your ESNcard you'll get <strong>5% discount</strong> on beer.</p>
    </section>

@stop
