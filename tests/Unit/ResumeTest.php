<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\DataObjects\Award;
use App\DataObjects\Basics;
use App\DataObjects\Certificate;
use App\DataObjects\Education;
use App\DataObjects\Interest;
use App\DataObjects\Language;
use App\DataObjects\Project;
use App\DataObjects\Publication;
use App\DataObjects\Reference;
use App\DataObjects\Resume;
use App\DataObjects\Skill;
use App\DataObjects\VolunteerExperience;
use App\DataObjects\WorkExperience;
use App\Enums\SkillLevel;
use Carbon\Exceptions\InvalidFormatException;
use PHPUnit\Framework\TestCase;

class ResumeTest extends TestCase
{
    public function test_constructor_creates_resume_with_default_values(): void
    {
        // Act
        $resume = new Resume();

        // Assert
        $this->assertEmpty($resume->work);
        $this->assertEmpty($resume->volunteer);
        $this->assertEmpty($resume->education);
        $this->assertEmpty($resume->awards);
        $this->assertEmpty($resume->certificates);
        $this->assertEmpty($resume->publications);
        $this->assertEmpty($resume->skills);
        $this->assertEmpty($resume->languages);
        $this->assertEmpty($resume->interests);
        $this->assertEmpty($resume->references);
        $this->assertEmpty($resume->projects);
    }

    public function test_constructor_creates_resume_with_provided_data(): void
    {
        // Arrange
        $basics = new Basics(name: 'John Doe', email: 'john@example.com');
        $work   = [new WorkExperience(name: 'Tech Corp', position: 'Developer')];
        $skills = [new Skill(name: 'PHP', level: SkillLevel::Expert)];

        // Act
        $resume = new Resume(basics: $basics, work: $work, skills: $skills);

        // Assert
        $this->assertSame($basics, $resume->basics);
        $this->assertSame($work, $resume->work);
        $this->assertSame($skills, $resume->skills);
        $this->assertEmpty($resume->volunteer);
        $this->assertEmpty($resume->education);
        $this->assertEmpty($resume->awards);
    }

    public function test_from_array_creates_resume_with_complete_data(): void
    {
        // Arrange
        $data = [
            'basics'       => [
                'name'     => 'Jane Smith',
                'email'    => 'jane@example.com',
                'location' => [
                    'city'   => 'New York',
                    'region' => 'NY',
                ],
            ],
            'work'         => [
                [
                    'name'       => 'Tech Corp',
                    'position'   => 'Senior Developer',
                    'startDate'  => '2022-01-01',
                    'highlights' => ['Built amazing features'],
                ],
            ],
            'volunteer'    => [
                [
                    'organization' => 'Code for Good',
                    'position'     => 'Volunteer Developer',
                    'startDate'    => '2023-01-01',
                ],
            ],
            'education'    => [
                [
                    'institution' => 'MIT',
                    'area'        => 'Computer Science',
                    'studyType'   => 'Bachelor',
                ],
            ],
            'awards'       => [
                [
                    'title'   => 'Developer of the Year',
                    'date'    => '2023-12-01',
                    'awarder' => 'Tech Awards',
                ],
            ],
            'certificates' => [
                [
                    'name'   => 'AWS Certified',
                    'date'   => '2023-01-01',
                    'issuer' => 'Amazon',
                ],
            ],
            'publications' => [
                [
                    'name'        => 'Clean Code Guide',
                    'publisher'   => 'Tech Publisher',
                    'releaseDate' => '2023-01-01',
                ],
            ],
            'skills'       => [
                [
                    'name'     => 'Programming',
                    'level'    => 'expert',
                    'keywords' => ['PHP', 'JavaScript'],
                ],
            ],
            'languages'    => [
                [
                    'language' => 'English',
                    'fluency'  => 'Native',
                ],
            ],
            'interests'    => [
                [
                    'name'     => 'Technology',
                    'keywords' => ['AI', 'Machine Learning'],
                ],
            ],
            'references'   => [
                [
                    'name'      => 'John Manager',
                    'reference' => 'Excellent developer',
                ],
            ],
            'projects'     => [
                [
                    'name'        => 'Portfolio Website',
                    'description' => 'Personal website',
                    'startDate'   => '2023-01-01',
                ],
            ],
        ];

        // Act
        $resume = Resume::fromArray($data);

        // Assert
        $this->assertEquals('Jane Smith', $resume->basics->name);
        $this->assertEquals('jane@example.com', $resume->basics->email);
        $this->assertCount(1, $resume->work);
        $this->assertInstanceOf(WorkExperience::class, $resume->work[0]);
        $this->assertEquals('Tech Corp', $resume->work[0]->name);
        $this->assertCount(1, $resume->volunteer);
        $this->assertInstanceOf(VolunteerExperience::class, $resume->volunteer[0]);
        $this->assertCount(1, $resume->education);
        $this->assertInstanceOf(Education::class, $resume->education[0]);
        $this->assertCount(1, $resume->awards);
        $this->assertInstanceOf(Award::class, $resume->awards[0]);
        $this->assertCount(1, $resume->certificates);
        $this->assertInstanceOf(Certificate::class, $resume->certificates[0]);
        $this->assertCount(1, $resume->publications);
        $this->assertInstanceOf(Publication::class, $resume->publications[0]);
        $this->assertCount(1, $resume->skills);
        $this->assertInstanceOf(Skill::class, $resume->skills[0]);
        $this->assertCount(1, $resume->languages);
        $this->assertInstanceOf(Language::class, $resume->languages[0]);
        $this->assertCount(1, $resume->interests);
        $this->assertInstanceOf(Interest::class, $resume->interests[0]);
        $this->assertCount(1, $resume->references);
        $this->assertInstanceOf(Reference::class, $resume->references[0]);
        $this->assertCount(1, $resume->projects);
        $this->assertInstanceOf(Project::class, $resume->projects[0]);
    }

