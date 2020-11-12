class Advertisement {
    constructor(
        name,
        id,
        description,
        image,
        link,
        tag,
    ) {
        this.name = name;
        this.id = id;
        this.description = description;
        this.image = image;
        this.link = link;
        this.tag = tag;
    }
}

const Tag = {
    COLD: 'COLD',
    HOT: 'HOT',
    RAIN: 'RAIN',
}

const advertisements = [
    new Advertisement('Ad1', 1, 'zimno? kup sweter', "./img/ads/cold.jpeg", null, Tag.COLD),
    new Advertisement('Ad2', 2, 'ciepło? zjedz loda', "./img/ads/hot.jpeg", null, Tag.HOT),
    new Advertisement('Ad3', 3, 'zimno? brrrrrrr', "./img/ads/cold.jpeg", null, Tag.COLD),
    new Advertisement('Ad4', 4, 'ale mróz!', "./img/ads/cold.jpeg", null, Tag.COLD),
    new Advertisement('Ad5', 5, 'kap kap kap', "./img/ads/rain.jpeg", null, Tag.RAIN),
    new Advertisement('Ad6', 6, 'pada? kup parasol', "./img/ads/rain.jpeg", null, Tag.RAIN),
    new Advertisement('Ad7', 7, 'zapraszam na lody', "./img/ads/hot.jpeg", null, Tag.HOT),
    new Advertisement('Ad8', 8, 'daj się ochłodzić', "./img/ads/hot.jpeg", null, Tag.HOT),
    new Advertisement('Ad9', 9, 'deszcz za oknami', "./img/ads/rain.jpeg", null, Tag.RAIN),
    new Advertisement('Ad10', 10, 'zmokłeś?', "./img/ads/rain.jpeg", null, Tag.RAIN),
];

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

function ad(tag) {
    let filtered = advertisements.filter((i) => {
        return i.tag === tag;
    });
    let randomIndex = Math.floor(Math.random() * filtered.length);
    return filtered[randomIndex];
}

function createAdvertisementHTML(advertisement) {
    let element = document.createElement("div");
    let elementInner = document.querySelector("#advertisementTemplate").content.cloneNode(true);
    element.append(elementInner);

    let image = element.querySelector(".image");
    image.src = advertisement.image;
    let desc = element.querySelector(".desc");
    desc.innerText = advertisement.description;
    let title = element.querySelector(".title");
    title.innerText = advertisement.name;

    return element;
}

function displayAd(weather) {
    let adElements = document.querySelectorAll(".advertisement");
    adElements.forEach((i) => {
        if (i.children[0]) {
            i.children[0].remove();
        }
        i.append(createAdvertisementHTML(ad(getTag(weather))));

    })
}
