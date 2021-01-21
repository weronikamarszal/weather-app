function fun(e) {
    console.log(e)

    fetch(`/weather-app/php/addLike.php?advertisementId=${e}`)
        .then(data => data.text())
        .then(data => {
            console.log(data);
        })
}