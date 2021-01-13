document.getElementById("addAdvertisementForm").addEventListener('submit', (event) => {
    event.preventDefault()
    const formValue = new FormData(event.target)

    fetch('/weather-app/php/addAdvertisement.php', { method: 'POST', body: formValue })
        .then(data => data.text())
        .then(data => {
            location.replace('/weather-app/advertPanel.html')
        })

});
