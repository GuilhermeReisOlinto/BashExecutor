<?php

require_once __DIR__ . "/../vendor/autoload.php";

use BashExecutor\BashExecutor;
use PHPUnit\Framework\TestCase;

class BashExecutorTest extends TestCase
{
    public function testReturnIfCommandCorrect()
    {
        $executor = new BashExecutor();

        $result = $executor->runCommand("pwd");

        $this->assertEquals("/home/guilherme.olinto/Documentos/projetos/libs/BashExecutor", trim($result['output']));
    }

    public function testReturnEmptyCaseCommandNotFound()
    {
        $executor = new BashExecutor();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Command not allowed");

        $executor->runCommand("test_command_non-existent");
    }
}
