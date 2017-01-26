/**
 * Created by Subhashis on 24-01-2017.
 */
$console = $('#console');
var algomaniac =
"<br><div style='white-space: pre'>           d8888 888       .d8888b.   .d88888b.  888b     d888        d8888 888b    888 8888888        d8888  .d8888b.<br>" +
"          d88888 888      d88P  Y88b d88P\" \"Y88b 8888b   d8888       d88888 8888b   888   888         d88888 d88P  Y88b<br>\
         d88P888 888      888    888 888     888 88888b.d88888      d88P888 88888b  888   888        d88P888 888    888<br>\
        d88P 888 888      888        888     888 888Y88888P888     d88P 888 888Y88b 888   888       d88P 888 888<br>\
       d88P  888 888      888  88888 888     888 888 Y888P 888    d88P  888 888 Y88b888   888      d88P  888 888<br>\
      d88P   888 888      888    888 888     888 888  Y8P  888   d88P   888 888  Y88888   888     d88P   888 888    888<br>\
     d8888888888 888      Y88b  d88P Y88b. .d88P 888   \"   888  d8888888888 888   Y8888   888    d8888888888 Y88b  d88P<br>\
    d88P     888 88888888  \"Y8888P88  \"Y88888P\"  888       888 d88P     888 888    Y888 8888888 d88P     888  \"Y8888P\"</div><br>";

var algo_details = "Coding has never been so awesome before. So you think you can tame an wild territory of algorithms, data structure and AI techniques under shortage of time and space? Then this is the place you deserve! What's more? This year, the format ensures that you get to battle it out with the bests even if you call yourself a novice (we know you aren't). So get ready to become the maniac! <br><a style='margin:0 auto' href='./'>Click here to register</a> <br>Contact: Anisha Bannerjee- +91 9474656643";
var python27 = "Python 2.7.12 (default, Jul  1 2016, 15:12:24)<br>    [GCC 5.4.0 20160609] on linux2<br>Type \"help\", \"copyright\", \"credits\" or \"license\" for more information.<br><br>";
var algo_prizes = "{'1st':'10000.00','2nd':'6000.00','3rd':'4000.00'}<br>";
var convoRoot="<br><div style='display:inline-block;color:#eb3d3d'>root</div>@<div style='display:inline-block;color:#6e9ff9'>Convolution17</div># ";
var typing = false;
var buffer = "";
var realbuffer = "";
var totlen = 0;
function con_print(s,i) {
    setTimeout(function () {
        $console.html($console.html() + "<br><div class=\"consoleprint\">" + s + "</div>");
        loop(i+1);
    },50);
}

function bufferType(s,i) {
    typing = true;
    $console.html($console.html() + buffer[0]);
    buffer = buffer.substr(1);
    if (buffer.length > 0) {
        setTimeout(function () {
            bufferType(s,i);
        }, 50+Math.random()*200);
    } else {
        $console.html($console.html().substr(0, $console.html().length - totlen) + "<div class=\"consoletext\" style=\"color:" + s + "\">" + realbuffer + "</div>");
        typing = false;
        setTimeout(function () {
            loop(i+1);
        },0);
    }
}

function con_type(s, color,i) {
    // if (typing) {
    //     setTimeout(function () {
    //         con_type(s, color);
    //     },500);
    // } else {
        buffer = s + " ";
        realbuffer = buffer;
        totlen = buffer.length;
    setTimeout(function () {
        bufferType(color,i);

    },200);

    // }
    // for (var i=0;i<s.length;i++){
    //     $console.html($console.html()+s[i]+" ");
    //     wait(100);
    // }
    // $console.html($console.html()+" ");
}

function con_clear() {

    setTimeout(function () {
        $console.html("");
        loop(0);
    },100);
}


function loop(i) {
    if(i==0)con_print(convoRoot,i);
    else if(i==1)con_type("python", "white",i);
    else if(i==2)con_print(python27,i);
    else if(i==3)con_print(">>> ",i);
    else if(i==4)con_type("from", "orange",i);
    else if(i==5)con_type("convolution", "white",i);
    else if(i==6)con_type("import", "orange",i);
    else if(i==7)con_type("algomaniac", "white",i);
    else if(i==8)con_print("<br>>>> ",i);
    else if(i==9)con_type("print", "orange",i);
    else if(i==10)con_type("algomaniac", "white",i);
    else if(i==11)con_print(algomaniac,i);
    else if(i==12)con_print(">>> ",i);
    else if(i==13)con_type("print", "orange",i);
    else if(i==14)con_type("details", "white",i);
    else if(i==15)con_print(algo_details,i);
    else if(i==16)con_print("<br>>>> ",i);
    else if(i==17)con_type("print", "orange",i);
    else if(i==18)con_type("prizes", "white",i);
    else if(i==19)con_print(algo_prizes,i);
    else if(i==20)con_print("<br>>>> ",i);
    else if(i==21)con_type("exit", "orange",i);
    else if(i==22)con_type("()", "yellow",i);
    else if(i==23)con_print(convoRoot,i);
    // else if(i==24)con_type("clear", "white",i);
    // else if(i==25)con_clear();
}
//
// function wait(ms) {
//     var start = Date.now(),
//         now = start;
//     while (now - start < ms) {
//         now = Date.now();
//     }
// }





