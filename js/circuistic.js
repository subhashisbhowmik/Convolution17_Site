/**
 * Created by Subhashis on 31-01-2017.
 */
var $multi=$('#multitext');
function multimeter() {
    $multi.text((3.43+Math.random()/5).toString().substr(0,4));
    setTimeout(function () {
        multimeter();
    },500+1500*Math.random());
}

var data = [],
    totalPoints = 300;
var updateInterval = 30;
function getRandomData() {

    if (data.length > 0)
        data = data.slice(1);

    // Do a random walk

    while (data.length < totalPoints) {

        var prev = data.length > 0 ? data[data.length - 1] : 50,
            y = prev + Math.random() * 10 - 5;

        if (y < 0) {
            y = 0;
        } else if (y > 100) {
            y = 100;
        }

        data.push(y);
    }

    // Zip the generated y values with the x values

    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
    }

    return res;
}
var t=1;

function getData() {

    if (data.length > 0)
        data = data.slice(1);

    // Do a random walk

    while (data.length < totalPoints) {
        var y=5*Math.sin(2*Math.PI*0.5*t)-Math.sin(6*Math.PI*0.5*t)+0.5*Math.sin(10*Math.PI*0.5*t);
        data.push(y);
        t+=0.01;
    }

    // Zip the generated y values with the x values

    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
    }

    return res;
}

var plot = $.plot("#oscillograph",  [ getData()], {
    colors: ['#11eeb1'],
    series: {
        shadowSize: 0	// Drawing is faster without shadows
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

    plot.setData([getData()]);

    // Since the axes don't change, we don't need to call plot.setupGrid()

    plot.draw();
    setTimeout(osc_update, updateInterval);
}