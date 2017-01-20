<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ URL::asset('css/guide.css') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    <title>Survival Guide</title>
    <script>var __adobewebfontsappname__ = "reflow"</script>
    <script src="https://use.edgefonts.net/gudea:n4,i4,n7:all.js"></script>
    <script src="https://use.typekit.net/oub8umj.js"></script>
    <script>try {
            Typekit.load();
        } catch (e) {
        }</script>

    <style type="text/css" style="display: none">
        .img-circle {
            width: 30%;
            max-width: 120px;
            border: 1px solid #F4F4F4;
        }
    </style>


</head>
<body>
<div class="header-wrapper">
    <div class="container">
        <div class="header row">
            <div class="logo col-sm-3"><img src="{{ asset('img/guide/logo.png') }}"></div>
            <!--<div class="hp-search col-sm-3 col-sm-offset-6"><input type="text" name="search" class="text-input" placeholder="Search the guide..."></div> -->

            <!-- div class="hp-search col-sm-3 col-sm-offset-6">
                <form id="searchbox_002225157009474439302:mrfa_ntbk3u" class="f-search" action="results.php">
                    <input value="002225157009474439302:mrfa_ntbk3u" name="cx" type="hidden"/>
                    <input value="FORID:11" name="cof" type="hidden"/>
                    <input id="q" name="q" size="70" type="text" placeholder="Search the guide..." />
                    <button type="submit" name="sa" class="submit"><span class="glyphicon glyphicon-search"></span></button>
                    <!--<input value="Search" name="sa" type="submit"/>-->
                <!-- /form -->
            </div>

        </div>
        <div class="title">
            <h1>SURVIVAL <strong>GUIDE</strong><br>
                <small>WILL GUIDE YOU THROUGH YOUR STAY AT CTU</small>
            </h1>
        </div>
        <div class="navigation">
            <ul class="list-unstyled row">
                <li class="col-sm-4"><a href="{{ url ('guide/basic-information') }}" id="link-aya">AFTER YOUR ARRIVAL</a></li>
                <li class="col-sm-4"><a href="{{ url('guide/about-CTU') }}" id="link-sac">STUDYING AT CTU</a></li>
                <li class="col-sm-4"><a href="{{ url('guide/leisure-time') }}" id="link-lip">LIVING IN PRAGUE</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row forewords">
        <div class="col-sm-12">
            <img src="{{ asset( $presidentPicture ) }}" class="img-circle" alt="">
            <p id="text4">
                Dear international students,<br />welcome to the Czech Republic and to the Czech Technical University&#x21;<br /><br />Whether you are an Erasmus student, an Exchange student, an Erasmus Mundus student or a self-paying &#x28;private&#x29; student, we hope you will have a great time&#x21;<br /><br />Maybe you are not aware of it yet, but you are the luckiest people in the world. Your study stay is just starting, and you can explore a brand new world&#x21; Try to get the best from your stay here&#x21; Let me introduce the International Student Club. ISC is a bunch of volunteers who do not hesitate to help other students. We do this in our leisure time – we want to meet international people, make friends, we want to learn foreign languages, we want to grow personally and much more. We strive to be the best in our field.<br /><br />There are over {{ $studentsCount }} incoming international students this semester! Please, keep in mind that the buddy program is a voluntary service. If you need help or advice, ask your Czech Buddy or come to the ISC centre, and we will try to help&#x21; I can assure you that ISC is doing everything to improve the care for international students. We organize events, parties, trips and much more. So start looking forward to your new adventure!<br /><br />Together we conquer the world&#x21;</p>
            <p>{{ $president }}<br>
                President of the International Student Club CTU in Prague
            </p>
        </div>
        <!--
            <div class="col-sm-6">
                <img src="images/vlcek.png" alt="Prof. Miroslav Vlček">
                <p>
                I would like to welcome you to CTU, the Czech Technical University in Prague. We like to have a large community of students from outside the Czech Republic, studying in Czech or English language, either for a degree from CTU or as exchange students who will return to graduate from their home university. I hope you will spend good months or years in Prague, and that you will come to consider this city your second home. Prague is a wonderful place, not only for students but for the whole university community. For over 650 years, the city has been a great cultural<br />centre, and has provided a warm welcome for artists and scientists. There are many universities and research institutions in Prague, and they form one of the strongest education and research clusters in Europe.<br /><br />The cultural life in the city is very rich, whether you prefer classical music and art or rock music, sport and other leisure activities. Most classrooms and dormitories are located near the city centre. The influence of Prague will be on you at all times. International students are an integrated part of the university community. As far as possible, we want to treat all students on an equal basis. Of course, students have not only shared privileges but also shared duties. I am pleased that the university’s International Student Club &#x28;ISC&#x29; collaborates so well with the university’s International Point and others to provide a warm welcome for international students.<br /><br />ISC is widely recognised inside the university and internationally as a first-class atudent organisation. The university management appreciates ISC and undertakes to continue providing fi nancial support for it.<br /><br />The Buddy Programme, in which a Czech student contacts foreign students before their arrival and helps them to settle into their new surroundings, is just a part of ISC’s good work, aimed at enriching your study stay.<br /><br />Please have in mind that all ISC buddies, and everyone in ISC, are volunteers who try to help you in their free time. I hope you will remember to express your gratitude to these volunteers who kindly off er you their help.<br /><br />It is a privilege to have the opportunity to study abroad, and I am glad that you have this privilege. I hope you will use it well, and will have a rich and happy study  experience at CTU in Prague.<br />Prof.
                <p>Miroslav Vlcek <br>
                Vice-Rector for External Relations</p>
            </div>
        -->
    </div>
</div>
<div class="footer-wrapper">
    <div class="container">
        <p>&copy; {{ \Carbon\Carbon::today()->year }} | International Student Club CTU in Prague, z.s.</p>
    </div>
</div>

</body>
</html>