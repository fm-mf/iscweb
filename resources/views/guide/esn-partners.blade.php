@extends('guide.layouts.subpage')

@section('subtitle', 'ESN Partners')

@section('subpage')
    <section id="partners">
        <h2>ESN partners</h2>
        <p>
            Use your ESNcard and take advantage of these offers.
            For more discounts all over Europe check the
            <a href="https://esncard.org" target="_blank" rel="noopener">ESNcard.org</a>.
            Register your ESNcard there! (Especially useful if you want to travel with Ryanair.)
        </p>
        <p>
            You do not have your ESNcard yet? Become an
            <a href="https://esn.cvut.cz/guide/esn-ctu-intro" target="_blank">ESN member</a>!
        </p>

        <h3>Vodafone</h3>
        <img src="{{ asset('img/guide/partners/vodafone.png') }}" alt="Vodafone logo" class="square-logo" />
        <p>
            Stay in touch with your Erasmus friends and obtain a SIM card with a favorable
            Erasmus student tariff together with an ESN membership! The first month is for free
            with 10 GB of data and free unlimited SMS within the Vodafone network and then for 399 CZK / month.
            This offer is the best offer for students at the market right now.
            So keep it simple, stay online and reach everyone you need.
        </p>
        <p class="mb-0">
            <strong>Every month you can activate additional 5 GB of data for a total of 15 GB / month in the <em>My Vodafone</em> app.</strong>
            The <em>My Vodafone</em> app is available for
        </p>
        <ul>
            <li class="mb-0"><a href="https://play.google.com/store/apps/details?id=com.zentity.vodafone" target="_blank" rel="noopener">Android (Google Play)</a></li>
            <li class="mb-0"><a href="https://itunes.apple.com/cz/app/muj-vodafone/id509838162?mt=8" target="_blank" rel="noopener">iOS (App Store)</a></li>
            <li class="mb-0"><a href="https://appgallery.huawei.com/#/app/C102006481" target="_blank" rel="noopener">Huawei (App Gallery)</a></li>
        </ul>
        <p>
            <a href="https://www.esncz.org/partners/vodafone" target="_blank" rel="noopener">
                More information about the Vodafone partnership
            </a>
        </p>
        <p>
            In the following months you can choose the same prepaid value bundle as in the first month for 399 CZK / month
            or different bundles proposed by Vodafone. Do not forget that you always have to top-up your card with credit to get a bundle.
        </p>
        <p class="mb-0">
            How to top up your account? You have several options:
        </p>
        <ul>
            <li class="mb-0">Tobacco shops (with Sazka terminal)</li>
            <li class="mb-0">ATM machines (works with foreign debit/credit card)</li>
            <li class="mb-0">Online (works only with Czech debit/credit card)</li>
            <li class="mb-0">Vodafone shops</li>
        </ul>
        <p>
            Check the
            <a href="https://www.vodafone.cz/pece/en/payments-and-credit/credit/how-and-where-recharge-credit/" target="_blank" rel="noopener">
                Vodafone website
            </a>
            for more details on how to top up your account.
        </p>


        <h3>SmartGuide</h3>
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

        <h3>Ryanair</h3>
        <img src="{{ asset('img/guide/partners/ryanair.svg') }}" alt="Ryanair logo" />
        <p><a href="https://esn.org/ryanair-faq" target="_blank" rel="noopener">Ryanair partnership FAQ</a></p>
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

        <h3>FlixBus</h3>
        <img src="{{ asset('img/guide/partners/flixbus.svg') }}" alt="FlixBus logo" />
        <p>
            FlixBus is a young mobility provider that has been changing the way millions of people travel in Europe.
            As a combination of tech-startup, e-commerce-platform and transportation company,
            FlixBus was able to establish Europe's largest intercity bus network in the shortest amount of time.
        </p>
        <p><a href="https://esncard.org/flixbus" target="_blank" rel="noopener">Enjoy 10% discount with your voucher.</a></p>
        <p>* You can claim up to 12 vouchers per ESNcard.</p>

        <h3>HoppyGo</h3>
        <img src="{{ asset('img/guide/partners/hoppygo.png') }}" alt="HoppyGo logo" />
        <p>
            Take advantage of the unique discounts of the HoppyGo platform
            and rent your dream car for a summer trip easily, flexibly and without unnecessary paperwork.
        </p>
        <p>
            You can choose from 2 500 cars of various brands and categories for any occasion.
            Cars are also available in our city. You can find the complete offer on the
            <a href="https://hoppygo.com/" target="_blank" rel="noopener">HoppyGo platform website</a>.
        </p>
        <p>
            When booking a car, enter the code <strong>ISCCTU</strong> and get a CZK 200 discount on rent.
            The car is taken over using the smart mobile application HoppyGo
            (<a href="https://play.google.com/store/apps/details?id=cz.nom.smilecarweb" target="_blank" rel="noopener">Google Play</a>,
            <a href="https://itunes.apple.com/cz/app/hoppygo/id1184613465?mt=8" target="_blank" rel="noopener">App Store</a>).
        </p>
        <p>
            The discount applies to car rental in the Czech Republic.
        </p>

        <h3>Eurosender</h3>
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

        <h3>The Economist</h3>
        <img src="{{ asset('img/guide/partners/economist.png') }}" alt="The Economist logo" />
        <p>
            As an ESN member, you can take advantage of this offer and save 20 %
            on the annual student subscription rate of The Economist. You will
            also receive one copy of Intelligent Life, the bi-monthly lifestyle
            magazine from The Economist as a gift.
        </p>
        <p><a href="https://subscription.economist.com/OA/partners/ESN/CzechRepublic" target="_blank">Subscribe here.</a></p>
    </section>

@stop
