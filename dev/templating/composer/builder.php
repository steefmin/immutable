<?php

declare(strict_types=1);

$branch = exec('git rev-parse --abbrev-ref HEAD');

$composerJson = file_get_contents('composer.json');

$composerConfig = json_decode($composerJson, true);

$composerConfig['require']['php'] = '~' . $branch;

file_put_contents('composer.json', json_encode($composerConfig, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
