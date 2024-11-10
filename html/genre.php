<?php
    $db = new PDO("mysql:host=localhost;dbname=CinemaPhp",
        "root", "");

    $movies = [];

    if (isset($_GET['id'])) {
        $genreId = (int)$_GET['id']; // Получение и преобразование id жанра в целое число

        // Подготовка и выполнение запроса для получения фильмов по id жанра
        $stmt = $db->prepare("SELECT movie.*, genre.genre_name AS genre_name 
                                    FROM movie 
                                    JOIN genre ON movie.genre = genre.genre_id 
                                    WHERE movie.genre = :genre_id;");

        $stmt->bindParam(':genre_id', $genreId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }
    } else {
        echo "There is no genre.";
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
<div class="container my-5">
    <h1 class="text-center mb-5" style="font-size:50px;">Movies in Genre: <span th:text="${genre.name}"></span></h1>
    <div class="row">
        <?php if (!empty($movies)): ?>
            <?php foreach ($movies as $movie): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($movie['poster']) ?>" alt="Movie Poster" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/movie/get/<?= htmlspecialchars($movie['movie_id']) ?>"><?= htmlspecialchars($movie['movie_name']) ?></a>
                            </h5>
                            <p class="card-text"><?= htmlspecialchars($movie['description']) ?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Year of release: <span><?= htmlspecialchars($movie['year_of_release']) ?></span></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">There are no movies in this genre.</p>
        <?php endif; ?>
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