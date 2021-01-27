function fun(e) {
    return fetch(`/weather-app/php/addLike.php?advertisementId=${e}`)
        .then(data => data.text())
}