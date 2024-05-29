<text align="center"/>
<feed line="1"/>
{{--
    substr() is used to skip the headers and take only the raw image data
--}}
<image width="352" height="196" color="color_1" mode="mono">{{ base64_encode(substr(file_get_contents(public_path('img/logos/esn-ctu_receipt.bmp')), -1 * 352 * 196 / 8)) }}</image>
<feed line="1"/>
<text reverse="false" ul="false" em="true" color="color_2"/>
<text>{{ $officialName }}&#10;</text>
<text reverse="false" ul="false" em="false" color="color_1"/>
<text>Thákurova 550/1, 160 00, Praha 6 – Dejvice&#10;</text>
<text>IČO: 228 41 032&#10;</text>
<feed line="2"/>
<text align="left"/>
<text>{{ $receipt->subject }}:&#10;</text>
<text align="right"/>
<text>{{ $receipt->amount }} CZK&#10;</text>
<text align="center"/>
<feed line="1"/>
@if($esn_card)
    <text align="left"/>
    <text>{{ str_repeat('-', 48) }}&#10;</text>
    <text>As a member of ESN you can:&#10;</text>
    <text> * join us for trips organised by ESN&#10;</text>
    <text> * attend events exclusive for ESN members&#10;</text>
    <text>and you also get:&#10;</text>
    <text> * ESN T-shirt "I was there"&#10;</text>
    <text> * SIM card with 15 GB data bundle and 100 CZK&#10;   prepaid credit&#10;</text>
    <text> * discount on print & copy in the ESN Point&#10;</text>
    <text>{{ str_repeat('-', 48) }}&#10;</text>
    <text align="center"/>
    <feed line="1"/>
@endif
<barcode type="code128" hri="below" font="font_a" width="2" height="32">{A{{ $receipt->hash_id }}</barcode>
<feed/>
<text>Printed by {{ $receipt->createdBy->person->getFullName() }}&#10;</text>
<text>{{ $receipt->created_at }}&#10;</text>
<text>Have a nice day, we &#9829; you&#10;</text>
<feed line="1"/>
<cut type="feed"/>
