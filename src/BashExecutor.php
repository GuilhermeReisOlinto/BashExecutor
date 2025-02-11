<?php

namespace BashExecutor;

class BashExecutor
{
    private array $allowedCommands = [
        'ls',
        'whoami',
        'pwd',
        'uptime',
        'echo',
        'cat',
        'ls -la'
    ];

    public function runCommand(string $command): array
    {
        $descriptors = [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
        ];

        $validate = $this->validWhiteList($command);

        if (is_string($validate)) {
            throw new \RuntimeException($validate . "\n");
        }

        $process = proc_open("\"$command\"", $descriptors, $pipes);

        if (!is_resource($process)) {
            throw new \RuntimeException("Error in open bash \n");
        }

        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);


        $error = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        $status = proc_close($process);

        return [
            "output" => trim($output),
            "error"  => trim($error),
            "status" => $status
        ];
    }

    private function validWhiteList(string $command): string | null
    {
        $cmdBase = explode(' ', trim($command))[0];

        for ($i = 0; $i <= count($this->allowedCommands); $i++) {
            if ($this->allowedCommands[$i] === $command) {
                return null;
            };
        }

        return "Command not allowed";
    }
}
