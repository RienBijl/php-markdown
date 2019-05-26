<?php

namespace PHPMarkdown;


/*
 * Lexer
 *
 * Prepares the text for easy use in the Formatter
 */
class Lexer
{

    private $rawContent;
    private $parsedContent;

    /*
     * Constructs the lexer
     *
     * Takes in the raw content and stores it in rawContent for later use
     *
     * $param string rawContent
     */
    public function __construct($rawContent)
    {
        $this->rawContent = $rawContent;
    }

}
