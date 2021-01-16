$(document).ready(function (){
    $('table tbody tr').click(function (){
        let dataArray = ($(this).text()).split("\n");

        let id = $.trim(dataArray["1"]);
        let username = $.trim(dataArray["2"]);
        let firstName = $.trim(dataArray["3"]);
        let email = $.trim(dataArray["4"]);


    });
});


