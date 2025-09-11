<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovedMail;

class EmailService
{
    /**
     * Kirim email welcome
     */
    public function sendWelcome(string $to, string $nama): void
    {
        // Mail::to($to)->send(new ApprovedMail($nama));
    }

    /**
     * Kirim email custom (pakai view tertentu)
     */
    public function sendCustom(string $to, string $subject, string $view, array $data = []): void
    {
        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    public function sendApproval(array $items, string $to, string $approveUrl, string $rejectUrl, array $pengaju): void
    {
        Mail::to($to)->send(new ApprovedMail($items, $approveUrl, $rejectUrl, $pengaju));
    }
}
