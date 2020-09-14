$(document).ready(function (){
    document.getElementById('tab-btn1').addEventListener('click', function (){
        showPanel(0, '#dee3e8');
    });

    document.getElementById('tab-btn2').addEventListener('click', function (){
        showPanel(1, '#dee3e8');
    });

    document.getElementById('tab-btn3').addEventListener('click', function (){
        showPanel(2, '#dee3e8');
    });

    let tabButtons = document.querySelectorAll('.tabs .buttonContainer button');

    let tabPanels = document.querySelectorAll('.tabs .tabPanel');

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
});