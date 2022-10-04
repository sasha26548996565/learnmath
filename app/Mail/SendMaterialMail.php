<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Material;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMaterialMail extends Mailable
{
    use Queueable, SerializesModels;

    private readonly Material $material;

    public function __construct(Material $material)
    {
        $this->material = $material;
    }

    public function build()
    {
        return $this->markdown('mail.material', ['material' => $this->material]);
    }
}
