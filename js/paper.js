/**
 * Created by Subhashis on 09-02-2017.
 */
var papierGone=false;
var papierDetails=" By 2029, computers will have emotional intelligence and be convincing as people' -Ray Kurzweil,computer scientist. These advancements are possible with quality research works and innovative ideas.\nHave you performed any interesting experiment or do you have any such idea? Have you made any new model or prototypes?\nThis year Convolution 4.0, organised by Department of Electrical Engineering, Jadavpur University brings you a brand new event of Paper Presentation/Power Point Presentation. We encourage you to take part in this exciting event and place your innovative ideas.\nMake a write-up of 400 words about your own idea/experiments/prototypes and mail us at pconvolution@gmail.com on or before 20th February.\nNotification of selection for final: 25th February.";
var buffer="";
var posi=0;

function papierGo() {
    if(papierGone) return;
    papierGone=true;
    var $papier=$('#papier');
    var $header=$papier.find('#header');
    $header.find('div').removeClass('hide');
    console.log($header);
    setTimeout(function () {
        $header.find('#convo_papier').removeClass('hide');
    },400);
    setTimeout(function () {
        $header.find('#contacts_papier').removeClass('hide');
    },600);
    setTimeout(function () {
        $papier.find('#left').removeClass('hide');
        $papier.find('#right').removeClass('hide');
    },800);

    setTimeout(papier,1000);
}
function papier() {
    papierType(papierDetails);

}

function papierType(s) {
    buffer=s;
    posi=0;
    pbufferType();

}


 function pbufferType() {
//     var x=buffer.charAt(posi++);
//     // buffer=buffer.substr(1);
    var $left=$('#left');
    $left.html(buffer.substring(0,x+1));
    if(buffer.length>posi){
        setTimeout(pbufferType,10);
    }
}