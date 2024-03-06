@extends('web.layouts.layout')
@section('title', 'Frequently asked questions')
@section('page')
    <section class="faq">
        <div class="container">
            <div class="row">
                <div class="col col-lg-10 mx-lg-auto">
                    <h1>Frequently asked questions</h1>
                    <dl>
                        <dt>
                            <a data-toggle="collapse" href="#answer1">
                                What time is the ESN Point open?
                            </a>
                        </dt>
                        <dd id="answer1" class="collapse">
                            <p>
                                During the semester our members are holding shifts during the office hours which you can
                                find in the <a href="{{ route('web.contacts') }}">contacts section</a> at the website or
                                on our <a href="{{ $fbPageUrl }}" target="_blank" rel="noopener">FB page</a>. We are closed
                                in the morning every day and the whole day on Friday, Saturday, and Sunday.
                            </p>
                            <p>
                                If you want to come outside of the office hours you can check if we are open by calling
                                the phone number <a href="tel:{{ $pointPhoneNo }}" target="_blank">{{ $pointPhoneNoFormatted }}</a>.
                                There is a chance you can find somebody in the ESN Point if you come in the evening
                                when the language courses and other activities are happening.
                            </p>
                            <p>
                                Please note that we are student volunteers and we are doing everything in our free time.
                                During the exam period and summer, we usually do not have any regular opening hours.
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer2">
                                How can I join the Buddy Program?
                            </a>
                        </dt>
                        <dd id="answer2" class="collapse">
                            <p>
                                If you are an incoming exchange student we will contact you about a month before your
                                arrival with all the necessary information. You will get a unique link to create your
                                profile in our Buddy database.
                            </p>
                            <p>
                                If you are a full-time international student or you are coming to CTU as a member
                                to a different study program, please contact our Buddy Coordinator by the e-mail
                                <a href="mailto:buddy@esn.cvut.cz">buddy@esn.cvut.cz</a> and inform him that you would like
                                to participate in the Buddy Program.
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer3">
                                I am a full-time (or another English speaking) student and I want to become a local "Czech"
                                Buddy, what are my options?
                            </a>
                        </dt>
                        <dd id="answer3" class="collapse">
                            <p>
                                You can contact our Buddy Coordinator by the e-mail
                                <a href="mailto:buddy@esn.cvut.cz">buddy@esn.cvut.cz</a> and he will provide you information
                                about how to register, what to be careful of and all the other information we provide
                                to Czech Buddies.
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer4">
                                What is the Welcome Pack and how can I get it?
                            </a>
                        </dt>
                        <dd id="answer4" class="collapse">
                            <p>
                                <a href="{{ route('guide-page', ['page' => 'welcome-pack']) }}">Welcome Pack</a> contains
                                materials with all the important information which will help you during your first days
                                in the Czech Republic. You can also find there a small pink paper which is a confirmation
                                that you study at the CTU and you can get a student discount for public transportation tickets.
                            </p>
                            <p>
                                You can come for your Welcome Pack to the ESN Point when you arrive in the Czech Republic
                                or you can ask your Buddy if he/she can pick up the Welcome Pack for you before they will
                                come for you to the airport.
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer5">
                                What is the Membership Package?
                            </a>
                        </dt>
                        <dd id="answer5" class="collapse">
                            <p>
                                By buying the Membership Package you are becoming a member of the Erasmus Student Network
                                and you can join our trips and other activities (ice-skating, bowling, Pub Quizzes,
                                Wild Weekend, etc.), you can also use a member discount on printing in the ESN Point.
                            </p>
                            <p>
                                The Membership Package also includes
                                an <a href="{{ route('guide-page', ['page' => 'esn-partners']) }}">ESNcard</a>,
                                <a href="https://www.esncz.org/partners/vodafone" target="_blank" rel="noopener">Vodafone SIM card</a>
                                with a student plan (with 50% discount) and an "I was there" T-shirt. If you want to buy
                                the membership, just bring {{ $membershipFee }} CZK in cash and a passport-format photo (for the ESNcard).
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer6">
                                How can I get an internet connection at my dormitory?
                            </a>
                        </dt>
                        <dd id="answer6" class="collapse">
                            <p>
                                Erasmus Student Network CTU doesn't provide an internet connection. You can get your Wi-Fi
                                access from your dormitory club. For Strahov, you can contact the
                                <a href="https://is.sh.cvut.cz/" target="_blank" rel="noopener">Silicon Hill Club</a>,
                                for Masarykova dormitory contact the
                                <a href="https://mk.cvut.cz/index.php/en/" target="_blank" rel="noopener">Masařka club</a>.
                                Accordingly, you will get the internet on all of the dormitories.
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer7">
                                I forgot to top up my Vodafone SIM card. What can I do?
                            </a>
                        </dt>
                        <dd id="answer7" class="collapse">
                            <p>
                                Don't worry, your SIM card is still working, but you have lost your discount.
                                There is nothing you can do about that.
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer8">
                                My Vodafone SIM card has some issues. What should I do?
                            </a>
                        </dt>
                        <dd id="answer8" class="collapse">
                            <p>
                                If there is a problem, go to the Vodafone store (the closest one is on the
                                <a href="https://www.vodafone.cz/en/stores/store-detail/praha-6-dejvicka/" target="_blank" rel="noopener">Vítězné náměstí next to the KFC</a>)
                                and they will help you. If your card is broken, come to the ESN Point or contact us through
                                a <a href="{{ $fbPageUrl }}" target="_blank" rel="noopener">Facebook</a> message or e-mail
                                address <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a> and we will see what we can do
                                about it.
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer9">
                                I am on an exchange in Prague, but my university doesn't have an ESN section or any other
                                student club, can I join ESN activities?
                            </a>
                        </dt>
                        <dd id="answer9" class="collapse">
                            <p>
                                Sure you can. There are the same rules for all the students. To join our parties and other
                                events which don't require the registration everybody is free to come. If you want to join
                                the trips you need to get an ESN Membership Package (it includes ESNcard, Vodafone SIM card,
                                and a T-shirt and costs {{ $membershipFee }} CZK).
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer10">
                                I am an exchange student from some of the other ESN Section in Prague and I want to join
                                ESN activities with my friends. What do I need to do?
                            </a>
                        </dt>
                        <dd id="answer10" class="collapse">
                            <p>
                                For a lot of the activities we do not require the students to have our membership ESNcard
                                and you are free to come. If you want to join some of the activities for which the ESNcard
                                and registration is needed, but you have an ESNcard from some of the other Prague
                                universities (UCT, CU, VŠE or CULS) send us a message on
                                <a href="{{ $fbPageUrl }}" target="_blank" rel="noopener">Facebook</a> or an e-mail to
                                <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a> and we will help you.
                            </p>
                        </dd>

                        <dt>
                            <a data-toggle="collapse" href="#answer11">
                                I am coming to Prague for an internship during the summer. What can you offer me?
                            </a>
                        </dt>
                        <dd id="answer11" class="collapse">
                            <p>
                                Unfortunately, during the summer, there is not much we can offer to you. There are no
                                opening hours during the summer. We do not organize any events and most of our members
                                are at home for the holiday or they are working.
                            </p>
                            <p>
                                Also, the Buddy Program is not running. If you send us a
                                <a href="{{ $fbPageUrl }}" target="_blank" rel="noopener">FB message</a> or an e-mail
                                before you come, we can try to get some of our members in Prague to take care of you during
                                the first days, but we can not promise anything.
                            </p>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </section>
@endsection
