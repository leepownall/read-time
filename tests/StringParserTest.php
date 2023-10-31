<?php

use Pownall\ReadTime\Parsers\StringParser;

it('can count words', function (int $expectedCount, string $content) {
    $parser = new StringParser();

    expect($parser->from($content))->toBe($expectedCount);
})->with([
    [2, 'Hello world'],
    [5, 'Hello there Taylor Otwell, boo!'],
]);
