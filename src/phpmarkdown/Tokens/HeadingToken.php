<?php

namespace PHPMarkdown\Tokens;


/*
 * HeadingToken
 *
 * Transforms MarkdownHeading to HTMLHeading
 */
class HeadingToken extends Token
{

    private $result;
    private $original;


    /*
     * constructs HeadingToken
     *
     * Takes in the Line to be tokenized
     *
     * @param string String The line to be tokenized
     */
    public function __construct($string)
    {
        $this->original = $string;
        $lines = explode(PHP_MARKDOWN_LINE_SEPERATOR, $string);

        foreach($lines as $line)
        {
            $this->result .= $this->tokenize($line);
        }
    }

    /*
     * toString
     *
     * Transforms this class to a readable string
     *
     * @return string The result of the lex
     */
    public function __toString()
    {
        if($this->result === null || empty($this->result)) // Error whilst parsing?
        {
            return $this->returnOriginal(); // Return the original!
        } else {
            return (String) $this->result; // Return the tokenized string!
        }
    }

    /*
     * tokenize
     *
     * Transform markdown headers to HTMl headers
     *
     * @param string $string the line to be lexed
     *
     * @return void
     */
    protected function tokenize($string)
    {
        $characters = str_split($string); // Split the string into loose chars
        $hashtags = 0; // A hashtag signifies a heading, the amount of hashtags the weight

        foreach($characters as $char) // Loop through all characters
        {
            if($char === '#') // Is it a hashtag?
            {
                $hashtags++; // Add a number to the hashtaglist, to calculate weight later on
            } else {
                break; // No more hashtags? Stop looping for efficiency.
            }
        }

        $unSyntaxedString = substr($string, (int) $hashtags, strlen($string)); // Remove the hashtags from the string
        $unSyntaxedString = parent::purify($unSyntaxedString); // Purify the string, to remove excessive whitespacing

        return $this->applyHeadings($hashtags, $unSyntaxedString);
    }

    /*
     * applyHeadings
     *
     * Transforms the amount of hashtags into correct HTMl syntax
     *
     * @param int $heading the heading weight
     * @param int $text the text the header should be applied to
     *
     * @return string|null
     */
    protected function applyHeadings($heading, $text)
    {
        switch($heading) // Now we determine the weight
        {
            case 1:
                return '<h1>' .$text .'</h1>'; // HEADING 1
            case 2:
                return '<h2>' .$text .'</h2>'; // HEADING 2
            case 3:
                return '<h3>' .$text .'</h3>'; // HEADING 3
            case 4:
                return '<h4>' .$text .'</h4>'; // HEADING 4
            case 5:
                return '<h5>' .$text .'</h5>'; // HEADING 5
            case 6:
                return '<h6>' .$text .'</h6>'; // HEADING 6
            default:
                return $text; // Do nothing, hashtags are meaningless
        }
    }

    /*
     * Return original
     *
     * Returns the original if intact to limit the chance of returning a null
     *
     * @return string the original string
     */
    protected function returnOriginal()
    {
        if($this->original === null)
        {
            return "";
        }
        return $this->original;
    }
}