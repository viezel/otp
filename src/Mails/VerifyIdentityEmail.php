<?php
declare(strict_types=1);

namespace Viezel\OTP\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyIdentityEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $code;

    public function __construct(int $code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this
            ->subject('Verify your identity')
            ->markdown('otp::emails.verify', ['code' => $this->code]);
    }
}
