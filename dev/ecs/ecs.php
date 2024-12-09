<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths(
        [
            __DIR__ . '/../../src',
            __DIR__ . '/../../tests',
        ],
    )
    ->withPreparedSets(
        psr12: true,
        arrays: true,
        comments: true,
        spaces: true,
        namespaces: true,
        controlStructures: true,
        strict: true,
        cleanCode: true,
    );
