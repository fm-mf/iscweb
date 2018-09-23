<?php

namespace App\Helpers;


class Contacts
{
    private $contacts;
    private $positions_to_display_in_contacts;

    function __construct()
    {
        $maleSilhouette = 'img/web/contacts/male-silhouette-150.jpg';
        $femaleSilhouette = 'img/web/contacts/female-silhouette-150.jpg';
        $contactImageFolder = 'img/web/contacts/2018-fall';

        $this->contacts = collect([
            [
                'name' => 'Tereza Faltysová',
                'position' => 'President',
                'email' => 'president@isc.cvut.cz',
                'phone' => '+420 777 085 390',
                'avatar' => asset("{$contactImageFolder}/president-terka.jpg")
            ],
            [
                'name' => 'Michaela Šímová',
                'position' => 'Vicepresident',
                'email' => 'vicepresident@isc.cvut.cz',
                'phone' => '+420 722 588 477',
                'avatar' => asset("{$contactImageFolder}/vicepresident-misa.jpg")
            ],
            [
                'name' => 'Michaela Petříková',
                'position' => 'Human Resources',
                'email' => 'hr@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/hr-misa.jpg")
            ],
            [
                'name' => 'Martin "Speedy" Průcha',
                'position' => 'Treasurer',
                'email' => 'treasurer@isc.cvut.cz',
                'phone' => '+420 736 683 644',
                'avatar' => asset("{$contactImageFolder}/treasurer-speedy.jpg")
            ],
            [
                'name' => 'Jakub Nový',
                'position' => 'Public Relations',
                'email' => 'pr@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/pr-jakub.jpg")
            ],
            [
                'name' => 'Matěj Mysliveček',
                'position' => 'Local Representative',
                'email' => 'lr@isc.cvut.cz',
                'phone' => '+420 777 669 787',
                'avatar' => asset("{$contactImageFolder}/lr-matej.jpg")
            ],
            [
                'name' => 'Eva Machová',
                'position' => 'Quality and Knowledge Manager',
                'email' => 'knowledge@isc.cvut.cz',
                'phone' => '+420 736 724 862',
                'avatar' => asset("{$contactImageFolder}/qak-evca.jpg")
            ],
            [
                'name' => 'Zuzana Havlíčková',
                'position' => 'inteGREAT Coordinator',
                'email' => 'integreat@isc.cvut.cz',
                'phone' => '+420 606 267 536',
                // 'avatar' => asset($femaleSilhouette)
                'avatar' => asset("{$contactImageFolder}/inteGREAT-zuzka.jpg")
            ],
            [
                'name' => 'Tomáš Hrdlovics',
                'position' => 'Point Coordinator',
                'email' => 'point@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Václav David',
                'position' => 'Activities Coordinator',
                'email' => 'activities@isc.cvut.cz',
                'phone' => '+420 731 858 146',
                'avatar' => asset("{$contactImageFolder}/activities-vasek.jpg")
            ],
            [
                'name' => 'Marek Stehlík',
                'position' => 'Languages Coordinator',
                'email' => 'languages@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/languages-marek.jpg")
            ],
            [
                'name' => 'Martin Petráček',
                'position' => 'Buddy Coordinator',
                'email' => 'buddy@isc.cvut.cz',
                'phone' => '+420 736 234 990',
                'avatar' => asset("{$contactImageFolder}/buddy-martin.jpg")
            ],
            [
                'name' => 'Petr Fiedler',
                'position' => 'IT Coordinator',
                'email' => 'it@isc.cvut.cz',
                'phone' => '+420 608 990 369',
                'avatar' => asset("{$contactImageFolder}/it-fida.jpg")
            ],
            [
                'name' => 'Michal Štádler',
                'position' => 'Alumni Coordinator',
                'email' => 'alumni@isc.cvut.cz',
                'phone' => '', //'+420 607 100 631',
                'avatar' => asset("{$contactImageFolder}/alumni-strudlic.jpg")
            ],
            [
                'name' => '',
                'position' => 'Sports Coordinator',
                'email' => 'sports@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Michal Nečas',
                'position' => 'ISC Care Coordinator',
                'email' => 'care@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/care-michal.jpg")
            ],
            [
                'name' => 'Lukáš Turčan',
                'position' => 'Visa Coordinator',
                'email' => 'visa@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/visa-lukas.jpg")
            ]
        ]);

        $this->positions_to_display_in_contacts = ['President', 'Vicepresident', 'Human Resources', 'Treasurer',
            'Public Relations', 'Local Representative', 'Quality and Knowledge Manager',
            'inteGREAT Coordinator', 'Point Coordinator', 'Activities Coordinator', 'Languages Coordinator',
            'Buddy Coordinator', 'IT Coordinator', 'Alumni Coordinator', 'ISC Care Coordinator', 'Visa Coordinator'];
    }

    public function getWebContacts()
    {
        $contacts = $this->contacts->filter(function ($value, $key) {
            return in_array($value['position'], $this->positions_to_display_in_contacts);
        });

        return $contacts->shuffle();
    }

    public function getContactByPosition(string $position)
    {
        return $this->contacts->first(function ($value) use($position) {
           return $value['position'] == $position;
        });
    }

}