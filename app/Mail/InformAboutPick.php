<?php

namespace App\Mail;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InformAboutPick extends Mailable
{
    use Queueable, SerializesModels;

    protected $buddy;
    protected $exchangeStudent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Buddy $buddy, ExchangeStudent $exchangeStudent)
    {
        $this->buddy = $buddy;
        $this->exchangeStudent = $exchangeStudent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $buddyName = $this->buddy->person->first_name . ' ' . $this->buddy->person->last_name;
        $buddyEmail = $this->buddy->person->user->email;
        $exStudName = $this->exchangeStudent->person->first_name;
        $exStudEmail = $this->exchangeStudent->person->user->email;
        $exStudFullName = $this->exchangeStudent->person->first_name . ' ' . $this->exchangeStudent->person->last_name;
        $s = 'his/her';
        if (isset($this->buddy->person->sex) && $this->buddy->person->sex) {
            if ($this->buddy->person->sex == 'M') {
                $s = 'his';
            } else if ($this->buddy->person->sex == 'F') {
                $s = 'her';
            }
        }
        return $this->view('emails.informaboutpick')
                ->text('emails.informaboutpick_plain')
                ->with('exStudName', $exStudName)
                ->with('buddyName', $buddyName)
                ->with('buddyEmail', $buddyEmail)
                ->with('s', $s)
                ->to($exStudEmail, $exStudFullName)
                ->from('noreply@esn.cvut.cz', 'ESN CTU in Prague')
                ->replyTo($buddyEmail, $buddyName)
                ->subject('You have a buddy!');
    }
}
