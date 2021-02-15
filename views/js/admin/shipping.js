$(document).ready(function () {
    document.getElementById('tab-btn1').addEventListener('click', function (){
        showPanel(0, '#dee3e8');
    });

    document.getElementById('tab-btn2').addEventListener('click', function (){
        showPanel(1, '#dee3e8');
    });

    document.getElementById('tab-btn3').addEventListener('click', function (){
        showPanel(2, '#dee3e8');
    });

    document.getElementById('tab-btn4').addEventListener('click', function (){
        showPanel(3, '#dee3e8');
    });

    let tabButtons = document.querySelectorAll('.tabs-container .buttonContainer button');

    let tabPanels = document.querySelectorAll('.tabs-container .tabPanel');

    function showPanel(panelIndex, colorCode) {
        tabButtons.forEach(function(node){
            node.style.backgroundColor = "";
            node.style.color = "";
        });
        // tabButtons[panelIndex].style.backgroundColor = colorCode;
        tabButtons[panelIndex].style.color = '#ee6931';

        tabPanels.forEach(function(node){
            node.style.display = 'none';
        });

        tabPanels[panelIndex].style.display = 'block';
        tabPanels[panelIndex].style.backgroundColor = colorCode;
    }

    showPanel(0, '#dee3e8');

    $('.pencil').on('click', function (){
        let page = $(this).attr('data-target');
        let id = $(this).attr('data-id');
        // console.log(id);
        $.ajax({
            async: false,
            url: '../modules/frank/ajax/orderDetailsAjax.php',
            method: 'POST',
            data: {_id: id},
            success: function (response) {
                console.log(response);
            }
        });
    });

    // Searching -------------------------------------------------------------------------------------------------------------------------------------------------------

    $("#txt-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#search-pending tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#txt-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#search-shipped tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#txt-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#search-cancelled tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Searching End ........................................................................................................................................................

    $('.upload').on('click', function (){
        document.getElementById('main-page-id').classList.remove('container-main-page-active');
        document.getElementById('upload-page-id').classList.add('container-upload-page-active');
    });
    $('.upload-cancel-btn').on('click', function (){
        document.getElementById('upload-page-id').classList.remove('container-upload-page-active');
        document.getElementById('main-page-id').classList.add('container-main-page-active');
    });
});
