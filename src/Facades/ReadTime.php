<?php

namespace Pownall\ReadTime\Facades;

use Illuminate\Support\Facades\Facade;

class ReadTime extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Pownall\ReadTime\ReadTime::class;
    }
}
