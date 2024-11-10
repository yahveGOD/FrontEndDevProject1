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
<div class="wrapper py-5">
    <div class="container">
        <main class="info">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= htmlspecialchars($movie['poster']) ?>" alt="Movie Poster" class="card-img-top">
                        <div class="card-body">
                            <h3 class="card-title"><?= htmlspecialchars($movie['movie_name']) ?></h3>
                            <p class="card-text"><?= htmlspecialchars($movie['description']) ?></p>
                            <p class="text-muted">Year of release: <?= htmlspecialchars($movie['year_of_release']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="embed-responsive embed-responsive-16by9 shadow-sm">
                        <iframe
                            class="embed-responsive-item"
                            src="<?= htmlspecialchars($movie['video']) ?>"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </main>
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