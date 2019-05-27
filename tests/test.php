<form action="" method="post">
    <textarea name="msg" id="" cols="100" rows="10"></textarea>
    <br>
    <input type="submit">
</form>

<?php

if(isset($_POST['msg']))
{
    $loader = require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload



    $lexer = new \PHPMarkdown\Lexer($_POST['msg']);
    $lexer->run();

    echo '<hr>'  . $lexer->parsedContent;
}
    ?>