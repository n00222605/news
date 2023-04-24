<?php
namespace news_page;

define("APP_ROOT", dirname(__DIR__));
define("APP_URL", "http://localhost/news_page/stories");

spl_autoload_register(function ($class) {
    $class_path = str_replace('\\', '/', $class);
    
    $file = dirname(__DIR__) . '/classes/' . $class_path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once "global.php";
?>