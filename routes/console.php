<?php

use App\Http\Controllers\SalesController;
use App\Mail\ReportMail;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();


Artisan::command('send:email', function () {
    $totalValue = SalesController::getAllSalesInTheDay();
    Mail::to(users: 'teste@gmail.com', name: 'Teste')->Send(mailable: new ReportMail(data: [
        "totalValue" => number_format($totalValue, 2, ',', '.'),
        "day" => now()->format('d/m/Y')
    ]));
})->purpose('Send email')->weeklyOn([1, 2, 3, 4, 5, 6])->at('21:00');
