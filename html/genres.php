<?php
    $db = new PDO("mysql:host=localhost;dbname=CinemaPhp",
    "root", "");

    $info = [];

    if($query = $db->query("SELECT * FROM genre")) {
        $info = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($db->errorInfo());
    }
?>


<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="UTF-8">
    <title>Spacer - Genres</title>

    <script src="../libs/gsap/gsap.min.js" defer></script>
    <script src="../libs/gsap/ScrollTrigger.min.js" defer></script>
    <script src="../libs/gsap/ScrollSmoother.min.js" defer></script>

    <link rel = "stylesheet" href="../css/genres.css">
    <script src ="../js/app.js" defer></script>
</head>
<body>

<nav id="nav-bar">
    <div class="container container-top">
        <div>
            <div class="logo">
                <a href="index.php"><img src="../img/Без%20имени-1.png" alt="Alt"></a>
            </div>
        </div>
        <div>
            <ul class="main-menu">
                <li><a href="genres.php">Genres</a></li>
                <li><a href="actors.php">Actors</a></li>
                <li><a href="#">Top-rated</a></li>
                <li><a href="newmovies.php">New</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="wrapper">
    <div class="content">
        <div class="container">
            <main class="info">
                <div class="items-container">
                    <?php foreach ($info as $data): ?>
                        <div class="genre"">
                            <img src="<?= $data['picture'] ?>" alt ="Alt" class="genre__images" style="width: 100px">
                            <div class="info info__right">
                                <h2><a href="genre.php?id=<?= $data['genre_id'] ?>"><?= $data['genre_name'] ?></a></h2>
                                <p><?= $data['description'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </div>
</div>
<footer class="footer">
    <p>© 2024 Spacer</p>
</footer>

</body>
</html>