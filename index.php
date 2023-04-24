<!DOCTYPE html>
<html lang="en">

<?php
require_once "./etc/config.php";
$bigStory = Story::findAllLimit(1, 0);
$rightStories = Story::findAllLimit(5, 1);
$mediumStories = Story::findAllLimit(3, 5);
$largestStory = Story::findAllLimit(1, 8);
$PAmedium1 = Story::findAllLimit(2, 15);
$PAlarge = Story::findAllLimit(1, 17);
$PAmedium2 = Story::findAllLimit(2, 18);
$medium2Stories = Story::findAllLimit(3, 9);
$medium3Stories = Story::findAllLimit(3, 12);
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

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

    <title>News</title>
</head>

<body>
    <!--header-->
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

    <!--Title-->
    <div class="container">
        <div class="width-12">
            <div class="Title">
                <div class="header">
                    <h1>Todays News</h1>
                </div>
            </div>
        </div>
    </div>

    <!--Big + Small-->
    <div class="Section01">
        <div class="container">
            <!--Large Stories-->
            <div class="width-9">
            <?php 
            foreach($bigStory as $story) { ?>
                <div class="Big">
                    <a href="article.php?id=<?= $story->id ?> ">
                        <div class="image"><img src="<?= $story->image; ?>"></div>
                        <div class="text">
                            <h1><?= $story->heading; ?></h1>
                            <h2>
                                <?= $story->sub_heading; ?>
                            </h2>
                            <p>2 MIN READ</p>
                    </a>
                </div>
            <?php } ?>
            </div>
        </div>

        <!--Small Stories-->
        <div class="width-3">
            <div class="Small">
                <?php 
                foreach($rightStories as $story) { ?>
                <?php $category = Category::findById($story->category_id); ?>
                <div class="small1">
                    <div class="text">
                        <a href="article.php?id=<?= $story->id ?>">
                            <h1>
                                <?= $story->heading; ?>
                            </h1>
                            <p>Opinion by <?= $story->author; ?></p>
                        </a>
                    </div>
                        <div class="image"><img src="<?= $story->image; ?>" style="max-width:100px;max-height:100px;" /></div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!--Medium Stories-->
    <div class="Section02">
        <div class="container">
        <?php 
        foreach($mediumStories as $story) { ?>
        <?php $category = Category::findById($story->category_id); ?>
            <div class="width-4">
                <div class="Medium">
                    <div class="medium1">
                        <a href="article.php?id=<?= $story->id ?>">
                            <div class="image"><img src="<?= $story->image; ?>" /></div>
                            <div class="text">
                                <h2><b>LONDON</b> <i class="fa-regular fa-clock"></i><?= $story->publish_time; ?></h2>
                                <h1>
                                    <?= $story->heading; ?>
                                </h1>
                                <p>By <?= $story->author; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div> 
    </div>

    <!--Largest-->
    <div class="section03">
        <div class="container">
            <div class="width-12">
                <div class="Largest">
                <?php 
                foreach($largestStory as $story) { ?>
                <?php $category = Category::findById($story->category_id); ?>
                    <div class="text">
                        <a href="article.php?id=<?= $story->id ?>">
                            <h2><?= $category->name; ?></h2>
                            <h1><?= $story->heading; ?></h1>
                            <h3><?= $story->sub_heading; ?></h3>
                            <p>
                                <?= implode(' ', array_slice(str_word_count($story->article, 1), 0, 50)); ?>
                            </p>
                        </a>
                    </div>
                    <div class="image"><img src="<?= $story->image; ?>"  style=" width: 585px; padding-top: 100px;" /></div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!--Popular-->
    <div class="container">
        <div class="width-12">
            <div class="Title">
                <div class="header">
                    <h1>Popular Articles</h1>
                </div>
            </div>
        </div>
    </div>

    <!--Big + Medium-->
    <div class="section04">
        <div class="container">
            <div class="width-3">
            <?php 
            foreach($PAmedium1 as $story) { ?>
                <div class="PAMedium">
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
    

            <!--Big Story-->
            <?php 
            foreach($PAlarge as $story) { ?>
            <?php $category = Category::findById($story->category_id); ?>
            <div class="width-6">
                <div class="PABig">
                <a href="article.php?id=<?= $story->id ?>">
                    <h1><?= $story->heading; ?></h1>
                    <div class="image"><img src="<?= $story->image; ?>" /></div>
                    <h2><?= $story->sub_heading; ?></h2>
                </a>
                </div>
            </div>
            <?php } ?>

            <!--Medium Stories-->
            <div class="width-3">
            <?php 
            foreach($PAmedium2 as $story) { ?>
                <div class="PAMedium">
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

    <!--bottom sotries-->
    <div class="Section05">
        <div class="container">
        <?php 
        foreach($medium2Stories as $story) { ?>
        <?php $category = Category::findById($story->category_id); ?>
            <div class="width-4">
                <div class="Medium">
                    <div class="medium1">
                        <a href="article.php?id=<?= $story->id ?>">
                            <div class="image"><img src="<?= $story->image; ?>" /></div>
                            <div class="text">
                                <h2><i class="fa-regular fa-clock"></i><?= $story->publish_time; ?></h2>
                                <h1>
                                    <?= $story->heading; ?>
                                </h1>
                                <p>By <?= $story->author; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>

        <div class="container">
        <?php 
        foreach($medium3Stories as $story) { ?>
        <?php $category = Category::findById($story->category_id); ?>
            <div class="width-4">
                <div class="Medium">
                    <div class="medium1">
                        <a href="article.php?id=<?= $story->id ?>">
                            <div class="image"><img src="<?= $story->image; ?>" /></div>
                            <div class="text">
                                <h2><i class="fa-regular fa-clock"></i><?= $story->publish_time; ?></h2>
                                <h1>
                                    <?= $story->heading; ?>
                                </h1>
                                <p>By <?= $story->author; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
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

</html>