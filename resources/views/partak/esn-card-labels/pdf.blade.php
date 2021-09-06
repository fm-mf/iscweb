<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ $title }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/esn-card-labels-pdf.css')) }}" />
    </head>
    <body>
        <table>
            <tr>
                @foreach($students as $student)
                    @if(!$loop->first && $loop->index % 4 === 0)
                        </tr>
                        <tr>
                    @endif
                    <td class="student">
                        @php
                            /*
                             * Check width of the name when rendered with the correct font and size
                             * If the bounding box si too wide, add class to reduce letter-spacing
                             * The thresholds (150, 175 and 200) were estimated experimentally :D
                             */
                            $name = $student['givenNames'] . ' ' . mb_strtoupper($student['surname']);
                            $box = imagettfbbox(8.0, 0.0, $fontPath, $name);
                            $longName = ($box[2] > 200
                                ? 'tooLongName'
                                : ($box[2] > 175
                                    ? ' extraLongName'
                                    : ($box[2] > 150
                                        ? ' longName'
                                        : ''
                                    )
                                )
                            );
                        @endphp
                        <p class="row studentName{{$longName ?? ''}}">{{ $name }}</p>
                        <div class="row">
                            <p class="nationality">{{ $student['nationality'] }}</p>
                            <p class="dateOfBirth">{{ $student['dateOfBirth']->format('d m y') }}</p>
                        </div>
                        <p class="row universityName">{{ $university }}</p>
                        <div class="row">
                            <p class="sectionName">{{ $section }}</p>
                            <p class="dateValidFrom">{{ $validFrom->format('d m y') }}</p>
                        </div>
                    </td>
                    @if($loop->last && ($loop->index + 1) % 4 !== 0)
                        <td colspan="{{ 4 - (($loop->index + 1) % 4) }}"></td>
                    @endif
                @endforeach
            </tr>
        </table>
    </body>
</html>
