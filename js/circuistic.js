/**
 * Created by Subhashis on 31-01-2017.
 */
$(window).on('load', function () {
    $(window).resize(function () {
        // alert();var
        plot = $.plot("#oscillograph", getSeriesObj(), {
            colors: ['#11eebc1', '#11febc1'],
            series: {
                shadowSize: 0,	// Drawing is faster without shadows
                lines: {
                    show: true,
                    fill: false,
                }

            },
            yaxis: {
                min: -10,
                max: 10
            },
            xaxis: {
                show: true
            }
        });
    });
});
var $multi = $('#multitext');
function multimeter() {
    $multi.text((3.43 + Math.random() / 5).toString().substr(0, 4));
    setTimeout(function () {
        multimeter();
    }, 500 + 1500 * Math.random());
}

var data = [], data2 = [],
    totalPoints = 300;
var updateInterval = 10;

var t = 1, t2 = 1.5;

function getData() {

    if (data.length > 0)
        data = data.slice(1);

    while (data.length < totalPoints) {
        var y = 5 * Math.sin(2 * Math.PI * 0.5 * t) - Math.sin(6 * Math.PI * 0.5 * t) + 0.5 * Math.sin(10 * Math.PI * 0.5 * t);
        data.push(y);
        t += 0.01;
    }

    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
    }

    return res;
}
function getData2() {

    if (data2.length > 0)
        data2 = data2.slice(1);

    while (data2.length < totalPoints) {
        var y = 5 * Math.sin(2 * Math.PI * 0.5 * t2 + Math.PI / 4) + Math.sin(6 * Math.PI * 0.5 * t2 + Math.PI * 3 / 2) + 0.5 * Math.sin(4 * Math.PI * 0.5 * t2 + Math.PI);
        data2.push(y);
        t2 += 0.01;
    }

    var res = [];
    for (var i = 0; i < data2.length; ++i) {
        res.push([i, data2[i]])
    }

    return res;
}
function getSeriesObj() {
    return [
        {
            data: getData(),
            lines: {show: true, fill: false}
        }, {
            data: getData2(),
            lines: {show: true, fill: false}
        }];
}
var plot = $.plot("#oscillograph", getSeriesObj(), {
    colors: ['#11eebc1', '#11febc1'],
    series: {
        shadowSize: 0,	// Drawing is faster without shadows
        lines: {
            show: true,
            fill: false,
        }

    },
    yaxis: {
        min: -10,
        max: 10
    },
    xaxis: {
        show: true
    }
});


function osc_update() {

    plot.setData(getSeriesObj());
    plot.getData()[1].lines.lineWidth = 3;
    plot.getData()[0].lines.lineWidth = 3;
    plot.draw();
    setTimeout(osc_update, updateInterval);
}