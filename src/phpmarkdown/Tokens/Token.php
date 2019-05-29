<?php

namespace PHPMarkdown\Tokens;

/*
 * Token
 *
 * Basic token class
 */
abstract class Token
{

    /*
     * __construct
     *
     * Calls the tokenizer and contstructs the class
     *
     * @param string $string The string to be tokenized
     *
     */
    public abstract function __construct($string);

    /*
     *  __toString
     *
     * Retrieve the result
     *
     * @return string|null
     */
    public abstract function __toString();

    protected abstract function tokenize($string);

    protected abstract function returnOriginal();

    protected function purify($string)
    {
        return trim($string);
    }


}