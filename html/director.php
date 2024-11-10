<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="UTF-8">
    <title>Spacer - Directors</title>

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
            <div class="col-md-4 text-center">
                <img th:src="${director.picture}" alt="Director Image" class="img-fluid rounded">
                <div class="text mt-3">
                    <h2 th:text="${director.name}"></h2>
                    <p th:text="${director.biography}"></p>
                    <p>Дата рождения: <span th:text="${director.birthDate}"></span></p>
                </div>
            </div>

            <div class="col-md-8">
                <h2>Фильмография:</h2>
                <div class="row">
                    <div class="col-md-6 mb-4" th:each="movie : ${movies}">
                        <div class="card h-100">
                            <img th:src="${movie.poster}" alt="Movie Poster" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a th:href="@{/movie/get/{id}(id=${movie.id})}" th:text="${movie.name}"></a>
                                </h5>
                                <p class="card-text" th:text="${movie.description}"></p>
                                <ul class="list-unstyled">
                                    <li>Год выхода: <span th:text="${movie.year}"></span></li>
                                    <li>Длительность: <span th:text="${movie.duration}"></span> мин.</li>
                                    <li>Оценка: <span th:text="${movie.score}"></span>/10</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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