<?php

namespace Pownall\ReadTime\Parsers;

class StringParser
{
    public function from(string $content): int
    {
        return str_word_count(strip_tags(trim(preg_replace('/\s+/u', ' ', $content))));
    }
}
