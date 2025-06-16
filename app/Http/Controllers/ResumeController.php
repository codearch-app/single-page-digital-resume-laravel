<?php

namespace App\Http\Controllers;

use App\Services\ResumeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

readonly class ResumeController
{
    public function __construct(private ResumeService $resumeService)
    {
    }

    public function index(Factory $view): View
    {
        return $view->make('resume', ['resume' => $this->resumeService->getResume(), 'allowDownload' => true]);
    }

    public function download(): Response
    {
        $resume = $this->resumeService->getResume();

        $pdf = Pdf::loadView('resume', ['resume' => $resume, 'allowDownload' => false]);

        return $pdf->download($resume->basics->name . ' Resume.pdf');
    }
}
