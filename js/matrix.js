/**
 * Created by Subhashis on 09-02-2017.
 */
var c = document.getElementById("seminar_canvas");
var ctx = c.getContext("2d");
var not_started=true;

//making the canvas full screen
// c.height = window.innerHeight;
// c.width = window.innerWidth;
// console.log($(c).parent());
c.height=$(c).parent().parent().height();
c.width=$(c).parent().parent().width();

//matrixText characters - taken from the unicode charset
var matrixText ="ARTIFICIALINTELLIGENCEMACHINELEARNINGCONVOLUTION2017SEMINARMODERNSCIENCEFUTUREOFAICOMPUTATIONNEUROSCIENCELIMITSOFCOMPUTATIONCOGNITIVESCIENCEHIGHENERGYPHYSICS";// "田由甲申甴电甶男甸甹町画甼甽甾甿畀畁畂畃畄畅畆畇畈畉畊畋界畍畎畏畐畑";
//converting the string into an array of single characters
matrixText = matrixText.split("");

var font_size = 10;
var columns = c.width/font_size; //number of columns for the rain
//an array of drops - one per column
var drops = [];
//x below is the x coordinate
//1 = y co-ordinate of the drop(same for every drop initially)
for(var x = 0; x < columns; x++)
    drops[x] = 1;
// var fontColors="#0F0 #09F #F00 #E90".split(" ");
//
// var counter=0;
// var colorPosition=0;
function draw()
{
    if(not_started) return;
    ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
    ctx.fillRect(0, 0, c.width, c.height);
    // if(counter>100000) {
    //     counter=0;
    //     ctx.fillStyle=colorPosition[colorPosition++%colorPosition.length];
    // }
    ctx.fillStyle = "#0F4";

    ctx.font = font_size + "px arial";
    //looping over drops
    for(var i = 0; i < drops.length; i++)
    {
        var text = matrixText[Math.floor(Math.random()*matrixText.length)];
        ctx.fillText(text, i*font_size, drops[i]*font_size);

        if(drops[i]*font_size > c.height && Math.random() > 0.975)
            drops[i] = 0;
        drops[i]++;
    }
}
setTimeout(function () {
    setInterval(draw, 33);
},0);
function matrixStart(){
    not_started=false;
}