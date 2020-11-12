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
