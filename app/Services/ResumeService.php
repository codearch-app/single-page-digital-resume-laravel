<?php

declare(strict_types=1);

namespace App\Services;

use App\DataObjects\Resume;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ResumeService
{
    public function getResume(): Resume
    {
        return Cache::remember(
            'resume_data',
            now()->addDay(),
            function() {
                $resume     = Storage::disk('resumes')->get('resume.json');
                $resumeData = json_decode($resume, true);

                return Resume::fromArray($resumeData);
            }
        );
    }
}
