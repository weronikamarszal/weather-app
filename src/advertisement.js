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
    new Advertisement('Ad1', 1, 'desc1', null, null, Tag.COLD),
    new Advertisement('Ad2', 2, 'desc2', null, null, Tag.HOT),
    new Advertisement('Ad3', 3, 'desc3', null, null, Tag.RAIN),
    new Advertisement('Ad4', 4, 'desc4', null, null, Tag.RAIN),
    new Advertisement('Ad5', 5, 'desc5', null, null, Tag.RAIN),
    new Advertisement('Ad6', 6, 'desc6', null, null, Tag.RAIN),
    new Advertisement('Ad7', 7, 'desc7', null, null, Tag.RAIN),
    new Advertisement('Ad8', 8, 'desc8', null, null, Tag.RAIN),
    new Advertisement('Ad9', 9, 'desc9', null, null, Tag.RAIN),
    new Advertisement('Ad10', 10, 'desc10', null, null, Tag.RAIN),
];

function getTag(weather) {
    let tags = [];
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
    console.log(tags[randomIndex])
    return tags[randomIndex];

}

function ad(tag) {
    let filtered = advertisements.filter((i) => {
        return i.tag === tag;
    });
    let randomIndex = Math.floor(Math.random() * filtered.length);
    return filtered[randomIndex];
}

function displayAd(weather) {
    let htmlElement = document.getElementById("advertisement");
    htmlElement.innerText = ad(getTag(weather)).name;
    console.log(weather);
}

displayAd();

