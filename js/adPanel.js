function myScript() {
    window.alert("klepnięte");
}

function addAd() {

}

fetch('http://localhost/weather-app/php/getAdvertisements.php')
    .then(response => response.json())
    .then(data => {
        display(data)
    })

function jsonToHtml(json) {
    let result = [];
    json.forEach((i) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
<td>${i.name}</td>
<td>${i.description}</td>
<td>${i.more}</td>
<td>${i.image}</td>
<td>${i.link}</td>
<td>${i.tag}</td>
`
        result.push(tr);
    })
    return result;
}

function display(data) {
    let tableBody = document.querySelector("tbody");
    tableBody.append(...jsonToHtml(data));
}