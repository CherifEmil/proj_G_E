<!DOCTYPE html>
<html>
  <head>
      <title>sensor</title>
      <link rel="stylesheet" href="./style1.css">
      <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
      <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  </head>
<body>
</div>
<div id="sect_1">
<div id="cont1">
  <div id="input_d">
          <label for="nb_crit_alert">RSSI critique pour l'allert:</label>
          <br><input type="number" id="nb_crit_alert" ><br><br>
          <label for="nb_incert_crit_alert">Incertitude de cette allerte:</label>
          <br><input type="number" id="nb_incert_crit_alert"><br><br>
          <label for="nb_crit_war">RSSI critique pour la zone jaune:</label>
          <br><input type="number" id="nb_crit_war"><br><br>
          <label for="nb_incert_crit_war">Incertitude de la zone jaune:</label>
          <br><input type="number" id="nb_incert_crit_war"><br><br>
          <label for="admin_api_key">Admin ID:</label>
          <br><input type="text" id="admin_api_key"><br><br>
          <button id="set_Param">Changer les paramètres</button>
</div>
       <div id="table_data"></div> 
              <div id="optdiv">
                  <h1>Optimisation des mesures:</h1><h4 id="opt" ></h4>
              </div>
</div>
<div id="run_code"></div>
       
<div id="graphic"> <canvas id="myChart"></canvas></div >
<div id="graphic_w"> <canvas id="myChart_w"></canvas></div>
</div>
<div id="sect_2">
  <div id="capt_state">
  </div>
</div>
<div id="réglage"><i class='bx bxs-brightness bx-spin bx-flip-vertical' id="i_réglage" ></i></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var labels = ['','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',
      
    ];
  
    var data = {
      labels: labels,
      datasets: [{
        label: 'rssi de mes capteurs',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ],
      },{
        label: 'optimisation des mesures',
        backgroundColor: 'rgb(69, 197, 75)',
        borderColor: 'rgb(69, 197, 75)',
        data: [, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ],
      }]
    };
    var data1 = {
      labels: labels,
      datasets: [{
        label: 'Wifi rssi',
        backgroundColor: 'rgb(30,144,255)',
        borderColor: 'rgb(30,144,255)',
        data: [, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ],
      }]
    };
  
    var config = {
      type: 'line',
      data: data,
      options: {}
    };
    var config_w = {
      type: 'line',
      data: data1,
      options: {}
    };
    
  
    var myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    var myChart_w = new Chart(
      document.getElementById('myChart_w'),
      config_w
    );
    setInterval(
    (function () {
      if(labels[labels.length-1]!=parseInt(window.localStorage.getItem(1001))){
    labels.shift();
    labels.push(Math.abs(window.localStorage.getItem(1001)));
    data.datasets[0].data.shift();
    data.datasets[0].data.push(window.localStorage.getItem(1));
    data.datasets[1].data.shift();
    data.datasets[1].data.push(window.localStorage.getItem('opt'));
    data1.datasets[0].data.shift();
    data1.datasets[0].data.push(window.localStorage.getItem(2001));
    myChart.update();
    myChart_w.update();
    
      }
        
    })
    , 190);
  </script>
<script src="./opti.js"></script>
<!--<script src="./slide_B.js"></script>-->
</html>