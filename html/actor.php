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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav id="nav-bar" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="../img/Без%20имени-1.png" alt="Alt" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="genres.php">Genres</a></li>
                <li class="nav-item"><a class="nav-link" href="actors.php">Actors</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Top-rated</a></li>
                <li class="nav-item"><a class="nav-link" href="newmovies.php">New</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <?php if ($actor): ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($actor['profile_pic']) ?>" alt="Actor Image" class="card-img-top">
                    <div class="card-body">
                        <h2 class="card-title"><?= htmlspecialchars($actor['actor_name']) ?></h2>
                        <p class="card-text"><?= htmlspecialchars($actor['biography']) ?></p>
                        <p>Year of birth: <span><?= htmlspecialchars($actor['year_of_birth']) ?></span></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <h2>Filmography:</h2>
            <?php if (!empty($movies)): ?>
                <?php foreach ($movies as $movie): ?>
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="<?= htmlspecialchars($movie['poster']) ?>" class="card-img" alt="Movie Poster">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="/movie/get/<?= htmlspecialchars($movie['movie_id']) ?>">
                                            <?= htmlspecialchars($movie['movie_name']) ?>
                                        </a>
                                    </h5>
                                    <p class="card-text"><?= htmlspecialchars($movie['description']) ?></p>
                                    <p>Year of release: <span><?= htmlspecialchars($movie['year_of_release']) ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>There are no movies with this actor.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="footer bg-dark text-white text-center py-3 mt-4">
    <p>© 2024 Spacer</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>