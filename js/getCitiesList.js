const api={key:"7a7b4325b0cdbb4e8bc97d4c5138c58d", baseurl:"https://api.openweathermap.org/data/2.5/"}
let task = document.getElementById('citiesList');
let searchbox = document.getElementById('addCityInput');

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

function setQuery() {
    getResults(searchbox.value).then(weather => {
        if (weather.cod == "200") {
            if (JSON.parse(localStorage.getItem('todo')).task.includes(searchbox.value.toLowerCase().capitalize()) === false) {
                let listItem = createNewElement(searchbox.value);
                task.appendChild(listItem);
                searchbox.value = "";
                save();
            } else {
                searchbox.value = "";
            }
        } else {
            searchbox.value = "";
            alert("Niestety nie mamy pogody dla tego miasta, albo błędnie wpisałeś nazwę miasta");
        }
    });

}

async function getResults(query) {
    const response = await fetch(`${api.baseurl}weather?q=${query}&units=metric&APPID=${api.key}&lang=pl`);
    const weather  = await response.json();
    console.log(weather.cod);
    return weather;
}

function createNewElement(task) {
    let listItem = document.createElement('li');
    listItem.className = "list-group-item listElement";
    let label = document.createElement('label');
    label.className = "changeCity";
    label.innerText = task.toLowerCase().capitalize();
    let deleteButton = document.createElement('button');
    deleteButton.className = "btn btn-primary btn-sm deleteButton";
    deleteButton.innerText = "Delete";
    deleteButton.onclick = function () {
        deleteButton.parentElement.remove()
        save();
    };
    listItem.appendChild(label);
    listItem.appendChild(deleteButton);
    return listItem;
}

function save() {

    let taskArr = [];

    for (let i = 0; i < task.children.length; i++) {
        taskArr.push(task.children[i].getElementsByTagName('label')[0].innerText.toLowerCase().capitalize());
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