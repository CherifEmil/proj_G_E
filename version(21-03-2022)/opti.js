var warn_sound = new Audio('warning_into_z.wav');
var alert_sound = new Audio('alert_sound.wav');
var no_signal_sound= new Audio('no_signal_sound.wav');

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

var alerte=-60;
var delta_alerte=2;
var warn=-70;
var delta_warn=2;
var timenext;
box_state=function(){

    if(window.localStorage.getItem('opt')==0){
        if($('#capt_state').css("background-color")!='rgb(255, 255, 254)'){
            $('#capt_state').css("background-color", 'rgb(255, 255, 254)');
            $('#capt_state').html('<i class="bx bx-wifi-off bx-tada" id="i_no_signal" ></i>');
            no_signal_sound.play();
            timenext=Math.floor(Date.now() / 1000)+2;
        }
            if(Math.floor(Date.now() / 1000)>timenext){
                no_signal_sound.play();
                timenext=Math.floor(Date.now() / 1000)+2;
            }
        
        else{
    }
    }

    else{
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
}

var auto_refresh = setInterval(
    (function () {
        $('#table_data').load("esp-datavcode.php");  //Load the content into the div
        $('#run_code').load("./admin_parm_data.php");
        option();
        $('#opt').html(Math.round(result));
        box_state();
         if( (parseInt(window.localStorage.getItem("c_rssi"))) != (parseInt(window.localStorage.getItem("o_c_rssi")))
        ||(parseInt(window.localStorage.getItem("r_rssi"))) != (parseInt(window.localStorage.getItem("o_r_rssi")))
        ||(parseInt(window.localStorage.getItem("c_jrssi"))) != (parseInt(window.localStorage.getItem("o_c_jrssi")))
        ||(parseInt(window.localStorage.getItem("r_jrssi"))) != (parseInt(window.localStorage.getItem("o_r_jrssi")))){
            $("#nb_crit_alert").val(window.localStorage.getItem("c_rssi"));
            $("#nb_incert_crit_alert").val(window.localStorage.getItem("r_rssi"));
            $("#nb_crit_war").val(window.localStorage.getItem("c_jrssi"));
            $("#nb_incert_crit_war").val(window.localStorage.getItem("r_jrssi"));
            localStorage.setItem("o_c_rssi",window.localStorage.getItem("c_rssi"));
            localStorage.setItem("o_r_rssi",window.localStorage.getItem("r_rssi"));
            localStorage.setItem("o_c_jrssi",window.localStorage.getItem("c_jrssi"));
            localStorage.setItem("o_r_jrssi",window.localStorage.getItem("r_jrssi"));
                        
             alerte=window.localStorage.getItem("c_rssi");
             delta_alerte= window.localStorage.getItem("r_rssi");
             warn= window.localStorage.getItem("c_jrssi");
             delta_warn=window.localStorage.getItem("r_jrssi");
        }
        else{
            
        }
        
    })
    , 190);
    
///////click button
document.querySelector('#set_Param'). onclick=function() {

    var data6= {
        api_key:document.getElementById('admin_api_key').value,
        table:"pram_admi",
        admin_id:document.getElementById('admin_api_key').value,
        admin_comment:"5",
        c_rssi :document.getElementById('nb_crit_alert').value,
        r_rssi: document.getElementById('nb_incert_crit_alert').value,
        c_jrssi :document.getElementById('nb_crit_war').value,
        r_jrssi:document.getElementById('nb_incert_crit_war').value
    }
    $.ajax({
        type : "POST",  //type of method
        url  : 'post_parm_admin.php',  //your page
        data : data6,// passing the values
        success: function(res){  
                                //do what you want here...
                }
    });
    $('#input_d').append('admin_parm_data.php');
  };