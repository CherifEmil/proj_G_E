const utl='http://10.0.0.157:80/project/project_GE/post-esp-data.php';
const data5= {
    api_key:"tPmAT5Ab3j7F9",
    table:"esp32_1",
    sensor:"7",
    ip:"5",
    value1:"7",
    value2:"7"
}
/*p=function(){
    $.post(utl,data,function(data,statue){
        console.log(`${data} status is ${statue}`)
    })
}*/
$.ajax({
    type : "POST",  //type of method
    url  : 'post-esp-data.php',  //your page
    data : data5,// passing the values
    success: function(res){  
                            //do what you want here...
            }
});
