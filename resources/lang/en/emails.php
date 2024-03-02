<?php

return [
    'verification' => [
        'title' => 'Buddy programme ESN CTU in Prague',
        'subject' => 'Buddy programme – E-mail verification',
        'body' => '
            <p>Hello!</p>
            <p>Thank you for your registration into our Buddy programme.</p>
            <p>
                To access the database of incoming students, please, click the link below:<br />
                <a href=":url" target="_blank">Verify e-mail</a>,<br />
                or copy the following link to the address bar of your browser:<br />
                <span style="user-select: all">:url</span>.
            </p>
        ',
    ],
    'welcome' => [
        'title' => 'Welcome to Buddy programme!',
        'subject' => 'Welcome to Buddy programme',
        'body' => '
            <p>We are happy that you have decided to join the international community at CTU!</p>
            <p>To get into the Buddy database, please, follow <a href=":buddyDbUrl">this link</a>.</p>
            <p>
                You can also join our Facebook group <a href="https://www.facebook.com/groups/esn.ctu.buddies/">ESN CTU Czech Buddies</a>,
                where you can get the latest updates about the Buddy programme.
                And to have all the information about other events and activities organised by ESN,
                follow also our Facebook page <a href="https://www.facebook.com/esn.ctu.prague/">ESN CTU in Prague</a>.
                If you have any questions, do not hesitate to ask in the FB group <em>Czech Buddies</em>
                or contact our Buddy coordinator via e-mail <a href="mailto:buddy@esn.cvut.cz">buddy@esn.cvut.cz</a>.
            </p>
            <p>We wish you good luck in choosing your International students. :)</p>
            <p>ESN Buddy team</p>
        ',
    ],
];
