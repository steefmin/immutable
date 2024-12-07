<?php

declare(strict_types=1);

$branch = exec('git rev-parse --abbrev-ref HEAD');

$template = <<<TEMPLATE
php $branch.0

TEMPLATE;

file_put_contents('.tool-versions', $template);
