<?php

namespace App\Mail;

use App\Models\Buddy;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HRNewRegistration extends Mailable
{
    use Queueable, SerializesModels;

    protected $buddy;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Buddy $buddy)
    {
        $this->buddy = $buddy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.letHRknow')
                    ->with('buddy', $this->buddy)
                    ->from('it.support@isc.cvut.cz')
                    ->subject('Zaregistroval se nový buddík');
    }
}
