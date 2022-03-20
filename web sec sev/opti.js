
var result;
var rsave=+window.localStorage.getItem(3);
option =function(){
var r=+window.localStorage.getItem(3);
var r1=+window.localStorage.getItem(2);
var r2=+window.localStorage.getItem(1);
if(Math.abs(r-r1)<3){
    rsave=r;
    result=r;}
else{
    result=rsave;
}
window.localStorage.setItem('opt',result);
}
var warn_sound = new Audio('warning_into_z.wav');
var alert_sound = new Audio('alert_sound.wav');
var alerte=-58;
var delta_alerte=5;
var warn=-64;
var delta_warn=4;
var timenext;
box_state=function(){
    if(window.localStorage.getItem('opt')>=(alerte-delta_alerte)){
        if($('#capt_state').css("background-color")!='rgb(255, 0, 0)'){
            $('#capt_state').css("background-color", "red");
            $('#capt_state').html('<i class="bx bxs-radiation bx-burst" id="att_imag"></i>')
            alert_sound.play();
            timenext=Math.floor(Date.now() / 1000)+2;
        }
            if(Math.floor(Date.now() / 1000)>timenext){
                alert_sound.play();
                timenext=Math.floor(Date.now() / 1000)+2;
            }
        
        else{
    }
}
    else if(window.localStorage.getItem('opt')>=warn-delta_warn){
        if($('#capt_state').css("background-color")!='rgb(255, 255, 0)'){
        $('#capt_state').css("background-color", "yellow");
        $('#capt_state').html('<i class="bx bx-error bx-tada" id="war_imag"></i>'); 
        warn_sound.play();
        timenext=Math.floor(Date.now() / 1000)+2;
    }
    if(Math.floor(Date.now() / 1000)>timenext){
        warn_sound.play();
        timenext=Math.floor(Date.now() / 1000)+2;
    }
        else{
    }
}
    else {
        if($('#capt_state').css("background-color")!='rgb(0, 128, 0)')
        {
        $('#capt_state').css("background-color", "green");
        $('#capt_state').html('<i class="bx bx-wink-tongue bx-spin" id="good_imag" ></i>');
       }
        else{

        }
    }
}

var auto_refresh = setInterval(
    (function () {
        $('#table_data').load("esp-datavcode.php");  //Load the content into the div
        option();
        $('#opt').html(Math.round(result));
        box_state();
        
    })
    , 190);
    
