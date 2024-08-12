<?php

$folderItems = glob(realpath(AIA_PLUGIN_DIR) . '/app/*');

if (empty($folderItems)) {
    return;
}

foreach ($folderItems as $path) {
    $path = str_replace('\\', '/', $path);

    if (strpos($path, '.php') === false) {
        continue;
    }

    $className = str_replace('.php', '', basename($path));

    require_once $path;

    if (method_exists($className, 'init')) {
        $className::{'init'}();
    }
}