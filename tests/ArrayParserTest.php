<?php

use Pownall\ReadTime\Parsers\ArrayParser;

it('can count words', function (int $expectedCount, array $content) {
    $parser = new ArrayParser();

    expect($parser->from($content))->toBe($expectedCount);
})->with([
    [4, ['Hello world', 'Hello world']],
    [7, ['Hello there Taylor Otwell, boo!', 'Hello world']],
]);
