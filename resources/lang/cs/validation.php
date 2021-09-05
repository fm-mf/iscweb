<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => ':attribute musí být přijat.',
    'active_url' => ':attribute není platnou URL adresou.',
    'after'  => ':attribute musí být datum po :date.',
    'after_or_equal' => ':attribute musí být datum nejdříve :date.',
    'alpha' => ':attribute může obsahovat pouze písmena.',
    'alpha_dash' => ':attribute může obsahovat pouze písmena, číslice, pomlčky a podtržítka. České znaky (á, é, í, ó, ú, ů, ž, š, č, ř, ď, ť, ň) nejsou podporovány.',
    'alpha_num' => ':attribute může obsahovat pouze písmena a číslice.',
    'array' => ':attribute musí být pole.',
    'before' => ':attribute musí být datum před :date.',
    'before_or_equal' => ':attribute musí být datum nejpozději :date.',
    'between' => [
        'numeric' => ':attribute musí být hodnota mezi :min a :max.',
        'file' => ':attribute musí být větší než :min a menší než :max Kilobytů.',
        'string' => ':attribute musí být delší než :min a kratší než :max znaků.',
        'array' => ':attribute musí obsahovat nejméně :min a nesmí obsahovat více než :max prvků.',
    ],
    'boolean' => ':attribute musí být true nebo false.',
    'confirmed' => ':attribute nebylo potvrzeno.',
    'date' => ':attribute musí být platné datum.',
    'date_equals' => ':attribute musí být datum shodné s :date.',
    'date_format' => ':attribute není platný formát data podle :format.',
    'different' => ':attribute a :other se musí lišit.',
    'digits' => ':attribute musí být :digits pozic dlouhé.',
    'digits_between' => ':attribute musí být dlouhé nejméně :min a nejvíce :max pozic.',
    'dimensions' => ':attribute má neplatné rozměry.',
    'distinct' => ':attribute má duplicitní hodnotu.',
    'email' => ':attribute nemá platný formát.',
    'ends_with' => ':attribute musí končit některým z následujících řetězců: :values.',
    'exists' => 'Zvolená hodnota pro :attribute není platná.',
    'file' => ':attribute musí být soubor.',
    'filled' => ':attribute musí být vyplněno.',
    'gt' => [
        'numeric' => ':attribute musí být větší než :value.',
        'file' => ':attribute musí být větší než :value kilobajtů.',
        'string' => ':attribute musí být delší než :value znaků.',
        'array' => ':attribute musí obsahovat více než :value položek.',
    ],
    'gte' => [
        'numeric' => ':attribute musí být nejméně :value.',
        'file' => ':attribute musí být veliký nejméně :value kilobajtů.',
        'string' => ':attribute musí být dlouhý nejméně :value znaků.',
        'array' => ':attribute musí obsahovat nejméně :value položek.',
    ],
    'image' => ':attribute musí být obrázek.',
    'in' => 'Zvolená hodnota pro :attribute je neplatná.',
    'in_array' => ':attribute není obsažen v :other.',
    'integer' => ':attribute musí být celé číslo.',
    'ip' => ':attribute musí být platnou IP adresou.',
    'ipv4' => ':attribute musí být platnou IPv4 adresou.',
    'ipv6' => ':attribute musí být platnou IPv6 adresou.',
    'json' => ':attribute musí být platný JSON řetězec.',
    'lt' => [
        'numeric' => ':attribute musí být menší než :value.',
        'file' => ':attribute musí být menší než :value kilobajtů.',
        'string' => ':attribute musí být kratší než :value znaků.',
        'array' => ':attribute musí obsahovat méně než :value položek.',
    ],
    'lte' => [
        'numeric' => ':attribute musí být nejvýše :value.',
        'file' => ':attribute musí být veliký nejvýše :value kilobajtů.',
        'string' => ':attribute musí být dlouhý nejvýše :value znaků.',
        'array' => ':attribute mus obsahovat nejvýše :value položek.',
    ],
    'max' => [
        'numeric' => ':attribute musí být nižší než :max.',
        'file' => ':attribute musí být menší než :max Kilobytů.',
        'string' => ':attribute musí být kratší než :max znaků.',
        'array' => ':attribute nesmí obsahovat více než :max prvků.',
    ],
    'mimes' => ':attribute musí být jeden z následujících datových typů :values.',
    'mimetypes' => ':attribute musí být jeden z následujících datových typů :values.',
    'min' => [
        'numeric' => ':attribute musí být větší než :min.',
        'file' => ':attribute musí být větší než :min Kilobytů.',
        'string' => ':attribute musí obsahovat alespoň :min znaků.',
        'array' => ':attribute musí obsahovat alespoň :min prvků.',
    ],
    'not_in' => 'Zvolená hodnota pro :attribute je neplatná.',
    'not_regex' => ':attribute má neplatný formát.',
    'numeric' => ':attribute musí být číslo.',
    // 'password' => 'Heslo je nesprávné.',
    'present' => ':attribute musí být vyplněno.',
    'regex' => ':attribute nemá správný formát.',
    'required' => ':attribute musí být vyplněno.',
    'required_if' => ':attribute musí být vyplněno pokud :other je :value.',
    'required_unless' => ':attribute musí být vyplněno dokud :other je v :values.',
    'required_with' => ':attribute musí být vyplněno pokud :values je vyplněno.',
    'required_with_all' => ':attribute musí být vyplněno pokud :values je zvoleno.',
    'required_without' => ':attribute musí být vyplněno pokud :values není vyplněno.',
    'required_without_all' => ':attribute musí být vyplněno pokud není žádné z :values zvoleno.',
    'same' => ':attribute a :other se musí shodovat.',
    'size' => [
        'numeric' => ':attribute musí být přesně :size.',
        'file' => ':attribute musí mít přesně :size Kilobytů.',
        'string' => ':attribute musí být přesně :size znaků dlouhý.',
        'array' => ':attribute musí obsahovat právě :size prvků.',
    ],
    'starts_with' => ':attribute musí začínat jedním z následujících řetězců: :values.',
    'string' => ':attribute musí být řetězec znaků.',
    'timezone' => ':attribute musí být platná časová zóna.',
    'unique' => ':attribute musí být unikátní.',
    'uploaded' => 'Nahrávání :attribute se nezdařilo.',
    'url' => 'Formát :attribute je neplatný.',
    'uuid' => ':attribute musí být platné UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'id_faculty' => [
            'exists' => 'Vybrána neexistující fakulta',
        ],
        'password' => [
            'confirmed' => 'Hesla se neshodují',
        ],
        'languagesToLearn' => [
            'required' => 'Musíš vybrat alespoň jeden jazyk, který se chceš naučit',
            'min' => 'Musíš vybrat alespoň jeden jazyk, který se chceš naučit',
        ],
        'languagesToTeach' => [
            'required' => 'Musíš vybrat alespoň jeden jazyk, který chceš někoho naučit',
            'min' => 'Musíš vybrat alespoň jeden jazyk, který chceš někoho naučit',
        ],
        'avatar_file' => [
            'uploaded' => 'Zvolený soubor je příliš veliký. Zvol, prosím, nějaký menší (maximální povolená velikost je 2 MiB)',
            'max' => 'Zvolený soubor je příliš veliký. Zvol, prosím, nějaký menší (maximální povolená velikost je 2 MiB)',
        ],
        'agreement' => [
            'accepted' => ':attribute musí být udělen.',
        ],
        'registration_type' => [
            'required' => 'Nebyla vybrána žádná možnost.',
            'in' => 'Zvolená možnost není platná.',
        ],
    ],

    'phone' => 'Zadané telefonní číslo není platné',
    'password' => 'Zadané současné heslo je chybné',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'first_name' => 'Jméno',
        'last_name' => 'Příjmení',
        'email' => 'E-mail',
        'password' => 'Heslo',
        'code_of_conduct' => 'Buddy kodex',
        'age' => 'Rok narození',
        'agreement' => 'Souhlas se zpracováním osobních údajů',
        'old_password' => 'Staré heslo',
        'new_password' => 'Nové heslo',
        'buddyDbFromDate' => 'Datum otevření Buddy databáze',
        'buddyDbFromTime' => 'Čas otevření Buddy databáze',

        'hours_json' => [
            'text' => 'Popis k otevíracím hodinám',
            'textCs' => 'Popis k otevíracím hodinám (v češtině)',
            'hours' => [
                'Monday' => 'Pondělní otevírací hodiny',
                'Tuesday' => 'Úterní otevírací hodiny',
                'Wednesday' => 'Středeční otevírací hodiny',
                'Thursday' => 'Čtvrteční otevírací hodiny',
                'Friday' => 'Páteční otevírací hodiny',
                'Saturday' => 'Sobotní otevírací hodiny',
                'Sunday' => 'Nedělní otevírací hodiny',
            ],
        ],
    ],

];
