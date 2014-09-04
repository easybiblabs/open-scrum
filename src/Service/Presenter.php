<?php
namespace ImagineEasy\OpenScrum\Service;

class Presenter
{
    private $issues;

    private $filtered = [];

    public function __construct(array $issues)
    {
        $this->issues = $issues;
    }

    public function filter()
    {
        foreach ($this->issues['items'] as $issue) {
            if (false === array_key_exists('labels', $issue)) {
                continue;
            }

            foreach ($issue['labels'] as $label) {
                if (false === strpos($label['name'], 'est:')) {
                    continue;
                }

                $this->filtered[$issue['number']] = (float) substr($label['name'], 4);
            }
        }

        return $this;
    }
    public function presentCSV($milestone, $state)
    {
        echo "milestone;state;number;point" . PHP_EOL;
        foreach ($this->filtered as $number => $point) {
            echo "$milestone;$state;$number;$point" . PHP_EOL;
        }
    }
}