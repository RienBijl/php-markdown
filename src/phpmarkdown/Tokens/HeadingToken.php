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

    public function __construct($string)
    {
        $this->original = $string;
        $this->result = $this->tokenize($string);
    }

    public function __toString()
    {
        return (String) $this->result;
    }

    protected function tokenize($string)
    {
        $characters = explode("", $string);
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

        $unSyntaxedString = substr($string, 0, (int) $hashtags);
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
                return $this->returnOriginal();
                break;
        }

        return $unSyntaxedString;
    }

    protected function returnOriginal()
    {
        return $this->original;
    }
}