    public function test_from_array_handles_non_array_sections(): void
    {
        // Arrange
        $data = [
            'basics'    => [
                'name' => 'John Doe',
            ],
            'work'      => 'not an array', // Invalid data type
            'volunteer' => null,      // Invalid data type
            'skills'    => [
                [
                    'name'  => 'PHP',
                    'level' => 'expert',
                ],
            ],
        ];

        // Act
        $resume = Resume::fromArray($data);

        // Assert
        $this->assertEquals('John Doe', $resume->basics->name);
        $this->assertEmpty($resume->work);      // Should be empty due to invalid type
        $this->assertEmpty($resume->volunteer); // Should be empty due to null
        $this->assertCount(1, $resume->skills);
    }

    public function test_from_array_handles_date_parsing_correctly(): void
    {
        // Arrange
        $data = [
            'basics'    => ['name' => 'John Doe'],
            'education' => [
                [
                    'institution' => 'MIT',
                    'startDate'   => '2018-09-01',
                    'endDate'     => '2022-05-31',
                ],
            ],
            'awards'    => [
                [
                    'title' => 'Excellence Award',
                    'date'  => '2023-12-15',
                ],
            ],
        ];

        // Act
        $resume = Resume::fromArray($data);

        // Assert
        $this->assertNotNull($resume->education[0]->startDate);
        $this->assertNotNull($resume->education[0]->endDate);
        $this->assertEquals('2018-09-01', $resume->education[0]->startDate->format('Y-m-d'));
        $this->assertEquals('2022-05-31', $resume->education[0]->endDate->format('Y-m-d'));
        $this->assertNotNull($resume->awards[0]->date);
        $this->assertEquals('2023-12-15', $resume->awards[0]->date->format('Y-m-d'));
    }

    public function test_from_array_handles_invalid_date_formats_gracefully(): void
    {
        // Arrange
        $data = [
            'basics'    => ['name' => 'John Doe'],
            'work'      => [
                [
                    'name'      => 'Tech Corp',
                    'position'  => 'Developer',
                    'startDate' => 'invalid-date-format',
                    'endDate'   => '2024-01-01',
                ],
            ],
            'education' => [
                [
                    'institution' => 'MIT',
                    'startDate'   => '2018-13-45', // Invalid date
                    'endDate'     => '2022-05-31',
                ],
            ],
        ];

        // Act & Assert
        $this->expectException(InvalidFormatException::class);

        Resume::fromArray($data);
    }
}
