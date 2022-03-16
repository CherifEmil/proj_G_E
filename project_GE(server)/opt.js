
var result;
option =function(){
var r=+window.localStorage.getItem(3);
var r1=+window.localStorage.getItem(2);
var r2=+window.localStorage.getItem(1);

if(r==r1 && r1==r2){
    result=r1;}
else{
    result=Math.round(r-(Math.pow((r1-r),2)/(r2-2*r1+r)));
}
window.localStorage.setItem('opt',result);
}

var auto_refresh = setInterval(
    (function () {
        $('#table_data').load("esp-datavcode.php");  //Load the content into the div
        option();
        $('#opt').html(Math.round(result));
    })
    , 1000);
    
