<!DOCTYPE html>
<html lang="en">

<?php
require_once "./etc/config.php";

$PAmedium2 = Story::findAllLimit(5, 0);

try{

    if ($_SERVER["REQUEST_METHOD"] !== "GET") {
        throw new Exception("Invalid request method");
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception("Invalid request--missing id");
    }
    $id = $_GET['id'];
    $story = Story::findById($id);
    if ($story === null) {
        throw new Exception("Invalid request--unknown id");
    }
}
catch (Exception $ex) {
    die($ex->getMessage());
}
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/grid.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/big.css" />
    <link rel="stylesheet" href="css/titles.css" />
    <link rel="stylesheet" href="css/small.css" />
    <link rel="stylesheet" href="css/medium.css" />
    <link rel="stylesheet" href="css/largest.css" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/sections.css" />
    <link rel="stylesheet" href="css/PA.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/mainArticle.css" />

    <title>News</title>
</head>

<body>

    <header>
        <div class="container">
            <div class="width-2">
                <h1>The News</h1>
            </div>
            <div class="categories">
                <div class="width-10">
                    <ul>
                        <li><a href="#">Sport</a></li>
					    <li><a href="#">Science</a></li>
					    <li><a href="#">Fashion</a></li>
					    <li><a href="#">Crime</a></li>
					    <li><a href="#">Business</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="mainArticle">
        <div class="container">
            <div class="width-9">
                <div class="article">
                    <div class="title">
                        <h1><?= $story->heading; ?></h1>
                        <h2><?= $story->sub_heading; ?></h2>
                    </div>

                    <div class="image">
                        <img src="<?= $story->image;?>"/>
                    </div>

                    <div class="articleText">
                        <p><?=$story->article?></p>
                    </div>

                    <div class="authorTime">
                        <div class="author">
                            <h3>By <?= $story->author; ?></h3>
                        </div>
                        <div class="time">
                            <h4 style="margin-right: 7px;"><?=$story->publish_date?> at <?=$story->publish_time?></h5>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="width-3">
            <div class="medTitle">
                <h1>Popular Stories</h1>
            </div>
            <?php 
            foreach($PAmedium2 as $story) { ?>
                <div class="MAmedium">
                    <a href="article.php?id=<?= $story->id ?>">
                        <div class="image"><img src="<?= $story->image; ?>" /></div>
                        <div class="text">
                            <h1>
                                <?= $story->heading; ?>
                            </h1>
                            <p>By <?= $story->author; ?></p>
                        </div>
                    </a>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="width-12">
            <div class="container">
                <ul>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
		            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
		            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
		            <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
		            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</body>