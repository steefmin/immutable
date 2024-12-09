<?php

declare(strict_types=1);

$minimumVersion = file_get_contents('minimum_php_version');

$template = <<<TEMPLATE
php $minimumVersion.0

TEMPLATE;

file_put_contents('.tool-versions', $template);
