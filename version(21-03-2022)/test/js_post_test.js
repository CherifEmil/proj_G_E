const utl='http://10.0.0.157:80/project/project_GE/post-esp-data.php';
const data5= {
    api_key:"tPmAT5Ab3j7F9",
    table:"esp32_1",
    sensor:"7",
    ip:"5",
    value1:"7",
    value2:"7"
}
var data6= {
    api_key:"lecherifamine",
    table:"pram_admi",
    admin_id:"7",
    admin_comment:"5",
    c_rssi :"7",
    r_rssi:"7",
    c_jrssi :"7",
    r_jrssi:"7"
}
/*p=function(){
    $.post(utl,data,function(data,statue){
        console.log(`${data} status is ${statue}`)
    })
}*/
$.ajax({
    type : "POST",  //type of method
    url  : 'post_parm_admin.php',  //your page
    data : data6,// passing the values
    success: function(res){  
                            //do what you want here...
            }
});
if((parseInt(window.localStorage.getItem("c_rssi"))!= '. $c_rssi .')
        ||(parseInt(window.localStorage.getItem("r_rssi"))!= '. $r_rssi .')
        ||(parseInt(window.localStorage.getItem("c_jrssi"))!= '. $c_jrssi .')
        ||(parseInt(window.localStorage.getItem("r_rssi"))!= '. $r_jrssi .')){

        }

        echo(
            '<script>  
            var alerte=0;
            var delta_alerte=0;
            var warn=0;
            var delta_warn=0;
            if((parseInt(window.localStorage.getItem("c_rssi")) != '. $c_rssi .')
            ||(parseInt(window.localStorage.getItem("r_rssi")) != '. $r_rssi .')
            ||(parseInt(window.localStorage.getItem("c_jrssi")) != '. $c_jrssi .')
            ||(parseInt(window.localStorage.getItem("r_rssi")) != '. $r_jrssi .')){
                         localStorage.setItem("admin_id",'. $admin_id . ');
                        localStorage.setItem("admin_comment",'. $admin_comment .');
                        localStorage.setItem("c_rssi",'. $c_rssi .');
                        localStorage.setItem("r_rssi",'. $r_rssi  .');
                        localStorage.setItem("c_jrssi",'. $c_jrssi .');
                        localStorage.setItem("r_jrssi" ,'. $r_jrssi .');
                        
             alerte='. $c_rssi .';
             delta_alerte= '. $r_rssi .';
             warn= '. $c_jrssi .';
             delta_warn='. $r_jrssi .';
            }
            else{
    
            }
            </script>
            ');