<?php

$loader = require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$loader->addPsr4("PHPMarkdown\\", __DIR__ ."/../src/");

$lexer = new \PHPMarkdown\Lexer("# Hello");
$lexer->run();

echo $lexer->parsedContent;