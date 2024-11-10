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
    <div class="container my-4">
        <main class="info">
            <div class="row">
                <?php foreach ($info as $data): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <img src="<?= $data['profile_pic'] ?>" alt="Alt" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="actor.php?id=<?= $data['actor_id'] ?>"><?= htmlspecialchars($data['actor_name']) ?></a>
                                </h5>
                                <p class="card-text"><?= htmlspecialchars($data['biography']) ?></p>
                                <p class="card-text"><small class="text-muted">Date of birth: <?= htmlspecialchars($data['year_of_birth']) ?></small></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
    <footer class="footer bg-dark text-white text-center py-3 mt-4">
        <p>© 2024 Spacer</p>
    </footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>