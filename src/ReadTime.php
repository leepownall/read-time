<?php

namespace Pownall\ReadTime;

use const STR_PAD_LEFT;

use Carbon\CarbonInterval;
use Pownall\ReadTime\Exceptions\CannotParseException;
use Pownall\ReadTime\Parsers\StringParser;

class ReadTime
{
    private int $minutes = 0;

    private int $hours = 0;

    public function __construct(private readonly int $wordCount = 0)
    {
        $minutesToRead = round($this->wordCount / config('readtime.words_per_minute', 200));

        $this->assignReadTime($minutesToRead);
    }

    public static function make(int $wordCount = 0): self
    {
        return new self($wordCount);
    }

    public function from(array|string $content): self
    {
        if (is_string($content)) {
            return new self((new StringParser())->from($content));
        }

        throw new CannotParseException();
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

    public function __toString(): string
    {
        return CarbonInterval::create(
            years: null,
            hours: $this->hours,
            minutes: $this->minutes
        )->forHumans();
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
