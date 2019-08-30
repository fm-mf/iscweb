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
        $contactImageFolder = 'img/web/contacts/2019-spring';

        $this->contacts = collect([
            [
                'name' => 'Jakub Nový',
                'position' => 'President',
                'email' => 'president@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/kuba-president.jpg")
            ],
            [
                'name' => 'Michal Nečas',
                'position' => 'Vicepresident',
                'email' => 'vicepresident@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/neci-vice.jpg")
            ],
            [
                'name' => 'David Mládek',
                'position' => 'Treasurer',
                'email' => 'treasurer@isc.cvut.cz',
                'phone' => '+420 721 155 737',
                'avatar' => asset("{$contactImageFolder}/david-treasurer.jpg")
            ],
            [
                'name' => 'Eva Eöllősová',
                'position' => 'Public Relations',
                'email' => 'pr@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($femaleSilhouette)
            ],
            [
                'name' => 'Jakub Doupal',
                'position' => 'Local Representative',
                'email' => 'lr@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Michal Cihlář',
                'position' => 'Human Resources',
                'email' => 'hr@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Jan Vůjtěch',
                'position' => 'Quality and Knowledge Manager',
                'email' => 'knowledge@isc.cvut.cz',
                'phone' => '+420 728 559 713',
                'avatar' => asset("{$contactImageFolder}/honza-qak.jpg")
            ],
            [
                'name' => 'Victoria Usan',
                'position' => 'Activities Coordinator',
                'email' => 'activities@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($femaleSilhouette)
            ],
            [
                'name' => 'Jakub Trhlík',
                'position' => 'inteGREAT Coordinator',
                'email' => 'integreat@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Jan Páleník',
                'position' => 'IT Coordinator',
                'email' => 'it@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Filip Marek',
                'position' => 'Point Coordinator',
                'email' => 'point@isc.cvut.cz',
                'phone' => '+420 732 227 056',
                'avatar' => asset('img/web/contacts/2017fall/it-filip.jpg'),
            ],[
                'name' => 'Rajmund Hruška',
                'position' => 'Languages Coordinator',
                'email' => 'languages@isc.cvut.cz',
                'phone' => '+421 902 833 731',
                'avatar' => asset("{$contactImageFolder}/rajmund-languages.jpg")
            ],
            [
                'name' => 'Jan Zípek',
                'position' => 'Buddy Coordinator',
                'email' => 'buddy@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset($maleSilhouette)
            ],
            [
                'name' => 'Dominik Bureš',
                'position' => 'Alumni Coordinator',
                'email' => 'alumni@isc.cvut.cz',
                'phone' => '',
                'avatar' => asset("{$contactImageFolder}/dominik-alumni.jpg")
            ],
            [
                'name' => 'Antonín Ženíšek',
                'position' => 'Sports Coordinator',
                'email' => 'sports@isc.cvut.cz',
                'phone' => '+420 725 483 392',
                'avatar' => asset("{$contactImageFolder}/tonda-sports.jpg")
            ],
            [
                'name' => 'Kristýna Švandová',
                'position' => 'ISC Care Coordinator',
                'email' => 'care@isc.cvut.cz',
                'phone' => '+420 774 004 806',
                'avatar' => asset("{$contactImageFolder}/tyna-care.jpg")
            ],
            [
                'name' => 'Jan Batysta',
                'position' => 'Visa Coordinator',
                'email' => 'visa@isc.cvut.cz',
                'phone' => '+420 777 048 852',
                'avatar' => asset("{$contactImageFolder}/bautysta-visa.jpg")
            ],
            [
                'name' => 'Martin Vlk',
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
        return $this->contacts->firstWhere('position', $position);
    }

    public function getContactsByPosition(array $positions)
    {
        return $this->contacts->filter(function ($value) use ($positions) {
            return in_array($value['position'], $positions);
        });
    }

}
