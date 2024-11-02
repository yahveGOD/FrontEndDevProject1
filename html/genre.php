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
            <h1 style="margin-top: 140px; font-size:50px;">Фильмы в жанре: <span th:text="${genre.name}"></span></h1>
            <main class="info">
                <div class="items-container">
                    <?php if (!empty($movies)): ?>
                        <?php foreach ($movies as $movie): ?>
                            <div class="item">
                                <img src="<?= htmlspecialchars($movie['poster']) ?>" alt="Alt" class="image">
                                <div class="text">
                                    <h2><a href="/movie/get/<?= htmlspecialchars($movie['movie_id']) ?>"><?= htmlspecialchars($movie['movie_name']) ?></a></h2>
                                    <p><?= htmlspecialchars($movie['description']) ?></p>
                                    <p>Year of release: <span><?= htmlspecialchars($movie['year_of_release']) ?></span></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>There is no movies in such genre.</p>
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