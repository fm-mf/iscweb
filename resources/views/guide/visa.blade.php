@extends('guide.layouts.subpage')

@section('subtitle', 'Visa')

@section('subpage')
    <h2>Visa</h2>

     @component('guide.components.section-nav', ['items' => [
        'first' => 'First',
        'duration' => [
            'title' => 'Day duration',
            'items' => [
                'duration-schengen-area' => 'Schengen area'
            ]
        ],
        'before-arrival' => [
            'title' => 'Before arrival',
            'items' => [
                'visa-application' => 'Visa application'
            ]
        ],
        'after-arrival' => [
            'title' => 'After arrival',
            'items' => [
                'reporting' => 'Reporting duty at the Foreign Police Office'
            ]
        ],
        'moi' => 'Ministry of the Interior’s office (MOI/OAMP)',
        'extending' => 'Extending your stay',
        'other-obligations' => 'Other obligations'
    ]])
    @endcomponent

    <p>Now you are here, but that does not mean that you are done with your visa and other obligations.
        Please check everything carefully! :) There could still be a lot to cover.</p>
    <p>Full and official information available at <a href="http://www.mvcr.cz/mvcren/information-for-schools.aspx" target="_blank">Ministry of the interior website</a>.</p>
    <p>Useful information in the <a href="http://www.mvcr.cz/mvcren/file/immigration-documents-information-for-students.aspx" target="_blank">Ministry of the interior document</a> (PDF).</p>

    <h3 id="first">First</h3>
    <ul>
        <li>Regarding the right to move and reside freely, there is no visa required for students
            from the following countries: the European Union, Norway, Switzerland, Liechtenstein and Iceland.
            See <a href="http://www.mzv.cz/jnp/en/information_for_aliens/short_stay_visa/list_of_states_whose_citizens_are_exempt/index.html" target="_blank">Ministry of Foreign Affairs website</a> </li>
        <li>Not your case? Make sure you have a long-term visa.</li>
        <li>Short-term visa is for 90 days only</li>
        <li>If you don't have a visa granted in your passport before you arrive, there is no way you can extend or change it. To do so, you would need to travel to another country to apply at a Czech Embassy. Save trouble in advance and make sure your visa is stamped in your passport.</li>
        <li>After your arrival, make sure that you have done everything and your visa is valid.</li>
        <li>If you are in any doubt, or if anything is not clear to you, please contact our <a href="mailto:visa@esn.cvut.cz">Visa Coordinator (visa@esn.cvut.cz)</a>.</li>
    </ul>

    <h3 id="duration">Day duration</h3>
    <ul>
        <li>The important information is not only <strong>until when your visa is valid</strong> but also <strong>&quot;duration of stay&quot;</strong></li>
        <li>Duration of stay is the number of days your visa is applicable from the moment you crossed the border of the Schengen area</li>
        <li><strong>It may differ from your &quot;Valid until&quot; date</strong>, so make sure you count your days!</li>
    </ul>
    <img src="{{ asset('img/guide/visa.jpg') }}" alt="Visa example" title="Visa example" />

    <h4 id="duration-schengen-area">Schengen area</h4>
    <ul>
        <li>The duration of your stay is counted from when you arrived in the Schengen area, not only in the Czech Republic!</li>
        <li>If you travel outside of the Schengen area, days from &quot;duration of stay&quot; are not counted during that time, but make sure the immigration officer stamps your passport with leaving and entering dates!</li>
        <li>Be careful about this &ndash; Did you travel around before getting to Prague?</li>
    </ul>
    <p>This is very important! Please double check that your &quot;duration of stay&quot; covers your whole stay in the Schengen area.</p>

    <h3 id="before-arrival">Before arrival</h3>
    <h4 id="visa-application">Visa application</h4>
    <p>Standard documents required:</p>
    <ul>
        <li>Passport</li>
        <li>1 Photo</li>
        <li>Application form</li>
        <li>Health insurance</li>
        <li>Document regarding purpose of stay (invitation letter, letter of acceptance by CTU in Prague)</li>
        <li>Proof of sufficient financial means to arrange for accommodation and cover the duration of your stay in the Schengen area</li>
        <li>Round trip ticket reservation to home country</li>
        <li>Consular fee</li>
    </ul>
    <p>List of Czech consulates you can contact for specific information at the <a href="http://www.mzv.cz/jnp/en/diplomatic_missions/czech_missions_abroad/index.html" target="_blank">Ministry of Foreign Affairs website</a></p>
    <p>Pay attention to the kind of visa you will be issued! Depending on the type and duration, some other procedures upon arrival will be necessary!</p>

    <h3 id="after-arrival">After arrival</h3>
    <p>There are plenty of obligations you have to fulfill. Please check this very carefully.</p>

    <h4 id="reporting">Reporting duty at the Foreign Police Office</h4>
    <ul>
        <li>Obligation to register <strong>within 3 working days</strong>! (after arrival in the Czech Republic) for non-EU students</li>
        <li>Within 30 working days for EU students, but as exchange student, you don't need residence permit</li>
        <li>Your dormitory does this for you. In private accommodation talk to your landlord about it. If he hasn't done it, do it yourself (within 3 working days).</li>
        <li>Address: <address><a href="https://goo.gl/maps/4KSYHxT1Jo52" target="_blank">Olšanská 2176/2, Praha 3, 130 00</a></address></li>
        <li>Phone: <a href="tel:+420 974 820 317">+420 974 820 317</a> (speaking Czech only)</li>
        <li>Email: <a href="mailto:krpa.ocp.opa.podatelna@pcr.cz">krpa.ocp.opa.podatelna@pcr.cz</a></li>
    </ul>
    <p>More information at the <a href="http://www.mvcr.cz/mvcren/article/information-for-schools-and-students.aspx?q=Y2hudW09Mg%3d%3d" target="_blank">Ministry of Foreign Affairs website</a>.</p>

    <h3 id="moi">Ministry of the Interior’s office (MOI/OAMP)</h3>
    <ul>
        <li>All foreign students arriving on a Visa for collection of residence permit or &quot;<strong>DV/R</strong>&quot; &ndash; entering visa; <a href="{{ url('guide/visa-example-pictures') }}" target="_blank">see visa example pictures</a></li>
        <li><strong>Within 3 working days!</strong> (after arrival in the Czech Republic)</li>
        <li>Come back to collect it within the specified limit (but not later than within 60 days!)</li>
        <li>For every visit you have to <strong>book an appointment</strong>: <a href="tel:+420 974 820 680">+420 974 820 680</a>. Ask your Buddy to call there and make you an appointment, he will need your name, passport number and date of birth. If your Buddy is not available ask our <a href="mailto:visa@esn.cvut.cz">Visa Coordinator (visa@esn.cvut.cz)</a>.</li>
        <li>Be sure to make the appointment at leas a week before you arrive, they tend to have only few free spots</li>
    </ul>
    <dl>
        <dt>Address</dt>
        <dd><address><a href="https://goo.gl/maps/RyMeT2jzoMp" target="_blank">Hládkov 682/9, Praha 6 - Střešovice</a></address></dd>
        <dt>Contact</dt>
        <dd><a href="tel:+420 974 820 680">+420 974 820 680</a> (speaking Czech only)</dd>
        <dt>Opening hours</dt>
        <dd>Mon &ndash; Thu: 8:00 &ndash; 16:00 (only after booking)</dd>
        <dd>Fri: 8:00 &ndash; 12:00 (only after booking)</dd>
    </dl>

    <h4 id="extending">Extending your stay</h4>
    <ul>
        <li>Contact our <a href="mailto:visa@esn.cvut.cz">Visa Coordinator (visa@esn.cvut.cz)</a></li>
        <li>90 &ndash; 14 days before expiration, Ministry of the Interior's office</li>
        <li>What you need: proof of medical travel insurance (covering the whole stay)</li>
        <li>After your visa expires you have to leave the country and it is not possible to extend it anymore,
            so be careful to come early enough with all the documents</li>
        <li>What to bring:
            <ul>
                <li>Passport</li>
                <li>1 photo</li>
                <li>Proof of accommodation (lease agreement)</li>
                <li>Certificate of study (available at CTU International Office or at your faculty administration office)</li>
                <li>Proof of health insurance for your whole stay</li>
                <li>Document regarding purpose of stay (invitation letter, letter of acceptance by CTU in Prague)</li>
                <li>Proof of sufficient financial means to arrange for accommodation and cover a one-year duration of stay in the Schengen area (cca CZK 82 000)</li>
                <li>All originals or officially certified copies (get certified copies at the post office), valid for your whole stay, all in Czech or officially certified translations</li>
                <li>If you don't have all the paperwork done on time, go to the MOI office anyway and show what you have. When you have started the application they can extend the deadline for you.</li>
            </ul>
        </li>
    </ul>
    <p>More information at the <a href="https://mv.gov.cz/mvcren/" target="_blank">Ministry of the interrior website</a>.</p>

    <h3 id="other-obligations">Other obligations</h3>
    <p>To report a change of address or a change of travel document, visit the <a href="http://www.mvcr.cz/mvcren/article/contacts-alien-police-alien-police.aspx" target="_blank">Foreign Police</a>.</p>
@stop
