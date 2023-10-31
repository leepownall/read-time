<?php

namespace Pownall\ReadTime\Parsers;

class ArrayParser
{
    public function from(array $content): int
    {
        $content = implode(' ', $content);

        return str_word_count($content);
    }
}
