<?php

namespace PHPMarkdown;

use PHPMarkdown\Tokens;


/*
 * Lexer
 *
 * Prepares the text for easy use in the Formatter
 */
class Lexer
{

    private $rawContent;
    public $parsedContent;

    /*
     * Constructs the lexer
     *
     * Takes in the raw content and stores it in rawContent for later use
     *
     * $param string $rawContent The unparsed content for Lexer
     * $param boolean $sanitize Should the string be sanitized
     * $param boolean $sanitizeWithTags Should we strip tags from the string, only works if sanitized
     */
    public function __construct($rawContent, $sanitize = true, $sanitizeWithTags = false)
    {
        if($sanitize)
        {
            $rawContent = $this->sanitize($rawContent, $sanitizeWithTags);
        }
        $this->rawContent = explode("\n", $rawContent);
    }

    /*
     * Sanitizes the contentstring
     *
     * Takes in the unsanitized string and sanitizes it
     *
     * $param string $unsanitized The unsantized string
     * $param boolean $stripTags Should we strip HTML tags?
     *
     * @return string The sanitized string
    */
    private function sanitize($unsanitized, $stripTags)
    {
        if($stripTags)
        {
            return htmlspecialchars(strip_tags($unsanitized), ENT_QUOTES);
        } else {
            return htmlspecialchars($unsanitized, ENT_QUOTES);
        }
    }

    /*
     * Run the lexer
     *
     * Locates and calls all the tokenizers
     *
     * @return null
     */
    public function run()
    {
        $computedResult = "";

        foreach($this->rawContent as $line)
        {
            // Tokenizers
            $computedResult .= new Tokens\HeadingToken($line);
        }


        // Store result
        $this->parsedContent = $computedResult;
    }
}
