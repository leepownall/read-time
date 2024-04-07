<?php

use Pownall\ReadTime\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function blade(string $content)
{
    return app('blade.compiler')->compileString($content);
}
