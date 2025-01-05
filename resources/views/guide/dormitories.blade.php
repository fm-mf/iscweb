@extends('guide.layouts.subpage')

@section('subtitle', 'Dormitories')

@section('subpage')
    <h2>Dormitories</h2>
    <p>There are CTU dormitories (in Czech ”Kolej”) all around Prague. They are shown on the map below.</p>
    <p>Usually Erasmus+ students live in one of the two biggest, Masarykova kolej and Strahov. They are marked in red rectangles on the map.</p>
    <p>
        Rooms in the dormitories are usually inexpensive, conveniently located and all have high-speed internet access.
        The price ranges can be found at website of SÚZ:
        <a href="https://www.suz.cvut.cz/cz/media/file/students-estimated-financial-cost-2024-2025" target="_blank">
            <i class="fas fa-file-pdf"></i> Student's estimated financial cost
        </a>.
    </p>
    <p>You will share a room (single rooms are usually not available, and cannot be arranged by the international office).
        The allocation of rooms in dormitories is not the responsibility of the international office,
        but of an organization called SUZ (Service Facilities Administration).</p>
    <p>The dorms usually provide a wide range of activities as they have their own gyms, pubs,
        clubs and hanging out rooms. This is especially true for Strahov, where the dorms form
        a student community of their own. For details, visit the dormitories student club website.</p>
    <p>If you do not like the accommodation provided there is always the alternative of renting on the open market.
        Private accommodation is currently usually available at lower prices than in west European capital cities.
        However, once you occupy a place at a dormitory, note that your dormitory accommodation agreement
        includes a considerable penalty if you decide to move out without giving the required notice. </p>
    <img src="{{ asset('img/guide/map-ctu-dormitories.png') }}" class="d-block mb-3" alt="Map of CTU dormitories" title="Maf of CTU dormitories" />
    <p>
        <a href="https://www.suz.cvut.cz/en/media/file/accommodation-scenario-2024-2025" target="_blank">
            <i class="fas fa-file-pdf"></i> How the application for a place in a dorm works, important dates.
        </a>
    </p>
    <p>
        <a href="https://www.suz.cvut.cz/cz/media/file/accommodation-schedule-appendix-no2-accommodation-scenario-2024-2025">
            <i class="fas fa-file-pdf"></i> Schedule of Accommodation at CTU Dorms, important dates.
        </a>
    </p>

    <h3>Insurance agreement for your property</h3>
    <p>The insurance agreement covers only the most basic items.
        <strong>Any major items, e.g., laptops, must be SPECIFIED in writing in the agreement,
            otherwise they are not covered.</strong>
        This agreement is part of the paperwork given to you when you arrive for the first time to your dorm.
        If windows have been left open or doors have been left unlocked, or if the occupier of the property is negligent,
        the insurance company will not pay out. The university does not accept liability for loss of students’ property.</p>

    <h3>Dorm Regulations</h3>
    <p>You must follow the dorm regulations, otherwise you risk serious disciplinary measures that can lead to exclusion from the dormitory!!!</p>
    <ul>
        <li>Observe silence between 22:00 and 6:00</li>
        <li>Do not use the FIRE EXTINGUISHER, except in an emergency</li>
        <li>Do not smoke in the dorm</li>
        <li>If you have a party, do not leave any mess in the communal areas, and <strong>observe the rules on silence!!!</strong></li>
        <li>If you have personal overnight visits, they must be registered in the Visitors Book,
            which is normally at the reception desk. Overnight visitors have to pay a small fee.</li>
    </ul>
    <p>The International Office will not appeal against the decision to exclude students from the dormitory
        for major or persistent infringements against the dorm regulations. It takes the view that dormitory
        residents should be protected from students who behave without due respect for other residents.</p>

    <h3>Internet</h3>
    <ul>
        <li>The Internet access in the dormitories is in the hands of the Dormitories Student Clubs</li>
        <li>To get it you need to join this club and the membership fee serves as the payment.</li>
        <li>To connect you might need a data cable.In general, however,
            the internet access at the dorms should be the fastest in Prague.</li>
        <li>Wifi access is widely available, e.g. in the foyer of Masarykova dorm.</li>
    </ul>

    <h3>More information about the student clubs:</h3>
    <dl>
        <dt>Masarykova dorm</dt>
            <dd><a href="https://mk.cvut.cz/" target="_blank">Masařka</a></dd>
            <dd>Here you can arrange for Internet access during the pre-orientation week registration at ESN Point</dd>
        <dt>Strahov</dt>
            <dd><a href="https://www.siliconhill.cz/" target="_blank">Silicon Hill</a></dd>
            <dd>In Strahov you need to contact the administrator for your block.</dd>
        <dt>Sinkuleho &amp; Dejvická dorm</dt>
            <dd><a href="https://sincoolka.cz/en/" target="_blank">Sincoolka</a></dd>
        <dt>Bubeneč dormitory</dt>
            <dd><a href="https://linktr.ee/bubenklub" target="_blank">Klub Buben</a></dd>
    </dl>

@stop
