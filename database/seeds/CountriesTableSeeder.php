<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id_country' => 1,
                'full_name' => 'Afghanistan',
                'two_letters' => 'AF',
                'three_letters' => 'AFG',
            ),
            1 => 
            array (
                'id_country' => 2,
                'full_name' => 'Aland Islands',
                'two_letters' => 'AX',
                'three_letters' => 'ALA',
            ),
            2 => 
            array (
                'id_country' => 3,
                'full_name' => 'Albania',
                'two_letters' => 'AL',
                'three_letters' => 'ALB',
            ),
            3 => 
            array (
                'id_country' => 4,
                'full_name' => 'Algeria',
                'two_letters' => 'DZ',
                'three_letters' => 'DZA',
            ),
            4 => 
            array (
                'id_country' => 5,
                'full_name' => 'American Samoa',
                'two_letters' => 'AS',
                'three_letters' => 'ASM',
            ),
            5 => 
            array (
                'id_country' => 6,
                'full_name' => 'Andorra',
                'two_letters' => 'AD',
                'three_letters' => 'AND',
            ),
            6 => 
            array (
                'id_country' => 7,
                'full_name' => 'Angola',
                'two_letters' => 'AO',
                'three_letters' => 'AGO',
            ),
            7 => 
            array (
                'id_country' => 8,
                'full_name' => 'Anguilla',
                'two_letters' => 'AI',
                'three_letters' => 'AIA',
            ),
            8 => 
            array (
                'id_country' => 9,
                'full_name' => 'Antarctica',
                'two_letters' => 'AQ',
                'three_letters' => 'ATA',
            ),
            9 => 
            array (
                'id_country' => 10,
                'full_name' => 'Antigua and Barbuda',
                'two_letters' => 'AG',
                'three_letters' => 'ATG',
            ),
            10 => 
            array (
                'id_country' => 11,
                'full_name' => 'Argentina',
                'two_letters' => 'AR',
                'three_letters' => 'ARG',
            ),
            11 => 
            array (
                'id_country' => 12,
                'full_name' => 'Armenia',
                'two_letters' => 'AM',
                'three_letters' => 'ARM',
            ),
            12 => 
            array (
                'id_country' => 13,
                'full_name' => 'Aruba',
                'two_letters' => 'AW',
                'three_letters' => 'ABW',
            ),
            13 => 
            array (
                'id_country' => 14,
                'full_name' => 'Australia',
                'two_letters' => 'AU',
                'three_letters' => 'AUS',
            ),
            14 => 
            array (
                'id_country' => 15,
                'full_name' => 'Austria',
                'two_letters' => 'AT',
                'three_letters' => 'AUT',
            ),
            15 => 
            array (
                'id_country' => 16,
                'full_name' => 'Azerbaijan',
                'two_letters' => 'AZ',
                'three_letters' => 'AZE',
            ),
            16 => 
            array (
                'id_country' => 17,
                'full_name' => 'Bahamas',
                'two_letters' => 'BS',
                'three_letters' => 'BHS',
            ),
            17 => 
            array (
                'id_country' => 18,
                'full_name' => 'Bahrain',
                'two_letters' => 'BH',
                'three_letters' => 'BHR',
            ),
            18 => 
            array (
                'id_country' => 19,
                'full_name' => 'Bangladesh',
                'two_letters' => 'BD',
                'three_letters' => 'BGD',
            ),
            19 => 
            array (
                'id_country' => 20,
                'full_name' => 'Barbados',
                'two_letters' => 'BB',
                'three_letters' => 'BRB',
            ),
            20 => 
            array (
                'id_country' => 21,
                'full_name' => 'Belarus',
                'two_letters' => 'BY',
                'three_letters' => 'BLR',
            ),
            21 => 
            array (
                'id_country' => 22,
                'full_name' => 'Belgium',
                'two_letters' => 'BE',
                'three_letters' => 'BEL',
            ),
            22 => 
            array (
                'id_country' => 23,
                'full_name' => 'Belize',
                'two_letters' => 'BZ',
                'three_letters' => 'BLZ',
            ),
            23 => 
            array (
                'id_country' => 24,
                'full_name' => 'Benin',
                'two_letters' => 'BJ',
                'three_letters' => 'BEN',
            ),
            24 => 
            array (
                'id_country' => 25,
                'full_name' => 'Bermuda',
                'two_letters' => 'BM',
                'three_letters' => 'BMU',
            ),
            25 => 
            array (
                'id_country' => 26,
                'full_name' => 'Bhutan',
                'two_letters' => 'BT',
                'three_letters' => 'BTN',
            ),
            26 => 
            array (
                'id_country' => 27,
                'full_name' => 'Bolivia',
                'two_letters' => 'BO',
                'three_letters' => 'BOL',
            ),
            27 => 
            array (
                'id_country' => 28,
                'full_name' => 'Bosnia and Herzegovina',
                'two_letters' => 'BA',
                'three_letters' => 'BIH',
            ),
            28 => 
            array (
                'id_country' => 29,
                'full_name' => 'Botswana',
                'two_letters' => 'BW',
                'three_letters' => 'BWA',
            ),
            29 => 
            array (
                'id_country' => 30,
                'full_name' => 'Bouvet Island',
                'two_letters' => 'BV',
                'three_letters' => 'BVT',
            ),
            30 => 
            array (
                'id_country' => 31,
                'full_name' => 'Brazil',
                'two_letters' => 'BR',
                'three_letters' => 'BRA',
            ),
            31 => 
            array (
                'id_country' => 32,
                'full_name' => 'British Virgin Islands',
                'two_letters' => 'VG',
                'three_letters' => 'VGB',
            ),
            32 => 
            array (
                'id_country' => 33,
                'full_name' => 'British Indian Ocean Territory',
                'two_letters' => 'IO',
                'three_letters' => 'IOT',
            ),
            33 => 
            array (
                'id_country' => 34,
                'full_name' => 'Brunei Darussalam',
                'two_letters' => 'BN',
                'three_letters' => 'BRN',
            ),
            34 => 
            array (
                'id_country' => 35,
                'full_name' => 'Bulgaria',
                'two_letters' => 'BG',
                'three_letters' => 'BGR',
            ),
            35 => 
            array (
                'id_country' => 36,
                'full_name' => 'Burkina Faso',
                'two_letters' => 'BF',
                'three_letters' => 'BFA',
            ),
            36 => 
            array (
                'id_country' => 37,
                'full_name' => 'Burundi',
                'two_letters' => 'BI',
                'three_letters' => 'BDI',
            ),
            37 => 
            array (
                'id_country' => 38,
                'full_name' => 'Cambodia',
                'two_letters' => 'KH',
                'three_letters' => 'KHM',
            ),
            38 => 
            array (
                'id_country' => 39,
                'full_name' => 'Cameroon',
                'two_letters' => 'CM',
                'three_letters' => 'CMR',
            ),
            39 => 
            array (
                'id_country' => 40,
                'full_name' => 'Canada',
                'two_letters' => 'CA',
                'three_letters' => 'CAN',
            ),
            40 => 
            array (
                'id_country' => 41,
                'full_name' => 'Cape Verde',
                'two_letters' => 'CV',
                'three_letters' => 'CPV',
            ),
            41 => 
            array (
                'id_country' => 42,
                'full_name' => 'Cayman Islands',
                'two_letters' => 'KY',
                'three_letters' => 'CYM',
            ),
            42 => 
            array (
                'id_country' => 43,
                'full_name' => 'Central African Republic',
                'two_letters' => 'CF',
                'three_letters' => 'CAF',
            ),
            43 => 
            array (
                'id_country' => 44,
                'full_name' => 'Chad',
                'two_letters' => 'TD',
                'three_letters' => 'TCD',
            ),
            44 => 
            array (
                'id_country' => 45,
                'full_name' => 'Chile',
                'two_letters' => 'CL',
                'three_letters' => 'CHL',
            ),
            45 => 
            array (
                'id_country' => 46,
                'full_name' => 'China',
                'two_letters' => 'CN',
                'three_letters' => 'CHN',
            ),
            46 => 
            array (
                'id_country' => 47,
                'full_name' => 'Hong Kong',
                'two_letters' => 'HK',
                'three_letters' => 'HKG',
            ),
            47 => 
            array (
                'id_country' => 48,
                'full_name' => 'Macao',
                'two_letters' => 'MO',
                'three_letters' => 'MAC',
            ),
            48 => 
            array (
                'id_country' => 49,
                'full_name' => 'Christmas Island',
                'two_letters' => 'CX',
                'three_letters' => 'CXR',
            ),
            49 => 
            array (
                'id_country' => 50,
            'full_name' => 'Cocos (Keeling) Islands',
                'two_letters' => 'CC',
                'three_letters' => 'CCK',
            ),
            50 => 
            array (
                'id_country' => 51,
                'full_name' => 'Colombia',
                'two_letters' => 'CO',
                'three_letters' => 'COL',
            ),
            51 => 
            array (
                'id_country' => 52,
                'full_name' => 'Comoros',
                'two_letters' => 'KM',
                'three_letters' => 'COM',
            ),
            52 => 
            array (
                'id_country' => 53,
                'full_name' => 'Congo',
                'two_letters' => 'CG',
                'three_letters' => 'COG',
            ),
            53 => 
            array (
                'id_country' => 54,
                'full_name' => 'Democratic Republic of the Congo',
                'two_letters' => 'CD',
                'three_letters' => 'COD',
            ),
            54 => 
            array (
                'id_country' => 55,
                'full_name' => 'Cook Islands',
                'two_letters' => 'CK',
                'three_letters' => 'COK',
            ),
            55 => 
            array (
                'id_country' => 56,
                'full_name' => 'Costa Rica',
                'two_letters' => 'CR',
                'three_letters' => 'CRI',
            ),
            56 => 
            array (
                'id_country' => 57,
                'full_name' => 'Côte d\'Ivoire',
                'two_letters' => 'CI',
                'three_letters' => 'CIV',
            ),
            57 => 
            array (
                'id_country' => 58,
                'full_name' => 'Croatia',
                'two_letters' => 'HR',
                'three_letters' => 'HRV',
            ),
            58 => 
            array (
                'id_country' => 59,
                'full_name' => 'Cuba',
                'two_letters' => 'CU',
                'three_letters' => 'CUB',
            ),
            59 => 
            array (
                'id_country' => 60,
                'full_name' => 'Cyprus',
                'two_letters' => 'CY',
                'three_letters' => 'CYP',
            ),
            60 => 
            array (
                'id_country' => 61,
                'full_name' => 'Czech Republic',
                'two_letters' => 'CZ',
                'three_letters' => 'CZE',
            ),
            61 => 
            array (
                'id_country' => 62,
                'full_name' => 'Denmark',
                'two_letters' => 'DK',
                'three_letters' => 'DNK',
            ),
            62 => 
            array (
                'id_country' => 63,
                'full_name' => 'Djibouti',
                'two_letters' => 'DJ',
                'three_letters' => 'DJI',
            ),
            63 => 
            array (
                'id_country' => 64,
                'full_name' => 'Dominica',
                'two_letters' => 'DM',
                'three_letters' => 'DMA',
            ),
            64 => 
            array (
                'id_country' => 65,
                'full_name' => 'Dominican Republic',
                'two_letters' => 'DO',
                'three_letters' => 'DOM',
            ),
            65 => 
            array (
                'id_country' => 66,
                'full_name' => 'Ecuador',
                'two_letters' => 'EC',
                'three_letters' => 'ECU',
            ),
            66 => 
            array (
                'id_country' => 67,
                'full_name' => 'Egypt',
                'two_letters' => 'EG',
                'three_letters' => 'EGY',
            ),
            67 => 
            array (
                'id_country' => 68,
                'full_name' => 'El Salvador',
                'two_letters' => 'SV',
                'three_letters' => 'SLV',
            ),
            68 => 
            array (
                'id_country' => 69,
                'full_name' => 'Equatorial Guinea',
                'two_letters' => 'GQ',
                'three_letters' => 'GNQ',
            ),
            69 => 
            array (
                'id_country' => 70,
                'full_name' => 'Eritrea',
                'two_letters' => 'ER',
                'three_letters' => 'ERI',
            ),
            70 => 
            array (
                'id_country' => 71,
                'full_name' => 'Estonia',
                'two_letters' => 'EE',
                'three_letters' => 'EST',
            ),
            71 => 
            array (
                'id_country' => 72,
                'full_name' => 'Ethiopia',
                'two_letters' => 'ET',
                'three_letters' => 'ETH',
            ),
            72 => 
            array (
                'id_country' => 73,
            'full_name' => 'Falkland Islands (Malvinas)',
                'two_letters' => 'FK',
                'three_letters' => 'FLK',
            ),
            73 => 
            array (
                'id_country' => 74,
                'full_name' => 'Faroe Islands',
                'two_letters' => 'FO',
                'three_letters' => 'FRO',
            ),
            74 => 
            array (
                'id_country' => 75,
                'full_name' => 'Fiji',
                'two_letters' => 'FJ',
                'three_letters' => 'FJI',
            ),
            75 => 
            array (
                'id_country' => 76,
                'full_name' => 'Finland',
                'two_letters' => 'FI',
                'three_letters' => 'FIN',
            ),
            76 => 
            array (
                'id_country' => 77,
                'full_name' => 'France',
                'two_letters' => 'FR',
                'three_letters' => 'FRA',
            ),
            77 => 
            array (
                'id_country' => 78,
                'full_name' => 'French Guiana',
                'two_letters' => 'GF',
                'three_letters' => 'GUF',
            ),
            78 => 
            array (
                'id_country' => 79,
                'full_name' => 'French Polynesia',
                'two_letters' => 'PF',
                'three_letters' => 'PYF',
            ),
            79 => 
            array (
                'id_country' => 80,
                'full_name' => 'French Southern Territories',
                'two_letters' => 'TF',
                'three_letters' => 'ATF',
            ),
            80 => 
            array (
                'id_country' => 81,
                'full_name' => 'Gabon',
                'two_letters' => 'GA',
                'three_letters' => 'GAB',
            ),
            81 => 
            array (
                'id_country' => 82,
                'full_name' => 'Gambia',
                'two_letters' => 'GM',
                'three_letters' => 'GMB',
            ),
            82 => 
            array (
                'id_country' => 83,
                'full_name' => 'Georgia',
                'two_letters' => 'GE',
                'three_letters' => 'GEO',
            ),
            83 => 
            array (
                'id_country' => 84,
                'full_name' => 'Germany',
                'two_letters' => 'DE',
                'three_letters' => 'DEU',
            ),
            84 => 
            array (
                'id_country' => 85,
                'full_name' => 'Ghana',
                'two_letters' => 'GH',
                'three_letters' => 'GHA',
            ),
            85 => 
            array (
                'id_country' => 86,
                'full_name' => 'Gibraltar',
                'two_letters' => 'GI',
                'three_letters' => 'GIB',
            ),
            86 => 
            array (
                'id_country' => 87,
                'full_name' => 'Greece',
                'two_letters' => 'GR',
                'three_letters' => 'GRC',
            ),
            87 => 
            array (
                'id_country' => 88,
                'full_name' => 'Greenland',
                'two_letters' => 'GL',
                'three_letters' => 'GRL',
            ),
            88 => 
            array (
                'id_country' => 89,
                'full_name' => 'Grenada',
                'two_letters' => 'GD',
                'three_letters' => 'GRD',
            ),
            89 => 
            array (
                'id_country' => 90,
                'full_name' => 'Guadeloupe',
                'two_letters' => 'GP',
                'three_letters' => 'GLP',
            ),
            90 => 
            array (
                'id_country' => 91,
                'full_name' => 'Guam',
                'two_letters' => 'GU',
                'three_letters' => 'GUM',
            ),
            91 => 
            array (
                'id_country' => 92,
                'full_name' => 'Guatemala',
                'two_letters' => 'GT',
                'three_letters' => 'GTM',
            ),
            92 => 
            array (
                'id_country' => 93,
                'full_name' => 'Guernsey',
                'two_letters' => 'GG',
                'three_letters' => 'GGY',
            ),
            93 => 
            array (
                'id_country' => 94,
                'full_name' => 'Guinea',
                'two_letters' => 'GN',
                'three_letters' => 'GIN',
            ),
            94 => 
            array (
                'id_country' => 95,
                'full_name' => 'Guinea-Bissau',
                'two_letters' => 'GW',
                'three_letters' => 'GNB',
            ),
            95 => 
            array (
                'id_country' => 96,
                'full_name' => 'Guyana',
                'two_letters' => 'GY',
                'three_letters' => 'GUY',
            ),
            96 => 
            array (
                'id_country' => 97,
                'full_name' => 'Haiti',
                'two_letters' => 'HT',
                'three_letters' => 'HTI',
            ),
            97 => 
            array (
                'id_country' => 98,
                'full_name' => 'Heard Island and Mcdonald Islands',
                'two_letters' => 'HM',
                'three_letters' => 'HMD',
            ),
            98 => 
            array (
                'id_country' => 99,
            'full_name' => 'Holy See (Vatican City State)',
                'two_letters' => 'VA',
                'three_letters' => 'VAT',
            ),
            99 => 
            array (
                'id_country' => 100,
                'full_name' => 'Honduras',
                'two_letters' => 'HN',
                'three_letters' => 'HND',
            ),
            100 => 
            array (
                'id_country' => 101,
                'full_name' => 'Hungary',
                'two_letters' => 'HU',
                'three_letters' => 'HUN',
            ),
            101 => 
            array (
                'id_country' => 102,
                'full_name' => 'Iceland',
                'two_letters' => 'IS',
                'three_letters' => 'ISL',
            ),
            102 => 
            array (
                'id_country' => 103,
                'full_name' => 'India',
                'two_letters' => 'IN',
                'three_letters' => 'IND',
            ),
            103 => 
            array (
                'id_country' => 104,
                'full_name' => 'Indonesia',
                'two_letters' => 'ID',
                'three_letters' => 'IDN',
            ),
            104 => 
            array (
                'id_country' => 105,
                'full_name' => 'Islamic Republic of Iran',
                'two_letters' => 'IR',
                'three_letters' => 'IRN',
            ),
            105 => 
            array (
                'id_country' => 106,
                'full_name' => 'Iraq',
                'two_letters' => 'IQ',
                'three_letters' => 'IRQ',
            ),
            106 => 
            array (
                'id_country' => 107,
                'full_name' => 'Ireland',
                'two_letters' => 'IE',
                'three_letters' => 'IRL',
            ),
            107 => 
            array (
                'id_country' => 108,
                'full_name' => 'Isle of Man',
                'two_letters' => 'IM',
                'three_letters' => 'IMN',
            ),
            108 => 
            array (
                'id_country' => 109,
                'full_name' => 'Israel',
                'two_letters' => 'IL',
                'three_letters' => 'ISR',
            ),
            109 => 
            array (
                'id_country' => 110,
                'full_name' => 'Italy',
                'two_letters' => 'IT',
                'three_letters' => 'ITA',
            ),
            110 => 
            array (
                'id_country' => 111,
                'full_name' => 'Jamaica',
                'two_letters' => 'JM',
                'three_letters' => 'JAM',
            ),
            111 => 
            array (
                'id_country' => 112,
                'full_name' => 'Japan',
                'two_letters' => 'JP',
                'three_letters' => 'JPN',
            ),
            112 => 
            array (
                'id_country' => 113,
                'full_name' => 'Jersey',
                'two_letters' => 'JE',
                'three_letters' => 'JEY',
            ),
            113 => 
            array (
                'id_country' => 114,
                'full_name' => 'Jordan',
                'two_letters' => 'JO',
                'three_letters' => 'JOR',
            ),
            114 => 
            array (
                'id_country' => 115,
                'full_name' => 'Kazakhstan',
                'two_letters' => 'KZ',
                'three_letters' => 'KAZ',
            ),
            115 => 
            array (
                'id_country' => 116,
                'full_name' => 'Kenya',
                'two_letters' => 'KE',
                'three_letters' => 'KEN',
            ),
            116 => 
            array (
                'id_country' => 117,
                'full_name' => 'Kiribati',
                'two_letters' => 'KI',
                'three_letters' => 'KIR',
            ),
            117 => 
            array (
                'id_country' => 118,
                'full_name' => 'Democratic People\'s Republic of Korea',
                'two_letters' => 'KP',
                'three_letters' => 'PRK',
            ),
            118 => 
            array (
                'id_country' => 119,
                'full_name' => 'Republic of Korea',
                'two_letters' => 'KR',
                'three_letters' => 'KOR',
            ),
            119 => 
            array (
                'id_country' => 120,
                'full_name' => 'Kuwait',
                'two_letters' => 'KW',
                'three_letters' => 'KWT',
            ),
            120 => 
            array (
                'id_country' => 121,
                'full_name' => 'Kyrgyzstan',
                'two_letters' => 'KG',
                'three_letters' => 'KGZ',
            ),
            121 => 
            array (
                'id_country' => 122,
                'full_name' => 'Lao PDR',
                'two_letters' => 'LA',
                'three_letters' => 'LAO',
            ),
            122 => 
            array (
                'id_country' => 123,
                'full_name' => 'Latvia',
                'two_letters' => 'LV',
                'three_letters' => 'LVA',
            ),
            123 => 
            array (
                'id_country' => 124,
                'full_name' => 'Lebanon',
                'two_letters' => 'LB',
                'three_letters' => 'LBN',
            ),
            124 => 
            array (
                'id_country' => 125,
                'full_name' => 'Lesotho',
                'two_letters' => 'LS',
                'three_letters' => 'LSO',
            ),
            125 => 
            array (
                'id_country' => 126,
                'full_name' => 'Liberia',
                'two_letters' => 'LR',
                'three_letters' => 'LBR',
            ),
            126 => 
            array (
                'id_country' => 127,
                'full_name' => 'Libya',
                'two_letters' => 'LY',
                'three_letters' => 'LBY',
            ),
            127 => 
            array (
                'id_country' => 128,
                'full_name' => 'Liechtenstein',
                'two_letters' => 'LI',
                'three_letters' => 'LIE',
            ),
            128 => 
            array (
                'id_country' => 129,
                'full_name' => 'Lithuania',
                'two_letters' => 'LT',
                'three_letters' => 'LTU',
            ),
            129 => 
            array (
                'id_country' => 130,
                'full_name' => 'Luxembourg',
                'two_letters' => 'LU',
                'three_letters' => 'LUX',
            ),
            130 => 
            array (
                'id_country' => 131,
                'full_name' => 'Republic of Macedonia',
                'two_letters' => 'MK',
                'three_letters' => 'MKD',
            ),
            131 => 
            array (
                'id_country' => 132,
                'full_name' => 'Madagascar',
                'two_letters' => 'MG',
                'three_letters' => 'MDG',
            ),
            132 => 
            array (
                'id_country' => 133,
                'full_name' => 'Malawi',
                'two_letters' => 'MW',
                'three_letters' => 'MWI',
            ),
            133 => 
            array (
                'id_country' => 134,
                'full_name' => 'Malaysia',
                'two_letters' => 'MY',
                'three_letters' => 'MYS',
            ),
            134 => 
            array (
                'id_country' => 135,
                'full_name' => 'Maldives',
                'two_letters' => 'MV',
                'three_letters' => 'MDV',
            ),
            135 => 
            array (
                'id_country' => 136,
                'full_name' => 'Mali',
                'two_letters' => 'ML',
                'three_letters' => 'MLI',
            ),
            136 => 
            array (
                'id_country' => 137,
                'full_name' => 'Malta',
                'two_letters' => 'MT',
                'three_letters' => 'MLT',
            ),
            137 => 
            array (
                'id_country' => 138,
                'full_name' => 'Marshall Islands',
                'two_letters' => 'MH',
                'three_letters' => 'MHL',
            ),
            138 => 
            array (
                'id_country' => 139,
                'full_name' => 'Martinique',
                'two_letters' => 'MQ',
                'three_letters' => 'MTQ',
            ),
            139 => 
            array (
                'id_country' => 140,
                'full_name' => 'Mauritania',
                'two_letters' => 'MR',
                'three_letters' => 'MRT',
            ),
            140 => 
            array (
                'id_country' => 141,
                'full_name' => 'Mauritius',
                'two_letters' => 'MU',
                'three_letters' => 'MUS',
            ),
            141 => 
            array (
                'id_country' => 142,
                'full_name' => 'Mayotte',
                'two_letters' => 'YT',
                'three_letters' => 'MYT',
            ),
            142 => 
            array (
                'id_country' => 143,
                'full_name' => 'Mexico',
                'two_letters' => 'MX',
                'three_letters' => 'MEX',
            ),
            143 => 
            array (
                'id_country' => 144,
                'full_name' => 'Federated States of Micronesia',
                'two_letters' => 'FM',
                'three_letters' => 'FSM',
            ),
            144 => 
            array (
                'id_country' => 145,
                'full_name' => 'Moldova',
                'two_letters' => 'MD',
                'three_letters' => 'MDA',
            ),
            145 => 
            array (
                'id_country' => 146,
                'full_name' => 'Monaco',
                'two_letters' => 'MC',
                'three_letters' => 'MCO',
            ),
            146 => 
            array (
                'id_country' => 147,
                'full_name' => 'Mongolia',
                'two_letters' => 'MN',
                'three_letters' => 'MNG',
            ),
            147 => 
            array (
                'id_country' => 148,
                'full_name' => 'Montenegro',
                'two_letters' => 'ME',
                'three_letters' => 'MNE',
            ),
            148 => 
            array (
                'id_country' => 149,
                'full_name' => 'Montserrat',
                'two_letters' => 'MS',
                'three_letters' => 'MSR',
            ),
            149 => 
            array (
                'id_country' => 150,
                'full_name' => 'Morocco',
                'two_letters' => 'MA',
                'three_letters' => 'MAR',
            ),
            150 => 
            array (
                'id_country' => 151,
                'full_name' => 'Mozambique',
                'two_letters' => 'MZ',
                'three_letters' => 'MOZ',
            ),
            151 => 
            array (
                'id_country' => 152,
                'full_name' => 'Myanmar',
                'two_letters' => 'MM',
                'three_letters' => 'MMR',
            ),
            152 => 
            array (
                'id_country' => 153,
                'full_name' => 'Namibia',
                'two_letters' => 'NA',
                'three_letters' => 'NAM',
            ),
            153 => 
            array (
                'id_country' => 154,
                'full_name' => 'Nauru',
                'two_letters' => 'NR',
                'three_letters' => 'NRU',
            ),
            154 => 
            array (
                'id_country' => 155,
                'full_name' => 'Nepal',
                'two_letters' => 'NP',
                'three_letters' => 'NPL',
            ),
            155 => 
            array (
                'id_country' => 156,
                'full_name' => 'Netherlands',
                'two_letters' => 'NL',
                'three_letters' => 'NLD',
            ),
            156 => 
            array (
                'id_country' => 157,
                'full_name' => 'Netherlands Antilles',
                'two_letters' => 'AN',
                'three_letters' => 'ANT',
            ),
            157 => 
            array (
                'id_country' => 158,
                'full_name' => 'New Caledonia',
                'two_letters' => 'NC',
                'three_letters' => 'NCL',
            ),
            158 => 
            array (
                'id_country' => 159,
                'full_name' => 'New Zealand',
                'two_letters' => 'NZ',
                'three_letters' => 'NZL',
            ),
            159 => 
            array (
                'id_country' => 160,
                'full_name' => 'Nicaragua',
                'two_letters' => 'NI',
                'three_letters' => 'NIC',
            ),
            160 => 
            array (
                'id_country' => 161,
                'full_name' => 'Niger',
                'two_letters' => 'NE',
                'three_letters' => 'NER',
            ),
            161 => 
            array (
                'id_country' => 162,
                'full_name' => 'Nigeria',
                'two_letters' => 'NG',
                'three_letters' => 'NGA',
            ),
            162 => 
            array (
                'id_country' => 163,
                'full_name' => 'Niue',
                'two_letters' => 'NU',
                'three_letters' => 'NIU',
            ),
            163 => 
            array (
                'id_country' => 164,
                'full_name' => 'Norfolk Island',
                'two_letters' => 'NF',
                'three_letters' => 'NFK',
            ),
            164 => 
            array (
                'id_country' => 165,
                'full_name' => 'Northern Mariana Islands',
                'two_letters' => 'MP',
                'three_letters' => 'MNP',
            ),
            165 => 
            array (
                'id_country' => 166,
                'full_name' => 'Norway',
                'two_letters' => 'NO',
                'three_letters' => 'NOR',
            ),
            166 => 
            array (
                'id_country' => 167,
                'full_name' => 'Oman',
                'two_letters' => 'OM',
                'three_letters' => 'OMN',
            ),
            167 => 
            array (
                'id_country' => 168,
                'full_name' => 'Pakistan',
                'two_letters' => 'PK',
                'three_letters' => 'PAK',
            ),
            168 => 
            array (
                'id_country' => 169,
                'full_name' => 'Palau',
                'two_letters' => 'PW',
                'three_letters' => 'PLW',
            ),
            169 => 
            array (
                'id_country' => 170,
                'full_name' => 'Palestinian Territory',
                'two_letters' => 'PS',
                'three_letters' => 'PSE',
            ),
            170 => 
            array (
                'id_country' => 171,
                'full_name' => 'Panama',
                'two_letters' => 'PA',
                'three_letters' => 'PAN',
            ),
            171 => 
            array (
                'id_country' => 172,
                'full_name' => 'Papua New Guinea',
                'two_letters' => 'PG',
                'three_letters' => 'PNG',
            ),
            172 => 
            array (
                'id_country' => 173,
                'full_name' => 'Paraguay',
                'two_letters' => 'PY',
                'three_letters' => 'PRY',
            ),
            173 => 
            array (
                'id_country' => 174,
                'full_name' => 'Peru',
                'two_letters' => 'PE',
                'three_letters' => 'PER',
            ),
            174 => 
            array (
                'id_country' => 175,
                'full_name' => 'Philippines',
                'two_letters' => 'PH',
                'three_letters' => 'PHL',
            ),
            175 => 
            array (
                'id_country' => 176,
                'full_name' => 'Pitcairn',
                'two_letters' => 'PN',
                'three_letters' => 'PCN',
            ),
            176 => 
            array (
                'id_country' => 177,
                'full_name' => 'Poland',
                'two_letters' => 'PL',
                'three_letters' => 'POL',
            ),
            177 => 
            array (
                'id_country' => 178,
                'full_name' => 'Portugal',
                'two_letters' => 'PT',
                'three_letters' => 'PRT',
            ),
            178 => 
            array (
                'id_country' => 179,
                'full_name' => 'Puerto Rico',
                'two_letters' => 'PR',
                'three_letters' => 'PRI',
            ),
            179 => 
            array (
                'id_country' => 180,
                'full_name' => 'Qatar',
                'two_letters' => 'QA',
                'three_letters' => 'QAT',
            ),
            180 => 
            array (
                'id_country' => 181,
                'full_name' => 'Réunion',
                'two_letters' => 'RE',
                'three_letters' => 'REU',
            ),
            181 => 
            array (
                'id_country' => 182,
                'full_name' => 'Romania',
                'two_letters' => 'RO',
                'three_letters' => 'ROU',
            ),
            182 => 
            array (
                'id_country' => 183,
                'full_name' => 'Russian Federation',
                'two_letters' => 'RU',
                'three_letters' => 'RUS',
            ),
            183 => 
            array (
                'id_country' => 184,
                'full_name' => 'Rwanda',
                'two_letters' => 'RW',
                'three_letters' => 'RWA',
            ),
            184 => 
            array (
                'id_country' => 185,
                'full_name' => 'Saint-Barthélemy',
                'two_letters' => 'BL',
                'three_letters' => 'BLM',
            ),
            185 => 
            array (
                'id_country' => 186,
                'full_name' => 'Saint Helena',
                'two_letters' => 'SH',
                'three_letters' => 'SHN',
            ),
            186 => 
            array (
                'id_country' => 187,
                'full_name' => 'Saint Kitts and Nevis',
                'two_letters' => 'KN',
                'three_letters' => 'KNA',
            ),
            187 => 
            array (
                'id_country' => 188,
                'full_name' => 'Saint Lucia',
                'two_letters' => 'LC',
                'three_letters' => 'LCA',
            ),
            188 => 
            array (
                'id_country' => 189,
                'full_name' => 'Saint-Martin',
                'two_letters' => 'MF',
                'three_letters' => 'MAF',
            ),
            189 => 
            array (
                'id_country' => 190,
                'full_name' => 'Saint Pierre and Miquelon',
                'two_letters' => 'PM',
                'three_letters' => 'SPM',
            ),
            190 => 
            array (
                'id_country' => 191,
                'full_name' => 'Saint Vincent and Grenadines',
                'two_letters' => 'VC',
                'three_letters' => 'VCT',
            ),
            191 => 
            array (
                'id_country' => 192,
                'full_name' => 'Samoa',
                'two_letters' => 'WS',
                'three_letters' => 'WSM',
            ),
            192 => 
            array (
                'id_country' => 193,
                'full_name' => 'San Marino',
                'two_letters' => 'SM',
                'three_letters' => 'SMR',
            ),
            193 => 
            array (
                'id_country' => 194,
                'full_name' => 'Sao Tome and Principe',
                'two_letters' => 'ST',
                'three_letters' => 'STP',
            ),
            194 => 
            array (
                'id_country' => 195,
                'full_name' => 'Saudi Arabia',
                'two_letters' => 'SA',
                'three_letters' => 'SAU',
            ),
            195 => 
            array (
                'id_country' => 196,
                'full_name' => 'Senegal',
                'two_letters' => 'SN',
                'three_letters' => 'SEN',
            ),
            196 => 
            array (
                'id_country' => 197,
                'full_name' => 'Serbia',
                'two_letters' => 'RS',
                'three_letters' => 'SRB',
            ),
            197 => 
            array (
                'id_country' => 198,
                'full_name' => 'Seychelles',
                'two_letters' => 'SC',
                'three_letters' => 'SYC',
            ),
            198 => 
            array (
                'id_country' => 199,
                'full_name' => 'Sierra Leone',
                'two_letters' => 'SL',
                'three_letters' => 'SLE',
            ),
            199 => 
            array (
                'id_country' => 200,
                'full_name' => 'Singapore',
                'two_letters' => 'SG',
                'three_letters' => 'SGP',
            ),
            200 => 
            array (
                'id_country' => 201,
                'full_name' => 'Slovakia',
                'two_letters' => 'SK',
                'three_letters' => 'SVK',
            ),
            201 => 
            array (
                'id_country' => 202,
                'full_name' => 'Slovenia',
                'two_letters' => 'SI',
                'three_letters' => 'SVN',
            ),
            202 => 
            array (
                'id_country' => 203,
                'full_name' => 'Solomon Islands',
                'two_letters' => 'SB',
                'three_letters' => 'SLB',
            ),
            203 => 
            array (
                'id_country' => 204,
                'full_name' => 'Somalia',
                'two_letters' => 'SO',
                'three_letters' => 'SOM',
            ),
            204 => 
            array (
                'id_country' => 205,
                'full_name' => 'South Africa',
                'two_letters' => 'ZA',
                'three_letters' => 'ZAF',
            ),
            205 => 
            array (
                'id_country' => 206,
                'full_name' => 'South Georgia and the South Sandwich Islands',
                'two_letters' => 'GS',
                'three_letters' => 'SGS',
            ),
            206 => 
            array (
                'id_country' => 207,
                'full_name' => 'South Sudan',
                'two_letters' => 'SS',
                'three_letters' => 'SSD',
            ),
            207 => 
            array (
                'id_country' => 208,
                'full_name' => 'Spain',
                'two_letters' => 'ES',
                'three_letters' => 'ESP',
            ),
            208 => 
            array (
                'id_country' => 209,
                'full_name' => 'Sri Lanka',
                'two_letters' => 'LK',
                'three_letters' => 'LKA',
            ),
            209 => 
            array (
                'id_country' => 210,
                'full_name' => 'Sudan',
                'two_letters' => 'SD',
                'three_letters' => 'SDN',
            ),
            210 => 
            array (
                'id_country' => 211,
                'full_name' => 'Suriname',
                'two_letters' => 'SR',
                'three_letters' => 'SUR',
            ),
            211 => 
            array (
                'id_country' => 212,
                'full_name' => 'Svalbard and Jan Mayen Islands',
                'two_letters' => 'SJ',
                'three_letters' => 'SJM',
            ),
            212 => 
            array (
                'id_country' => 213,
                'full_name' => 'Swaziland',
                'two_letters' => 'SZ',
                'three_letters' => 'SWZ',
            ),
            213 => 
            array (
                'id_country' => 214,
                'full_name' => 'Sweden',
                'two_letters' => 'SE',
                'three_letters' => 'SWE',
            ),
            214 => 
            array (
                'id_country' => 215,
                'full_name' => 'Switzerland',
                'two_letters' => 'CH',
                'three_letters' => 'CHE',
            ),
            215 => 
            array (
                'id_country' => 216,
                'full_name' => 'Syrian Arab Republic',
                'two_letters' => 'SY',
                'three_letters' => 'SYR',
            ),
            216 => 
            array (
                'id_country' => 217,
                'full_name' => 'Taiwan',
                'two_letters' => 'TW',
                'three_letters' => 'TWN',
            ),
            217 => 
            array (
                'id_country' => 218,
                'full_name' => 'Tajikistan',
                'two_letters' => 'TJ',
                'three_letters' => 'TJK',
            ),
            218 => 
            array (
                'id_country' => 219,
                'full_name' => 'United Republic of Tanzania',
                'two_letters' => 'TZ',
                'three_letters' => 'TZA',
            ),
            219 => 
            array (
                'id_country' => 220,
                'full_name' => 'Thailand',
                'two_letters' => 'TH',
                'three_letters' => 'THA',
            ),
            220 => 
            array (
                'id_country' => 221,
                'full_name' => 'Timor-Leste',
                'two_letters' => 'TL',
                'three_letters' => 'TLS',
            ),
            221 => 
            array (
                'id_country' => 222,
                'full_name' => 'Togo',
                'two_letters' => 'TG',
                'three_letters' => 'TGO',
            ),
            222 => 
            array (
                'id_country' => 223,
                'full_name' => 'Tokelau',
                'two_letters' => 'TK',
                'three_letters' => 'TKL',
            ),
            223 => 
            array (
                'id_country' => 224,
                'full_name' => 'Tonga',
                'two_letters' => 'TO',
                'three_letters' => 'TON',
            ),
            224 => 
            array (
                'id_country' => 225,
                'full_name' => 'Trinidad and Tobago',
                'two_letters' => 'TT',
                'three_letters' => 'TTO',
            ),
            225 => 
            array (
                'id_country' => 226,
                'full_name' => 'Tunisia',
                'two_letters' => 'TN',
                'three_letters' => 'TUN',
            ),
            226 => 
            array (
                'id_country' => 227,
                'full_name' => 'Turkey',
                'two_letters' => 'TR',
                'three_letters' => 'TUR',
            ),
            227 => 
            array (
                'id_country' => 228,
                'full_name' => 'Turkmenistan',
                'two_letters' => 'TM',
                'three_letters' => 'TKM',
            ),
            228 => 
            array (
                'id_country' => 229,
                'full_name' => 'Turks and Caicos Islands',
                'two_letters' => 'TC',
                'three_letters' => 'TCA',
            ),
            229 => 
            array (
                'id_country' => 230,
                'full_name' => 'Tuvalu',
                'two_letters' => 'TV',
                'three_letters' => 'TUV',
            ),
            230 => 
            array (
                'id_country' => 231,
                'full_name' => 'Uganda',
                'two_letters' => 'UG',
                'three_letters' => 'UGA',
            ),
            231 => 
            array (
                'id_country' => 232,
                'full_name' => 'Ukraine',
                'two_letters' => 'UA',
                'three_letters' => 'UKR',
            ),
            232 => 
            array (
                'id_country' => 233,
                'full_name' => 'United Arab Emirates',
                'two_letters' => 'AE',
                'three_letters' => 'ARE',
            ),
            233 => 
            array (
                'id_country' => 234,
                'full_name' => 'United Kingdom',
                'two_letters' => 'GB',
                'three_letters' => 'GBR',
            ),
            234 => 
            array (
                'id_country' => 235,
                'full_name' => 'United States of America',
                'two_letters' => 'US',
                'three_letters' => 'USA',
            ),
            235 => 
            array (
                'id_country' => 236,
                'full_name' => 'United States Minor Outlying Islands',
                'two_letters' => 'UM',
                'three_letters' => 'UMI',
            ),
            236 => 
            array (
                'id_country' => 237,
                'full_name' => 'Uruguay',
                'two_letters' => 'UY',
                'three_letters' => 'URY',
            ),
            237 => 
            array (
                'id_country' => 238,
                'full_name' => 'Uzbekistan',
                'two_letters' => 'UZ',
                'three_letters' => 'UZB',
            ),
            238 => 
            array (
                'id_country' => 239,
                'full_name' => 'Vanuatu',
                'two_letters' => 'VU',
                'three_letters' => 'VUT',
            ),
            239 => 
            array (
                'id_country' => 240,
                'full_name' => 'Bolivarian Republic of Venezuela',
                'two_letters' => 'VE',
                'three_letters' => 'VEN',
            ),
            240 => 
            array (
                'id_country' => 241,
                'full_name' => 'Viet Nam',
                'two_letters' => 'VN',
                'three_letters' => 'VNM',
            ),
            241 => 
            array (
                'id_country' => 242,
                'full_name' => 'Virgin Islands',
                'two_letters' => 'VI',
                'three_letters' => 'VIR',
            ),
            242 => 
            array (
                'id_country' => 243,
                'full_name' => 'Wallis and Futuna Islands',
                'two_letters' => 'WF',
                'three_letters' => 'WLF',
            ),
            243 => 
            array (
                'id_country' => 244,
                'full_name' => 'Western Sahara',
                'two_letters' => 'EH',
                'three_letters' => 'ESH',
            ),
            244 => 
            array (
                'id_country' => 245,
                'full_name' => 'Yemen',
                'two_letters' => 'YE',
                'three_letters' => 'YEM',
            ),
            245 => 
            array (
                'id_country' => 246,
                'full_name' => 'Zambia',
                'two_letters' => 'ZM',
                'three_letters' => 'ZMB',
            ),
            246 => 
            array (
                'id_country' => 247,
                'full_name' => 'Zimbabwe',
                'two_letters' => 'ZW',
                'three_letters' => 'ZWE',
            ),
        ));
        
        
    }
}