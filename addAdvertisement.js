document.getElementById("addAdvertisementForm").addEventListener('submit', (event) => {
    event.preventDefault()
    const formValue = new FormData(event.target)

    fetch('http://localhost/weather-app/php/addAdvertisement.php', { method: 'POST', body: formValue })
        .then(data => data.json())
        .then(data => {
            console.log(data);
        })

});
