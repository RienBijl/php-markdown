<?php

require './vendor/autoload.php';

$lexer = new \PHPMarkdown\Lexer("# Hello");
$lexer->run();

echo $lexer->parsedContent;