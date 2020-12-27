// let $table = $('#table')
let myTab = document.getElementById('table');

function clickTableRaw() {
//     // alert(JSON.stringify($table.bootstrapTable('getData')));
//     let objCells = myTab.rows.item(1).cells;
//     alert(objCells.item(1).innerHTML);
}

$(document).ready(function() {
    $(document).on("click", "#table tbody tr", function() {
        var data = $(this).closest('tr').attr('id');
        alert(data);
    });
});

