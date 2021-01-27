function createAd(formValue) {
    fetch('/weather-app/php/addAdvertisement.php', {method: 'POST', body: formValue})
        .then(data => data.text())
        .then(data => {
            location.replace('/weather-app/advertPanel.php')
        })
}

function editAd(id, formValue) {
    formValue.append('id', id)
    fetch(`/weather-app/php/addAdvertisement.php?id=${id}`, {method: 'POST', body: formValue})
        .then(data => data.text())
        .then(data => {
            location.replace('/weather-app/advertPanel.php')
        })
}

let id = null;
document.getElementById("addAdvertisementForm").addEventListener('submit', (event) => {
    event.preventDefault()
    const formValue = new FormData(event.target)
    if (id !== null) {
        editAd(id, formValue)
    } else {
        createAd(formValue);
    }
});
new URLSearchParams(location.search).forEach((e, x) => {
    let element = document.getElementById(x);
    if (element !== null) {
        element.value = e;
    }
    if (x === "id") {
        id = e;
    }

})

