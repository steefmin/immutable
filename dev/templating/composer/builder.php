<?php

declare(strict_types=1);

$minimumVersion = trim(file_get_contents('minimum_php_version'), PHP_EOL);

$composerJson = file_get_contents('composer.json');

$composerConfig = json_decode($composerJson, true);

$composerConfig['require']['php'] = '>=' . $minimumVersion;

file_put_contents('composer.json', json_encode($composerConfig, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
