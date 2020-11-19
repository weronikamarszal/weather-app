const api={
    key:"7a7b4325b0cdbb4e8bc97d4c5138c58d",
    baseurl:"https://api.openweathermap.org/data/2.5/"
}
//const searchbox = document.querySelector('.search-box');
//searchbox.addEventListener('keypress', setQuery);
let lan;
let lat;
// function setQuery(evt) {
//     if(evt.keyCode==13){
//         getResults(searchbox.value).then(weather=>{
//             if(weather) {
//                 lan = weather.coord.lon;
//                 lat = weather.coord.lat;
//                 displayResults(weather);
//                 getWeather();
//
//             }
//         }
//         );
//         // let listItem = createNewElement(inputTask.value);
//         // task.appendChild(listItem);
//         // inputTask.value = "";
//         // save();
//     }
// }

async function getResults(query) {
    const response = await fetch(`${api.baseurl}weather?q=${query}&units=metric&APPID=${api.key}&lang=pl`);
    const weather  = await response.json();
    return weather;
}
function getWeather(){
    console.log(lan,lat);
    fetch(`https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lan}&exclude=daily,minutely&appid=7a7b4325b0cdbb4e8bc97d4c5138c58d&units=metric`)
        .then(weathers=> {
            return weathers.json();
        }).then(displayForecast);
}

function displayResults (weather) {
    if (weather) {
        displayAd(weather);
        setMapLocation(weather.coord);
    }
    //console.log(weather);
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

function displayForecast(weathers){
    console.log(weathers);
    console.log(lan,lat);
    let ex=document.querySelector('.current,.ex')
    let arrayW=[];
    let arrayDates=[];
    let arrayTemps=[];
    console.log(JSON.stringify(weathers.hourly[1].dt));
    for(i=0;i<weathers.hourly.length;i++){
        let time=weathers.hourly[i].dt;
        let temp=weathers.hourly[i].temp;
        arrayW.push([time,temp]);
        myDate = new Date(1000*time);
        let seconds=weathers.timezone_offset;
        myDate.setSeconds(myDate.getSeconds() + seconds);
        arrayDates.push(myDate.toString().slice(4,21));
        arrayTemps.push(temp);
        //console.log(myDate.toString().slice(4,21));
    }
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: arrayDates,
            datasets: [
                {
                    data: arrayTemps
                }
            ]
        }
    });
    console.log(arrayW);
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


let inputTask = document.getElementById('city');
let task = document.getElementById('cities');

function createNewElement(task) {
    let listItem = document.createElement('li');
    listItem.className = "list-group-item listElement";
    let label = document.createElement('label');
    label.innerText = task;
    let deleteButton = document.createElement('button');
    deleteButton.className = "btn btn-primary btn-sm";
    deleteButton.innerText = "Delete";
    deleteButton.onclick = function () {
        deleteButton.parentElement.remove()
        save();
    };
    listItem.appendChild(label);
    listItem.appendChild(deleteButton);
    return listItem;
}

(function() {
    document.querySelector('input').addEventListener('keydown', function(e) {
        if (e.keyCode === 13) {
            getResults(inputTask.value).then(weather=>{
                    if(weather) {
                        lan = weather.coord.lon;
                        lat = weather.coord.lat;
                        displayResults(weather);
                        getWeather();

                    }
                }
            );
            let listItem = createNewElement(inputTask.value);
            task.appendChild(listItem);
            inputTask.value = "";
            save();
            alert("hello");
        }
    });
})();

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
