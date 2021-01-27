class Advertisement {
    constructor(
        name,
        id,
        description,
        more,
        picture,
        link,
        tag,
    ) {
        this.name = name;
        this.id = id;
        this.description = description;
        this.more = more;
        this.picture = picture;
        this.link = link;
        this.tag = tag;
        this.likesCount = 0;
    }
}

const Tag = {
    COLD: 'COLD',
    HOT: 'HOT',
    RAIN: 'RAIN',
}

function getTag(weather) {
    let tags = [];
    if (!weather) {
        return;
    }
    if (weather.main.temp <= 10) {
        tags.push(Tag.COLD);
    }
    if (weather.main.temp > 10) {
        tags.push(Tag.HOT);
    }
    if (weather.weather[0].main === "Drizzle" || weather.weather[0].main === "Rain") {
        tags.push(Tag.RAIN);
    }

    let randomIndex = Math.floor(Math.random() * tags.length);
    return tags[randomIndex];

}

function getDataFromDB() {
    return fetch(SERVER + 'weather-app/php/getAdvertisementWithUserLikes.php')
        .then((response) => {
            return response.json()
        })
        .catch(res => {
            console.error(res);
            return [];
        })
}

function ad(tag, adFromDB) {
    let filtered = adFromDB.filter((i) => {
        return i.tag === tag;
    });
    if (filtered.length === 0) {
        console.error(`brak reklamy z odpowiednim tagiem(${tag} )`)
    }
    let randomIndex = Math.floor(Math.random() * filtered.length);
    return filtered[randomIndex];
}

function createAdvertisementHTML(advertisement) {
    let element = document.createElement("div");
    let elementInner = document.querySelector("#advertisementTemplate").content.cloneNode(true);
    element.append(elementInner);

    let picture = element.querySelector(".advert-image");
    picture.src = advertisement.picture;

    let desc = element.querySelector(".desc");
    desc.innerText = advertisement.description;

    let title = element.querySelector(".title");
    title.innerText = advertisement.name;

    let likeButton = element.querySelector(".like");
    if (advertisement.likesCount > 0) {
        likeButton.setAttribute("disabled", true);
    }
    likeButton.addEventListener("click", () => {
        fun(advertisement.id)
            .then(() => {
                displayAd(pageWeather)
            });
    });
    return element;
}

let pageWeather;

function displayAd(weather) {
    pageWeather = weather;
    let adElements = document.querySelectorAll(".advertisement");
    getDataFromDB()
        .then((x) => {
            adElements.forEach((i) => {
                if (i.children[0]) {
                    i.children[0].remove();
                }
                i.append(createAdvertisementHTML(ad(getTag(weather), x)));
            })
        });
}

