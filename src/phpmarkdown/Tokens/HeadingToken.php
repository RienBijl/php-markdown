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

        $syntaxedString = ""; // This will be our string with syntax

        switch($hashtags) // Now we determine the weight
        {
            case 1:
                $syntaxedString = '<h1>' .$unSyntaxedString .'</h1>'; // HEADING 1
                break;
            case 2:
                $syntaxedString = '<h2>' .$unSyntaxedString .'</h2>'; // HEADING 2
                break;
            case 3:
                $syntaxedString = '<h3>' .$unSyntaxedString .'</h3>'; // HEADING 3
                break;
            case 4:
                $syntaxedString = '<h4>' .$unSyntaxedString .'</h4>'; // HEADING 4
                break;
            case 5:
                $syntaxedString = '<h5>' .$unSyntaxedString .'</h5>'; // HEADING 5
                break;
            case 6:
                $syntaxedString = '<h6>' .$unSyntaxedString .'</h6>'; // HEADING 6
                break;
            default:
                $syntaxedString = $string; // Do nothing, hashtags are meaningless
                break;
        }

        return $syntaxedString; // Return the string
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