@extends('web.layouts.layout')
@section('title', 'Privacy policy')

@section('page')
    <section id="privacy">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Privacy policy</h1>
                    <p>
                        This privacy Policy summarise how we, {{ $officialName }},
                        Thákurova 550/1, 160 00 Praha 6, IČO: 22841032, uses the information that you provide us during
                        the registration to the Buddy database in combination with information we obtained from
                        České vysoké učení technické v Praze, Jugoslávských partyzánů 1580/3, 160 00 Praha 6 - Dejvice, IČO 68407700.
                    </p>

                    <p>We collect the following information about you:</p>
                    <ul>
                        <li>your full name;</li>
                        <li>your sex, nationality, year of birth;</li>
                        <li>contact information, especially your e-mail address;</li>
                        <li>information about your education, including the school you attend and your field of study
                            together with the information which faculty you will attend in the Czech Republic;</li>
                        <li>your arrival date and time to the Czech Republic, and accommodation in the Czech Republic;</li>
                        <li>your photo, and self-description.</li>
                    </ul>


                    <p>Here is what we do with this information:</p>
                    <ul>
                        <li>we provide you with any important news before and after your arrival to the Czech Republic
                            <ul>
                                <li>Nothing special about it - we just uses your e-mail address to send you inform you about
                                    anything we think it is important to know for you.</li>
                            </ul>
                        </li>
                        <li>we manage the Buddy database
                            <ul>
                                <li>Buddy database serves a simple purpose - to find you a Buddy, Czech student which will
                                    help you after your arrival.</li>
                                <li>To allow Czech students to choose the best exchange student for them, we make some of
                                    your information available to them after registration and login into the Buddy database.
                                    They can see your full name, country of origin, school and faculty, date and time of
                                    your arrival to the Czech Republic and accommodation type. They can also see your
                                    approximate age, photo and self-description. Please note that it is only your choice how
                                    much information you want to share in the self-description. The e-mail address is not
                                    visible in this database; buddy can see it once he or she chooses you. We do not control
                                    what you tell your buddy in e-mail as it is your private communication.</li>
                            </ul>
                        </li>
                        <li>we manage the internal database, to maintain our internal organisation
                            <ul>
                                <li>We use it for organising trips and other events you can sign for while being in Czech Republic.</li>
                            </ul>
                        </li>
                    </ul>


                    <p>We also employ the third-party companies and individuals to provide us selected services due to the following reasons:</p>
                    <ul>
                        <li>To facilitate our Services;</li>
                        <li>To perform Services-related services;</li>
                    </ul>

                    <p>
                        It sounds complicated, but we just say that we cannot manage everything on our own - so we use the
                        other companies to provide us for example with data hosting, mailing systems etc.
                    </p>

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
                        <a href="{{ route('web.contacts') }}">contact us</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
