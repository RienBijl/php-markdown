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
     * $param string $rawContent The unparsed content for Lexer
     * $param boolean $sanitize Should the string be sanitized
     */
    public function __construct($rawContent, $sanitize = true)
    {
        if($sanitize)
        {
            $rawContent = $this->sanitize($rawContent);
        }
        $this->rawContent = $rawContent;
    }

    /*
     * Sanitizes the contentstring
     *
     * Takes in the unsanitized string and sanitizes it
     *
     * $param string $unsanitized The unsantized string
     * $param boolean $sanitize Should we sanitize the String?
     *
     * @return string The sanitized string
    */
    private function sanitize($unsanitized)
    {
        return htmlspecialchars($unsanitized, ENT_QUOTES);
    }

}
