<?php

namespace App\Observers;

use App\Models\Accommodation;
use App\Models\DegreeStudent;

class DegreeStudentObserver
{
    public function creating(DegreeStudent $student)
    {
        $student->degree_student = true;
        $student->privacy_policy = true;
        $student->id_accommodation = Accommodation::DEFAULT_ID;
    }
}
