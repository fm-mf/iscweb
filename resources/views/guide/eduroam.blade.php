@extends('guide.layouts.subpage')

@section('subtitle', 'Eduroam')

@section('subpage')
    <h2>Eduroam</h2>
    <p>Eduroam (education roaming) is an international roaming service for users in research,
        higher education and further education. It provides researchers, teachers and students
        with an easy and secure network access.</p>

    <h3>How to connect to Wi-Fi eduroam</h3>

    <h4>Eduroam username</h4>
    <p>The username for eduroam consists of the CTU username supplemented with the realm of your faculty.</p>
    <p>Depending on your faculty, use these realms:</p>
    <dl>
        <dt>Faculty of Civil Engineering</dt>
            <dd>@cvut.cz</dd>
        <dt>Faculty of Mechanical Engineering</dt>
            <dd>@fs.cvut.cz</dd>
        <dt>Faculty of Electrical Engineering</dt>
            <dd>@fel.cvut.cz</dd>
        <dt>Faculty of Nuclear Sciences and Physical Engineering</dt>
            <dd>@fjfi.cvut.cz</dd>
        <dt>Faculty of Architecture</dt>
            <dd>@vc.cvut.cz</dd>
        <dt>Faculty of Transportation Sciences</dt>
            <dd>@fd.cvut.cz</dd>
        <dt>Faculty of Biomedical Engineering</dt>
            <dd>@fbmi.cvut.cz</dd>
        <dt>Faculty of Information Technology</dt>
            <dd>@fit.cvut.cz</dd>
        <dt>Masaryk Institute of Advanced Studies</dt>
            <dd>@muvs.cvut.cz</dd>
    </dl>
    <p>For example, if your CTU username is <strong>novakj99</strong> and you are from
        <strong>Faculty of Electrical Engineering</strong>, your eduroam unique username will be
        <strong>novakj99@fel.cvut.cz</strong>.</p>

    <h4>Eduroam password</h4>
    <p>Before using the wireless network, you should set a password for wireless network access
        (eduroam password). You can set the password through the <a href="https://usermap.cvut.cz" target="_blank">Usermap</a>.</p>
    <ol>
        <li>switch to English</li>
        <li>click on login, log yourself in (use your faculty username and the main CTU password)</li>
        <li>click on your name (right upper corner)</li>
        <li>click on Settings</li>
        <li>click on Eduroam password settings</li>
        <li>set your new eduroam password</li>
    </ol>

    <h4>Find eduroam Wi-Fi and connect yourself</h4>
    <p>Most operating systems allow you to log in just by typing the eduroam username
        and the eduroam password, however there can be ones that need additional settings
        such as certificates.</p>
    <p>You can find more details on how to connect at <a href="https://ist.cvut.cz/en/our-services/wireless-network/" target="_blank">IST Services CTU</a> </p>
@stop
