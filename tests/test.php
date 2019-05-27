<?php

$loader = require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload



$lexer = new \PHPMarkdown\Lexer("# Hello\n#### Hey!");
$lexer->run();

echo $lexer->parsedContent;