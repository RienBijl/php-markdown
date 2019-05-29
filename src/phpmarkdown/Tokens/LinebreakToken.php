<?php

namespace PHPMarkdown\Tokens;

class LinebreakToken extends Token
{

    public function __construct($string)
    {
        parent::__construct($string);
    }

    public function __toString()
    {
        return "";
    }

    protected function tokenize($string)
    {
        // TODO: Implement tokenize() method.
    }

    protected function returnOriginal()
    {
        // TODO: Implement returnOriginal() method.
    }
}