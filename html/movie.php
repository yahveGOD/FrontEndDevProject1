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
                        <img th:src="${movie.poster}" alt ="Alt" class="image">
                        <div class="movie-info">
                            <h2 th:text="${movie.name}"></h2>
                            <p th:text="${movie.description}"></p>
                            <p>Год выхода: <span th:text="${movie.year}"></span></p>
                            <p>Жанры:
                                <span th:each="genre, iterStat : ${genres}">
                                    <a th:href="@{/genre/get/{id}(id=${genre.id})}" th:text="${genre.name}"></a>
                                    <span th:if="${!iterStat.last}">, </span>
                                </span>
                            </p>
                            <p>Длительность: <span th:text="${movie.duration}"></span></p>
                            <p>Оценка: <span th:text="${movie.score}"></span></p>
                            <p>Актеры:
                                <span th:each="actor, iterStat : ${actors}">
                                    <a th:href="@{/actor/get/{id}(id=${actor.id})}" th:text="${actor.name}"></a>
                                    <span th:if="${!iterStat.last}">, </span>
                                </span>
                            </p>
                            <p>Режиссер: <a th:href="@{/director/get/{id}(id=${director.id})}" th:text="${director.name}"></a></p>
                        </div>
                    </div>
                    <div class="player">
                        <iframe
                                th:src="@{'https://www.youtube.com/embed/' + ${movie.video}}"
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