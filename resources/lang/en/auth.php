<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
//    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'registered-before' => 'Before :date',
    'long-time-ago' => 'A long time ago',

    'login' => 'Login',
    'log-in' => 'Log in',
    'log-in-ctu' => 'Log in with CTU account',
    'log-out' => 'Log out',

    'ctu-symbol' => 'CTU symbol',

    'login-heading-buddy' => 'Login to Buddy programme',
    'login-heading-partak' => 'Login to ParťákNet',

    'e-mail' => 'E-mail address',
    'password' => 'Password',
    'password-confirmation' => 'Password confirmation',

    'no-account-yet' => 'Don’t have and account yet?',
    'register-imp' => 'Register!',
    'forgot-your-password' => 'Forgot your password?',

    'registration' => 'Registration',
    'register' => 'Register',
    'register-with-ctu' => [
        'btn-title' => 'Register using CTU account',
        'notice' => '
            By clicking the ‘:btnTitle’ button you promise to follow the <a href=":hrefCode">Buddy code of conduct</a>
            and you agree to the <a href=":hrefPrivacy" target="_blank" title="Consent to the processing of personal data">processing of your personal data</a>.
        ',
    ],
    'registration-heading' => 'Registration to the Buddy programme',
    'registration-info' => '
        <p>
            After registration you will have access to a database of incoming international exchange students.
        </p>
        <p>
            If you have already registered, please, continue to the
            <a href=":href">login page</a>.
        </p>
    ',

    'password-note' => 'Password has to be at least 8 characters long',
    'privacy-approval' => 'I agree to the <a href=":href" target="_blank" title="Consent to the processing of personal data">processing of my personal data</a>.',

    'placeholder' => [
        'e-mail' => 'Enter your e-mail address',
        'password' => 'Enter your password',
        'password-confirmation' => 'Confirm your password',
    ],

    'register-check' => [
        'label' => 'To continue, please, select an appropriate option:',
        'label-local' => ' I am <strong>a local (Czech) student</strong> and I would like to be a Buddy and help the international students.',
        'label-exchange' => 'I am <strong>an international exchange student</strong> and I would like to get a Buddy.',
        'label-degree-student' => 'I am <strong>a new international degree student</strong> and I would like to <strong>get a Buddy</strong>.',
        'label-degree-buddy' => 'I am <strong>an international degree student</strong> and I would like to <strong>be a Buddy</strong> and help the new students.',
        'continue' => 'Continue…',
        'exchange' => 'International exchange student',
        'degree' => 'International degree student',
    ],

    'profile' => [
        'title' => 'My profile',
        'info' => '
            <p>
                The following entries are optional. However, filling them up can be very helpful to us in case of any troubles.
            </p>
        ',
        'basic-information' => 'Basic information',
        'email-info' => '
            We will use this e-mail address to contact you if needed.
            If you wich to change it, please, contact us at
        ',
        'given-names' => 'Given names',
        'surname' => 'Surname',
        'additional-information' => 'Additional information',
        'sex' => 'I am',
        'sex-m' => 'Male',
        'sex-f' => 'Female',
        'year-of-birth' => 'Year of birth',
        'country' => 'Country of origin',
        'faculty' => 'Faculty',
        'phone' => 'Phone number',
        'about-me' => 'About me',
        'newsletter' => 'Newsletter',
        'newsletter-approval' => '
            I agree to receive occasional e-mails with information about current ISC events
            (e.g., opening the Buddy database, or important upcoming events).
        ',

        'update' => 'Update profile',
        'skip-to-verification' => 'Skip to verification',
        'skip-profile' => 'Skip…',

        'updated-successfully' => 'Your profile has been successfully updated.',

        'placeholder' => [
            'given-names' => 'Enter your given names',
            'surname' => 'Enter your surname',
            'sex' => 'Select your sex…',
            'year-of-birth' => 'Enter your year of birth',
            'country' => 'Select your country…',
            'faculty' => 'Select your faculty…',
            'phone' => 'Enter your phone number',
            'about-me' => 'Some information about you…',
        ],
    ],

    'verification' => [
        'title' => 'Verification',
        'info' => '
            <p>
                Thank you for Your registration to Buddy programme!
            </p>
            <p>
                Because we care about safety of our international exchange students, we would like to ask you
                to verify your identity. You can use your university e-mail address where we will send you
                an activation link.
            </p>
            <p>
                In case you are not a student of any of the listed universities, please, leave us
                a message using the form below, and we will soon contact you with next steps.
            </p>
        ',
        'with-email' => 'I have a university e-mail',
        'without-email' => 'I don’t have a university e-mail',
        'university-email' => 'University e-mail address',
        'university-email-help' => 'Enter only the part of university e-mail address before ‘@’',
        'domain' => 'Domain of the university e-mail',
        'domain-help' => 'Select a domain of your university e-mail',
        'motivation' => 'Motivation',
        'motivation-info' => '
            <p>
                Of course, you can become a Buddy even if you are not a student anymore.
                In such case leave us, please, a short message.
            </p>
            <p>
                We will soon contact you with next steps.
            </p>
        ',

        'send-link' => 'Send verification link',
        'send' => 'Send',

        'mail-sent' => 'E-mail with verification link has been sent to :email.',

        'invalid-hash' => '
            <p>
                Ooops. The verification link is invalid. Please, check,
                if it matches the link we have sent you, and if necessary contact us at
                <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>.
            </p>
            <p>
                We apologize for the inconvenience. :)
            </p>
        ',

        'placeholder' => [
            'university-email' => 'Enter part of the e-mail before ‘@’',
            'domain' => 'Select an e-mail domain …',
            'motivation' => 'Describe briefly why do you want to be a Buddy…',
        ],
    ],

    'thanks' => [
        'heading' => 'Thank you for you registration to Buddy programme!',
        'verified' => '
            <p>Verification has been successful.</p>
            <p>You can now pick your first international student. Have fun!</p>
            <p>To access the database of incoming students use the link <a href=":href">:href</a>.</p>
        ',
        'not-verified' => '
            <p>
                Thank you for your answer. We will get back to you soon. Meanwhile,
                you can check our upcoming events where we will be happy to see you.
            </p>
            <p>You can find all the upcoming events in the <a href=":href">Calendar</a>.</p>
        ',
        'survey-request' => '
            <p>If you have a moment, we would like to ask you to fill in this short anonymous survey.</p>
            <p>Thank you!</p>
        ',
    ],

    'code-of-conduct' => [
        'approval' => 'I promise to follow the Buddy code of conduct',
        'title' => 'Buddy code of conduct',
        'text' => '
            <p>
                We take our mission responsibly, and we try to help the exchange students –
                but it does not mean we are their servants. Our relationships should be
                mostly friendly. However, we realise that our actions affect the name of ISC,
                the University and the entire Czech Republic. So we behave in such way to not
                cause any damage to it.
            </p>
            <p>
                We are not afraid to communicate even if foreign languages are not our strength.
                On the contrary, we see a huge opportunity in meeting the exchange students,
                and we want to learn from them. However, by no means do we take advantage
                of them for our own profit or for commercial purposes.
            </p>
            <p>
                Sometimes it happens that we find ourselves in a situation where we do not know
                what to do. However, we are one team, and we can always ask ISC for help
                (<a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>).
            </p>
        ',
    ],

    'passwords' => [
        'title' => 'Password reset',
        'reset' => 'Reset password',
        'send-link' => 'Send password reset link',
    ],

    'degree-student' => [
        'registration-info' => '
            <p>
                After registration you will be added to a database of incoming international exchange students have a chance to get a Buddy.
            </p>
            <p>
                If you have already registered, please, continue to the
                <a href=":href">login page</a> to update your profile.
            </p>
        ',
    ]

];
