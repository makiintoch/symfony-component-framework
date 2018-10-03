<?php

require_once './vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testHello()
    {
        $_GET['name'] = 'World';

        ob_start();
        include 'index.php';
        $content = ob_get_clean();

        $this->assertEquals('Hello World', $content);
    }
}