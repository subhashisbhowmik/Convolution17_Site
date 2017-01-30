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