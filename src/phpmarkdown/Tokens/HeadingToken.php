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
        $this->result = $this->tokenize($string);
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
        if($this->result === null || empty($this->result))
        {
            return (String) $this->result;
        } else {
            return $this->returnOriginal();
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
        $characters = str_split($string);
        $hashtags = 0;

        foreach($characters as $char)
        {
            if($char === '#')
            {
                $hashtags++;
            } else {
                break;
            }
        }

        $unSyntaxedString = substr($string, (int) $hashtags, strlen($string));
        $unSyntaxedString = parent::purify($unSyntaxedString);

        switch($hashtags)
        {
            case 1:
                $unSyntaxedString = '<h1>' .$unSyntaxedString .'</h1>';
                break;
            case 2:
                $unSyntaxedString = '<h2>' .$unSyntaxedString .'</h2>';
                break;
            case 3:
                $unSyntaxedString = '<h3>' .$unSyntaxedString .'</h3>';
                break;
            case 4:
                $unSyntaxedString = '<h4>' .$unSyntaxedString .'</h4>';
                break;
            case 5:
                $unSyntaxedString = '<h5>' .$unSyntaxedString .'</h5>';
                break;
            case 6:
                $unSyntaxedString = '<h6>' .$unSyntaxedString .'</h6>';
                break;
            default:
                $unSyntaxedString = "";
                break;
        }

        return $unSyntaxedString;
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