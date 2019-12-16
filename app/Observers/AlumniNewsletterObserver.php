<?php

namespace App\Observers;

use App\Models\AlumniNewsletter;

class AlumniNewsletterObserver
{

    public function creating(AlumniNewsletter $alumniNewsletter)
    {
        $alumniNewsletter->createdBy()->associate(auth()->user());
    }

    public function updating(AlumniNewsletter $alumniNewsletter)
    {
        $alumniNewsletter->updatedBy()->associate(auth()->user());
    }

    public function deleting(AlumniNewsletter $alumniNewsletter)
    {
        $alumniNewsletter->deletedBy()->associate(auth()->user());
    }

    public function restoring(AlumniNewsletter $alumniNewsletter)
    {
        $alumniNewsletter->deletedBy()->dissociate();
    }
}
