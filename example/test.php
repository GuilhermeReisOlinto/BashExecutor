<?php

require_once __DIR__ . "/../vendor/autoload.php";


use BashExecutor\BashExecutor;

$executor = new BashExecutor();

$result = $executor->runCommand('pwd');

echo "Saida: "  . $result['output'] . "\n";
echo "Error: "  . $result['error']  . "\n";
echo "Status: " . $result['status'] . "\n";
