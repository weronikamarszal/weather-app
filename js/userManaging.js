$(document).ready(function (){
    $('table tbody tr').click(function (){
        let dataArray = ($(this).text()).split("\n");

        let id = $.trim(dataArray["1"]);
        let username = $.trim(dataArray["2"]);
        let firstName = $.trim(dataArray["3"]);
        let email = $.trim(dataArray["4"]);


    });
});

function tableSearch(){
    let phrase = document.getElementById('search-text');
    let table = document.getElementById('table');
    let regPhrase = new RegExp(phrase.value, 'i');
    let flag = false;
    for (let i = 1; i < table.rows.length; i++) {
        flag = false;
        for (let j = table.rows[i].cells.length - 1; j >= 0; j--) {
            flag = regPhrase.test(table.rows[i].cells[j].innerHTML);
            if (flag) break;
        }
        if (flag) {
            table.rows[i].style.display = "";
        } else {
            table.rows[i].style.display = "none";
        }

    }
}


