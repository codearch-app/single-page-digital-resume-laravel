<?php

declare(strict_types=1);

namespace App\DataObjects;

readonly class Resume
{
    /**
     * @param WorkExperience[]      $work
     * @param VolunteerExperience[] $volunteer
     * @param Education[]           $education
     * @param Award[]               $awards
     * @param Certificate[]         $certificates
     * @param Publication[]         $publications
     * @param Skill[]               $skills
     * @param Language[]            $languages
     * @param Interest[]            $interests
     * @param Reference[]           $references
     * @param Project[]             $projects
     */
    public function __construct(
        public Basics $basics = new Basics(),
        public array  $work = [],
        public array  $volunteer = [],
        public array  $education = [],
        public array  $awards = [],
        public array  $certificates = [],
        public array  $publications = [],
        public array  $skills = [],
        public array  $languages = [],
        public array  $interests = [],
        public array  $references = [],
        public array  $projects = []
    ) {
    }

    public static function fromArray(array $data): self
    {
        $extractData = function(array $data, string $index, string $class): array
        {
            $list = [];

            if (isset($data[$index]) && is_array($data[$index])) {
                foreach ($data[$index] as $item) {
                    if (method_exists($class, 'fromArray')) {
                        $list[] = $class::fromArray($item);
                    } else {
                        throw new \InvalidArgumentException("Class $class does not have a fromArray method.");
                    }
                }
            }

            return $list;
        };

        return new self(
            basics:       Basics::fromArray($data['basics'] ?? []),
            work:         $extractData($data, 'work', WorkExperience::class),
            volunteer:    $extractData($data, 'volunteer', VolunteerExperience::class),
            education:    $extractData($data, 'education', Education::class),
            awards:       $extractData($data, 'awards', Award::class),
            certificates: $extractData($data, 'certificates', Certificate::class),
            publications: $extractData($data, 'publications', Publication::class),
            skills:       $extractData($data, 'skills', Skill::class),
            languages:    $extractData($data, 'languages', Language::class),
            interests:    $extractData($data, 'interests', Interest::class),
            references:   $extractData($data, 'references', Reference::class),
            projects:     $extractData($data, 'projects', Project::class),
        );
    }
}
