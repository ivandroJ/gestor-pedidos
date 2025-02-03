<?php

namespace App\Jobs\Pedidos;

use App\Mail\SimpleMessageMail;
use App\Models\Pedido;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendNotificationMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    public function __construct(
        public String $email,
        public String $name,
        public String $subject,
        public String $message,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

       Mail::to($this->email, $this->name)
            ->send(new SimpleMessageMail($this->subject, $this->message));

        sleep(6);
    }
}
