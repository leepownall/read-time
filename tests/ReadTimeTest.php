<?php

use Pownall\ReadTime\ReadTime;

it('can get read time', function (int $wordCount, int $minutes, int $hours) {
    $readTime = new ReadTime($wordCount);

    expect($readTime->wordCount())->toBe($wordCount);
    expect($readTime->minutes())->toBe($minutes);
    expect($readTime->hours())->toBe($hours);
})
    ->with([
        [500, 3, 0],
        [3000, 15, 0],
        [18000, 30, 1],
        [24000, 0, 2],
        [24800, 4, 2],
    ]);

it('can get read time as human readable', function (int $wordCount, string $expected) {
    $readTime = new ReadTime($wordCount);

    expect((string) $readTime)->toBe($expected);
})
    ->with([
        [500, '3 minutes'],
        [3000, '15 minutes'],
        [18000, '1 hour 30 minutes'],
        [24000, '2 hours'],
        [24800, '2 hours 4 minutes'],
    ]);

it('can get read time via static make as human readable', function (int $wordCount, string $expected) {
    $readTime = ReadTime::make($wordCount);

    expect((string) $readTime)->toBe($expected);
})
    ->with([
        [500, '3 minutes'],
        [3000, '15 minutes'],
        [18000, '1 hour 30 minutes'],
        [24000, '2 hours'],
        [24800, '2 hours 4 minutes'],
    ]);
