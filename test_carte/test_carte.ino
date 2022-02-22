#include <WiFi.h>
#include <WiFiClient.h>
#include <HTTPClient.h>
#define WIFI_NETWORK "emil_anna"
#define WIFI_PASSWORD "skripnikovaAmine1!"
#define WIFI_PASSWORD_MS 20000

const char* serverName = "http://10.0.0.157:80/project/project_GE/post-esp-data.php";
String apiKeyValue = "tPmAT5Ab3j7F9";

String sensorName = "esp32_s2_1";

void connectToWifi(){
  Serial.print("connection to Wifi");
  WiFi.mode(WIFI_STA);
  WiFi.begin(WIFI_NETWORK,WIFI_PASSWORD);
  unsigned long StartAttemptTime =millis();

  while(WiFi.status()!= WL_CONNECTED && millis()-StartAttemptTime < WIFI_PASSWORD_MS){
    Serial.print(".");
    delay(100);
  }
  if(WiFi.status()!= WL_CONNECTED){
    Serial.println("Failed!!");
    //take action
  }
  else{
    Serial.println("Connected");
    Serial.println(WiFi.localIP());
  }
}
void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  connectToWifi();
}

void loop() {
  if(WiFi.status()== WL_CONNECTED){
    WiFiClient client;
    HTTPClient http;
    http.begin(client, serverName);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String httpRequestData = "api_key=" + apiKeyValue + "&table=" + sensorName + "&sensor=" + sensorName
                          + "&ip=" + WiFi.localIP() + "&value1=" + "0"+ "&value2=" + "0" + ""; 
    Serial.print (httpRequestData);
    int httpResponseCode = http.POST(httpRequestData);
     if (httpResponseCode>0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    }
    else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    http.end();
     }
      else {
    Serial.println("WiFi Disconnected");
  }
    delay(2000);  
}
