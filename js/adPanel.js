function editAd(advertisement) {
    location.replace('/weather-app/addAdvertisement.php' +
        `?name=${advertisement.name}&`+
        `description=${advertisement.description}&`+
        `more=${advertisement.more}&`+
        `picture=${advertisement.picture}&`+
        `link=${advertisement.link}&`+
        `tag=${advertisement.tag}&`+
        `id=${advertisement.id}`
    );
}

function changeLocation() {
    location.replace('/weather-app/addAdvertisement.php');
}

function addAd() {

}

function deleteAd(id) {
    fetch(SERVER + '/weather-app/php/deleteAdvertisement.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            getDataFromDB();
        })
}

function getDataFromDB() {
    fetch(SERVER + 'weather-app/php/getAdvertisements.php')
        .then(response => response.json())
        .then(data => {
            display(data)
        })
}

getDataFromDB()

function jsonToHtml(json) {
    let result = [];
    json.forEach((i) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
<td>${i.name}</td>
<td>${i.description}</td>
<td>${i.more}</td>
<td>${i.picture}</td>
<td>${i.link}</td>
<td>${i.tag}</td>
<td>${i.likesCount}</td>
<td><span class="fa fa-trash clickable delete"></span></td>
<td><span class="fa fa-pencil clickable edit"  ></span></td>
`
        tr.querySelector(".delete").addEventListener('click', () => {deleteAd(i.id)})
        tr.querySelector(".edit").addEventListener('click', () => {editAd(i)})
        result.push(tr);
    })
    return result;
}

function display(data) {
    let tableBody = document.querySelector("tbody");
    tableBody.innerHTML='';
    tableBody.append(...jsonToHtml(data));
}