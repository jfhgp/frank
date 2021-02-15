$(document).ready(function () {
    // let res = [];

    $.ajax({
        async: false,
        url: '../modules/frank/ajax/statics.php',
        method: 'get',
        success: function (response) {
            response = JSON.parse(response);
            if (response.status === 200) {
                document.getElementById('last-week').innerText = response.summary.lastWeek[0].count;
                document.getElementById('last-two-week').innerText = response.summary.lastTwoWeek[0].count;
                document.getElementById('last-month').innerText = response.summary.lastMonth[0].count;
            }
            // response = response.detail.lastMonth;
            // res.push(response);
        }
    });

    // console.log(res);

    trigger = (data) => {
        let ress = [];
        $.ajax({
            async: false,
            url: '../modules/frank/ajax/statics.php',
            method: 'get',
            success: function (response) {
                response = JSON.parse(response);
                if (response.status === 200) {
                    response = response.detail[data];
                    ress.push(response);
                }
            }
        });

        console.log(ress);
        ress = ress[0];

        let options1 = {
            animationEnabled: true,
            axisX: {
                labelFormatter: function (e) {
                    return CanvasJS.formatDate(e.value, "DD MMM");
                }
            },
            axisY: {
                labelFontSize: 14
            },

            data: [{
                type: "spline",
                dataPoints: []
            }]
        };

        for (let i = 0; i < ress.length; i++) {
            options1.data[0].dataPoints.push({x: new Date(ress[i].date), y: ress[i].cnt});
        }

        $("#tabs").tabs({
            create: function (event, ui) {
                $("#chartContainer1").CanvasJSChart(options1);
            },
            activate: function (event, ui) {
                ui.newPanel.children().first().CanvasJSChart().render();
            }
        });
    }
    trigger('lastMonth');

    // document.getElementById('week').addEventListener('click', function () {
    //     trigger('lastWeek');
    // });
    // document.getElementById('two-week').addEventListener('click', function () {
    //     trigger('lastTwoWeek');
    // });
    // document.getElementById('month').addEventListener('click', function () {
    //     trigger('lastMonth');
    // });
});

