/**
 * Created by Subhashis on 13-02-2017.
 */
var data1 = [];
var data2 = [];
var plot1, plot2;
$(document).ready(function () {
    var $tables = $('table');
    $tables.eq(0).find('tr').each(function () {
        var $tds = $(this).find('td');
        data1.push([$tds.eq(0).text(), $tds.eq(1).text()]);
    });
    data1.shift();
    console.log(data1);
    $tables.eq(0).find('tr').each(function () {
        var $tds = $(this).find('td');
        data2.push([$tds.eq(0).text(), $tds.eq(1).text()]);
    });
    data2.shift();

    console.log(data2);
});

$(window).on('load resize', function () {
    // alert();var
    plot1 = $.plot("#plot1", [data1], {
        series: {
            shadowSize: 1,	// Drawing is faster without shadows
            lines: {
                show: true,
                fill: false,
            },
            points: { show: true }

        },
        yaxis: {
            min: 0,
            minTickSize: 1
        },
        xaxis: {
            show: true,
            minTickSize: 1
        }
    });
    plot2 = $.plot("#plot2", [data2], {
        series: {
            shadowSize: 1,	// Drawing is faster without shadows
            lines: {
                show: true,
                fill: false,
            },
            points: { show: true }

        },
        yaxis: {

            minTickSize: 1,
            min: 0
        },
        xaxis: {

            minTickSize: 1,
            show: true
        }
    });
    console.log(plot1);
    plot1.draw();
    plot2.draw();

});
