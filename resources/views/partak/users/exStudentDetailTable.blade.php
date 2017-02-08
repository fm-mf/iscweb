<div class="row-grey">
    <div class="container">
        <div class="row row-inner">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <table class="table">
                        <tr>
                            <th>Country</th>
                            <td>{{ $exStudent->country->full_name }}</td>
                        </tr>
                        <tr>
                            <th>Faculty</th>
                            <td>{{ $exStudent->faculty->faculty }}</td>
                        </tr>
                        <tr>
                            <th>School</th>
                            <td>{{ $exStudent->school }}</td>
                        </tr>
                        <tr>
                            <th>Accommodation</th>
                            <td>{{ $exStudent->accommodation->full_name_eng }}</td>
                        </tr>
                        @if(! isset($exStudent->buddy))
                            <tr>
                                <th>Want Buddy</th>
                                <td>{{ ($exStudent->want_buddy === 'y')? "Yes" : "No" }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>ESN registered</th>
                            <td>{{ ($exStudent->esn_registered === 'y')? "Yes" : "No" }}</td>
                        </tr>
                        @if(isset($exStudent->esn_card_number))
                            <tr>
                                <th>ESN card number</th>
                                <td>{{ $exStudent->esn_card_number }}</td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>