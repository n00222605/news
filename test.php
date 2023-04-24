<?php
require_once './etc/config.php';

try {
    $formData = [
        "name" => "Wildflower",
        "year" => 2019,
        "price" => "21.95",
        "description" => "A very fine red wine for Bordeaux",
        "image" => "default.png",
        "grape_varieties" => "3,8",
        "winery_id" => 12
    ];
    $wine = new Wine($formData);
    echo "<pre>";
    print_r($wine);
    echo "</pre>";
}
catch (Exception $e) {
    echo $e->getMessage();
}
?>