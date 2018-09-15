@extends('web.layouts.subpage')
@section('wrapper-class', 'about-wrapper')
@section('navClass', 'navbar-dark')
@section('title', 'Privacy notice')

@section('content')

    <div class="container subpage" xmlns="http://www.w3.org/1999/html">
        <div class="row vision">
            <div class="col-sm-12">
                <p>
                    This privacy notice informs you how we, International Student Club CTU in Prague, z. s.,
                    Thákurova 550/1, 160 00 Praha 6, IČO: 22841032, uses any information that was provided to us by
                    České vysoké učení technické v Praze, Jugoslávských partyzánů 1580/3, 160 00 Praha 6 - Dejvice, IČO 68407700 about you.
                </p>

                <p>
                    Based on an Agreement between International Student Club CTU in Prague and
                    České vysoké učení technické v Praze we received the following information:
                </p>
                <ul>
                    <li>your full name;
                    <li>your sex, nationality, date of birth;</li>
                    <li>contact information, especially your e-mail address;</li>
                    <li>information about your education, including the school you attend and your field of study
                        together with the information which faculty you will attend in the Czech Republic.</li>
                </ul>

                <p>We use this information to provide you and České vysoké učení technické v Praze a set of Services as follow:</p>
                <ul>
                    <li>to provide you with any important news before and after your arrival to the Czech Republic via e-mail;</li>
                    <li>to organise the events during the Orientation week;</li>
                    <li>to prepare some documents, such as welcome package and ESN card, in advance.</li>
                </ul>

                <p>We also may employ the third-party companies to provide us selected services due to the following reasons:</p>
                <ul>
                    <li>To facilitate our Services;</li>
                    <li>To perform Services-related services.</li>
                    <li>It sounds complicated, but we just say that we cannot manage everything on our own - so we use
                        the other companies to provide us for example with data hosting, mailing systems etc.</li>
                </ul>

                <p>
                    We are committed to ensuring that your information is secure. To prevent unauthorised access
                    or disclosure, we have put in place suitable physical, electronic and managerial procedures
                    to safeguard and secure the information we received.
                </p>

                <p>
                    We may change this policy from time to time by updating this page. You should check this page
                    from time to time to ensure that you are happy with any changes.
                    This policy is effective from 1 May 2018.
                </p>

                <p>
                    If you have any questions or suggestions about our privacy policy, do not hesitate to
                    <a href="{{ action('Web\WebController@showContacts') }}">contact us</a>.
                </p>
            </div>
        </div>
    </div>
@endsection
