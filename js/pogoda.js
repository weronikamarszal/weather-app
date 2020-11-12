const api={
    key:"7a7b4325b0cdbb4e8bc97d4c5138c58d",
    baseurl:"https://api.openweathermap.org/data/2.5/"
}
const searchbox = document.querySelector('.search-box');
searchbox.addEventListener('keypress', setQuery);

function setQuery(evt) {
   if(evt.keyCode==13){
       getResults(searchbox.value);
       console.log(searchbox.value);
   }
}

function getResults (query) {
    fetch(`${api.baseurl}weather?q=${query}&units=metric&APPID=${api.key}&lang=pl`)
        .then(weather => {
            return weather.json();
        }).then(displayResults);
}

function displayResults (weather) {
    if (weather) {
        displayAd(weather);
    }
    console.log(weather);
    let city = document.querySelector('.location .city');
    city.innerText = `${weather.name}, ${weather.sys.country}`;
    let now = new Date();
    let date = document.querySelector('.location .date');
    var utc = new Date(now.getTime() + now.getTimezoneOffset() * 60000);
    let seconds=weather.timezone;
    utc.setSeconds(utc.getSeconds() + seconds);
    let date2=dateBuilder(utc);

    date.innerText = date2;

    let icon = document.querySelector('.weather-image');
    let url = "url('http://openweathermap.org/img/wn/" + weather.weather[0].icon + "@2x.png')"
    icon.style.backgroundImage=url;

    let temp = document.querySelector('.current .temp');
    temp.innerHTML = `${Math.round(weather.main.temp)}<span>°C</span>`;

    let weather_el = document.querySelector('.current .weather');
    weather_el.innerText = weather.weather[0].description;

    let hilow = document.querySelector('.hi-low');
    hilow.innerText = `${Math.round(weather.main.temp_min)}°C / ${Math.round(weather.main.temp_max)}°C`;
}

function dateBuilder (d) {
    let months = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
    let days = ["Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota"];

    let day = days[d.getDay()];
    let date = d.getDate();
    let month = months[d.getMonth()];
    let year = d.getFullYear();
    let hours=d.getHours();
    let minutes=d.getMinutes();
    return `${day}, ${date} ${month} ${year}, ${hours}:${minutes}`;
}

//======================================ZAPISYWANIE MIAST DO LOCAL STORAGE============================================//

let addButton = document.getElementById('add');
let inputTask = document.getElementById('city');
let task = document.getElementById('tasks');

function createNewElement(task) {
    let listItem = document.createElement('li');
    let label = document.createElement('label');
    label.innerText = task;
    let deleteButton = document.createElement('button');
    deleteButton.innerText = "Delete";
    deleteButton.onclick = function () {
        deleteButton.parentElement.remove()
        save();
    };
    listItem.appendChild(label);
    listItem.appendChild(deleteButton);

    return listItem;
}

function addTask() {
    if (inputTask.value.length > 2 && inputTask.value.length < 256) {
        let listItem = createNewElement(inputTask.value);
        task.appendChild(listItem);
        inputTask.value = "";
        save();
    } else {
        inputTask.value = "";
        alert('To pole musi zawierac wiecej niz 2 znaki i mniej niz 256 znaki');
    }
}

(function() {
    document.querySelector('input').addEventListener('keydown', function(e) {
        if (e.keyCode === 13) {
            if (inputTask.value.length < 2) {
                inputTask.value = "";
                alert('To pole musi zawierac wiecej niz 2 znaki');

                let listItem = createNewElement(inputTask.value);
                task.appendChild(listItem);
                inputTask.value = "";
                save();
            } else {
                let listItem = createNewElement(inputTask.value);
                task.appendChild(listItem);
                inputTask.value = "";
                save();
            }
        }
    });
})();
/*==================================================================================================================*/
/*==================================================================================================================*/
function save() {

    let taskArr = [];
    for (let i = 0; i < task.children.length; i++) {
        taskArr.push(task.children[i].getElementsByTagName('label')[0].innerText);
    }

    localStorage.removeItem('todo');
    localStorage.setItem('todo', JSON.stringify({
        task: taskArr
    }));

}

function load(){
    return JSON.parse(localStorage.getItem('todo'));
}

let data=load();

for(let i=0; i<data.task.length;i++){
    let listItem=createNewElement(data.task[i], false);
    task.appendChild(listItem);
}

//====================================================================================================================//
