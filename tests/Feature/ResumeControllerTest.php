<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumeControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        // Setup fake storage for all tests
        Storage::fake('resumes');
    }

    public function test_resume_page_loads_successfully(): void
    {
        // Arrange
        $resumeData = $this->createSampleResumeData();
        Storage::disk('resumes')->put('resume.json', json_encode($resumeData));

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertSee('Software Developer');
        $response->assertSee('john@example.com');
        $response->assertSee('A passionate developer');
        $response->assertSee('New York, NY');
    }

    public function test_resume_page_handles_missing_optional_fields(): void
    {
        // Arrange
        $resumeData = [
            'basics' => [
                'name'     => 'Jane Smith',
                'label'    => 'Designer',
                'location' => [],
            ],
        ];
        Storage::disk('resumes')->put('resume.json', json_encode($resumeData));

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200);
        $response->assertSee('Jane Smith');
        $response->assertSee('Designer');
    }

    public function test_resume_download_returns_pdf_response(): void
    {
        // Arrange
        $resumeData = $this->createSampleResumeData();
        Storage::disk('resumes')->put('resume.json', json_encode($resumeData));

        // Act
        $response = $this->post('/download');

        // Assert
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
        $response->assertHeader('Content-Disposition', 'attachment; filename="John Doe Resume.pdf"');
    }

    public function test_resume_service_caching_works_correctly(): void
    {
        // Arrange
        $resumeData = $this->createSampleResumeData();
        Storage::disk('resumes')->put('resume.json', json_encode($resumeData));

        // Act - Make multiple requests
        $response1 = $this->get('/');

        // Change the resume data to see if cache is hit
        $resumeData['basics']['name'] = 'John Doe Updated';
        Storage::disk('resumes')->put('resume.json', json_encode($resumeData));

        $response2 = $this->get('/');

        // Assert - Both should succeed and return same content (since cache was not cleared)
        $response1->assertStatus(200);
        $response2->assertStatus(200);
        $response1->assertSee('John Doe');
        $response2->assertSee('John Doe');

        // Clear the cache
        Cache::forget('resume_data');

        // Act - Request again after clearing cache
        $response3 = $this->get('/');

        // Assert - Should now see the updated name
        $response3->assertStatus(200);
        $response3->assertSee('John Doe Updated');
    }

    /**
     * Create sample resume data for testing
     */
    private function createSampleResumeData(): array
    {
        return [
            'basics'       => [
                'name'     => 'John Doe',
                'label'    => 'Software Developer',
                'email'    => 'john@example.com',
                'phone'    => '+1 (555) 123-4567',
                'url'      => 'https://example.com/john-doe',
                'summary'  => 'A passionate developer with extensive experience in web technologies',
                'location' => [
                    'city'        => 'New York',
                    'region'      => 'NY',
                    'countryCode' => 'US',
                ],
                'profiles' => [
                    [
                        'network'  => 'GitHub',
                        'username' => 'johndoe',
                        'url'      => 'https://example.com/@johndoe',
                    ],
                ],
            ],
            'work'         => [
                [
                    'name'       => 'Tech Corp',
                    'position'   => 'Senior Developer',
                    'startDate'  => '2022-01-01',
                    'endDate'    => '2024-01-01',
                    'summary'    => 'Led development of key features',
                    'highlights' => [
                        'Increased performance by 40%',
                        'Mentored 5 junior developers',
                    ],
                ],
            ],
            'skills'       => [
                [
                    'name'     => 'Programming Languages',
                    'level'    => 'expert',
                    'keywords' => ['PHP', 'JavaScript', 'Python'],
                ],
            ],
            'education'    => [
                [
                    'institution' => 'University of Technology',
                    'area'        => 'Computer Science',
                    'studyType'   => 'Bachelor',
                    'startDate'   => '2018-09-01',
                    'endDate'     => '2022-06-01',
                ],
            ],
            'projects'     => [
                [
                    'name'        => 'Portfolio Website',
                    'description' => 'Personal portfolio built with Laravel',
                    'url'         => 'https://example.com/john-doe',
                    'keywords'    => ['Laravel', 'PHP', 'Tailwind'],
                ],
            ],
            'awards'       => [],
            'certificates' => [],
            'publications' => [],
            'languages'    => [],
            'interests'    => [],
            'references'   => [],
            'volunteer'    => [],
        ];
    }
}
