<?php
    $db = new PDO("mysql:host=localhost;dbname=CinemaPhp",
        "root", "");

    $movie = null;

    if (isset($_GET['id'])) {
        $movieId = (int)$_GET['id']; // Получение и преобразование id актера в целое число

        // Подготовка и выполнение запроса для получения информации об актере
        $actorStmt = $db->prepare("SELECT * FROM movie WHERE movie_id = :movie_id");
        $actorStmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);

        if ($actorStmt->execute()) {
            $movie = $actorStmt->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($actorStmt->errorInfo());
        }
    } else {
        echo "There is no movie.";
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

    <link rel = "stylesheet" href="../css/movie.css">
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
                    <div class="movie" th:if="${movie != null}">
                        <img src="<?= htmlspecialchars($movie['poster']) ?>" alt ="Alt" class="image">
                        <div class="movie-info">
                            <h2><?= htmlspecialchars($movie['movie_name']) ?></h2>
                            <p><?= htmlspecialchars($movie['description']) ?></p>
                            <p>Year of release: <?= htmlspecialchars($movie['year_of_release']) ?></p>
                        </div>
                    </div>
                    <div class="player">
                        <iframe
                                src="<?= htmlspecialchars($movie['video']) ?>"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
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