<?php
    $db = new PDO("mysql:host=localhost;dbname=CinemaPhp",
        "root", "");

    $info = [];

    if($query = $db->query("SELECT * FROM actor")) {
        $info = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($db->errorInfo());
    }
?>


<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="UTF-8">
    <title>Spacer - Actors</title>

    <script src="../libs/gsap/gsap.min.js" defer></script>
    <script src="../libs/gsap/ScrollTrigger.min.js" defer></script>
    <script src="../libs/gsap/ScrollSmoother.min.js" defer></script>

    <link rel = "stylesheet" href="../css/movie_profile.css">
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
                        <div class="item">
                            <img src="<?= $data['profile_pic'] ?>" alt ="Alt" class="image">
                            <div class="text">
                                <h2><a href="actor.php?id=<?= $data['actor_id'] ?>"><?= $data['actor_name'] ?></a></h2>
                                <p><?= $data['biography'] ?></p>
                                <p>Date of birth: <?= $data['year_of_birth'] ?></p>
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