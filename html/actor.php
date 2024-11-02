<?php
$db = new PDO("mysql:host=localhost;dbname=CinemaPhp", "root", "");

$movies = [];
$actor = null;

if (isset($_GET['id'])) {
    $actorId = (int)$_GET['id']; // Получение и преобразование id актера в целое число

    // Подготовка и выполнение запроса для получения информации об актере
    $actorStmt = $db->prepare("SELECT * FROM actor WHERE actor_id = :actor_id");
    $actorStmt->bindParam(':actor_id', $actorId, PDO::PARAM_INT);

    if ($actorStmt->execute()) {
        $actor = $actorStmt->fetch(PDO::FETCH_ASSOC);
    } else {
        print_r($actorStmt->errorInfo());
    }

    // Подготовка и выполнение запроса для получения фильмов по id актера
    $stmt = $db->prepare("
        SELECT movie.*, actor.actor_name AS actor_name 
        FROM movie 
        JOIN movie_actor ON movie.movie_id = movie_actor.mov_id 
        JOIN actor ON movie_actor.act_id = actor.actor_id 
        WHERE actor.actor_id = :actor_id;
    ");

    $stmt->bindParam(':actor_id', $actorId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
    }
} else {
    echo "There are no movies.";
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
                    <div class="item" th:if="${item != null}">
                        <img src="<?= htmlspecialchars($actor['profile_pic']) ?>" alt ="Alt" class="image">
                        <div class="text">
                            <h2><<?= htmlspecialchars($actor['actor_name']) ?></h2>
                            <p><?= htmlspecialchars($actor['biography']) ?></p>
                            <p>Year of birth: <span><?= htmlspecialchars($actor['year_of_birth']) ?></span></p>
                        </div>
                    </div>
                    <h2>Фильмография:</h2>
                    <?php if (!empty($movies)): ?>
                        <?php foreach ($movies as $movie): ?>
                            <div class="movies">
                                <img src="<?= htmlspecialchars($movie['poster']) ?>" alt ="Alt" class="image">
                                <div class="movie-info">
                                    <h2><a href="/movie/get/<?= htmlspecialchars($movie['movie_id']) ?>"<?= htmlspecialchars($movie['movie_name']) ?></a></h2>
                                    <p><?= htmlspecialchars($movie['description']) ?></p>
                                    <p>Year of release: <span><?= htmlspecialchars($movie['year_of_release']) ?></span></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>There is no movies with this actor.</p>
                    <?php endif; ?>
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