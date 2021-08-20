<?php

spl_autoload_register(function ($classPath) {
    // 1 => Если перед $classPath есть '\', то его надо удалить:
    $classPath = ltrim($classPath, '\\');
    
    // 2 => Создаем отдельные переменные для имени класса, имени файла и пространства имен:
    $className = '';
    $fileName = '';
    $namespace = '';

    // 3 => Получаем позицию внутреннего '\', отделяющего namespace от иемни класса:
    $slashPos = strrpos($classPath, '\\');

    // 4 => Определяем namespace и имя класса, если namespace - указан:
    if ($slashPos > -1) {
        $namespace = substr($classPath, 0, $slashPos);
        $className = substr($classPath, $slashPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
    }

    // 5 => Добавляем имя самого файла размещения класса:
    $fileName .= str_replace('\\', DIRECTORY_SEPARATOR, lcfirst($className)).'.php';
    if (file_exists($fileName)) {
        require_once($fileName);
    } else {
        //echo('<h3 style="color: red">Class Not Found</h3>');
    }
});
