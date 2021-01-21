function fun(e) {
    fetch(`/weather-app/php/addLike.php?advertisementId=${e}`)
        .then(data => data.text())
}