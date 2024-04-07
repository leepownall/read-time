<?php

namespace Pownall\ReadTime;

use const STR_PAD_LEFT;

use Carbon\CarbonInterval;
use Pownall\ReadTime\Exceptions\CannotCountException;
use Pownall\ReadTime\Parsers\ArrayParser;
use Pownall\ReadTime\Parsers\StringParser;

class ReadTime
{
    private int $wordCount;

    private int $minutes = 0;

    private int $hours = 0;

    private int $wordsPerMinute;

    public function __construct(string|array $content, ?int $wordsPerMinute = null)
    {
        $this->wordsPerMinute = $wordsPerMinute !== null
            ? $wordsPerMinute
            : config('readtime.words_per_minute', 200);

        $this->wordCount = $this->calculateWordCount($content);

        $minutesToRead = round($this->wordCount / $this->wordsPerMinute);

        $this->assignReadTime($minutesToRead);
    }

    public function wordCount(): int
    {
        return $this->wordCount;
    }

    public function hours(): int
    {
        return $this->hours;
    }

    public function minutes(): int
    {
        return $this->minutes;
    }

    public function wordsPerMinute(): int
    {
        return $this->wordsPerMinute;
    }

    public function get(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return CarbonInterval::create(
            years: null,
            hours: $this->hours,
            minutes: $this->minutes
        )->forHumans();
    }

    private function calculateWordCount(array|string $content): int
    {
        if (is_string($content)) {
            return (new StringParser())->from($content);
        }

        if (is_array($content)) {
            return (new ArrayParser())->from($content);
        }

        throw new CannotCountException();
    }

    private function assignReadTime(int $minutesToRead): void
    {
        $minutes = (int) str_pad(
            string: max(1, $minutesToRead),
            length: 2,
            pad_string: 0,
            pad_type: STR_PAD_LEFT,
        );

        if ($minutes < 60) {
            $this->minutes = $minutes;

            return;
        }

        $this->hours = $this->hours + 1;

        $minutes = $minutes - 60;

        if ($minutes <= 0) {
            return;
        }

        $this->assignReadTime($minutes);
    }
}
