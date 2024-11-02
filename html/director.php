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
                    <div class="item" th:if="${director != null}">
                        <img th:src="${director.picture}" alt ="Alt" class="image">
                        <div class="text">
                            <h2 th:text="${director.name}"></h2>
                            <p th:text="${director.biography}"></p>
                            <p>Дата рождения: <span th:text="${director.birthDate}"></span></p>
                        </div>
                    </div>
                    <h2>Фильмография:</h2>
                    <div class="movies" th:each="movie : ${movies}">
                        <img th:src="${movie.poster}" alt ="Alt" class="image">
                        <div class="movie-info">
                            <h2><a th:href="@{/movie/get/{id}(id=${movie.id})}" th:text="${movie.name}"></a></h2>
                            <p th:text="${movie.description}"></p>
                            <p>Год выхода: <span th:text="${movie.year}"></span></p>
                            <p>Длительность: <span th:text="${movie.duration}"></span></p>
                            <p>Оценка: <span th:text="${movie.score}"></span></p>
                        </div>
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