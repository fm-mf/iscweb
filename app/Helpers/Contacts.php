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
                'name' => 'Jakub Nový',
                'position' => 'President',
                'email' => 'president@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/pr-jakub.jpg")
            ],
            [
                'name' => 'Michal Nečas',
                'position' => 'Vicepresident',
                'email' => 'vicepresident@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/care-michal.jpg")
            ],
            [
                'name' => 'Michaela Petříková',
                'position' => 'Human Resources',
                'email' => 'hr@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/hr-misa.jpg")
            ],
            [
                'name' => 'David Mládek',
                'position' => 'Treasurer',
                'email' => 'treasurer@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("img/web/contacts/2017fall/point-david.jpg")
            ],
            [
                'name' => 'Kateřina Vrbová',
                'position' => 'Public Relations',
                'email' => 'pr@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($femaleSilhouette)
            ],
            [
                'name' => 'Matěj Mysliveček',
                'position' => 'Local Representative',
                'email' => 'lr@isc.cvut.cz',
                'phone' => '+420 777 669 787',
                'avatar' => asset("{$contactImageFolder}/lr-matej.jpg")
            ],
            [
                'name' => 'Jan Vůjtěch',
                'position' => 'Quality and Knowledge Manager',
                'email' => 'knowledge@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("img/web/contacts/2017fall/treasurer-jan.jpg")
            ],
            [
                'name' => 'Petra Schůtová',
                'position' => 'inteGREAT Coordinator',
                'email' => 'integreat@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($femaleSilhouette)
            ],
            [
                'name' => 'Tomáš Hrdlovics',
                'position' => 'Point Coordinator',
                'email' => 'point@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Michal Kubina',
                'position' => 'Activities Coordinator',
                'email' => 'activities@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Rajmund Hruška',
                'position' => 'Languages Coordinator',
                'email' => 'languages@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Jiří Hájek',
                'position' => 'Buddy Coordinator',
                'email' => 'buddy@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Petr "Fíďa" Fiedler',
                'position' => 'IT Coordinator',
                'email' => 'it@isc.cvut.cz',
                'phone' => '+420 608 990 369',
                'avatar' => asset("{$contactImageFolder}/it-fida.jpg")
            ],
            [
                'name' => 'Dominik Bureš',
                'position' => 'Alumni Coordinator',
                'email' => 'alumni@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("img/web/contacts/2017fall/qak-dominik.jpg")
            ],
            [
                'name' => 'Antonín Ženíšek',
                'position' => 'Sports Coordinator',
                'email' => 'sports@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Kristýna Švandová',
                'position' => 'ISC Care Coordinator',
                'email' => 'care@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($femaleSilhouette)
            ],
            [
                'name' => 'Jan Batysta',
                'position' => 'Visa Coordinator',
                'email' => 'visa@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Kryštof Šimána',
                'position' => 'Trips Coordinator',
                'email' => 'trips@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette) 
            ]
        ]);

        $this->positions_to_display_in_contacts = ['President', 'Vicepresident', 'Human Resources', 'Treasurer',
            'Public Relations', 'Local Representative', 'Quality and Knowledge Manager',
            'inteGREAT Coordinator', 'Point Coordinator', 'Activities Coordinator', 'Languages Coordinator',
            'Buddy Coordinator', 'IT Coordinator', 'Alumni Coordinator', 'ISC Care Coordinator', 'Visa Coordinator'];
    }

    public function getWebContacts()
    {
        return $this->contacts->filter(function ($value, $key) {
            return in_array($value['position'], $this->positions_to_display_in_contacts);
        });
    }

    public function getContactByPosition(string $position)
    {
        return $this->contacts->first(function ($value) use($position) {
           return $value['position'] == $position;
        });
    }

}
