<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Material;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendMaterialByCategoryMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMailMaterialByCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private readonly Material $material;
    private readonly string $email;

    public function __construct(Material $material, string $email)
    {
        $this->material = $material;
        $this->email = $email;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new SendMaterialByCategoryMail($this->material));
    }
}
