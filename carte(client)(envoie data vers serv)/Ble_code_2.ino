//-----------------------ble



#include <BLEAdvertisedDevice.h>
#include <BLEDevice.h>
#include <BLEScan.h>
const int CUTOFF = -60;
#define SERVICE_UUIDS        "4fafc201-1fb5-459e-8fcc-c5c9c331914b"
#define CHARACTERISTIC_UUIDS "beb5483e-36e1-4688-b7f5-ea07361b26a8"
static BLEUUID serviceUUID("4fafc201-1fb5-459e-8fcc-c5c9c331914b");
// The characteristic of the remote service we are interested in.
static BLEUUID    charUUID("beb5483e-36e1-4688-b7f5-ea07361b26a8");




//----------------------wifi
#include <WiFi.h>
#include <WiFiClient.h>
#include <HTTPClient.h>
#define WIFI_NETWORK "emil_anna"
#define WIFI_PASSWORD "skripnikovaAmine1!"
#define WIFI_PASSWORD_MS 20000

//const char* serverName = "http://10.0.0.108:80/post-esp-data.php";

const char* serverName = "http://10.0.0.157:80/project/project_GE/post-esp-data.php";
String apiKeyValue = "tPmAT5Ab3j7F9";

String sensorName = "esp32_1";

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

////////////////////////////////////BLE////////////////////////////////////////////////
                void ble_setup(){
                             BLEDevice::init("Esp2");
                            esp_ble_tx_power_set(ESP_BLE_PWR_TYPE_DEFAULT, ESP_PWR_LVL_P9); 
                            esp_ble_tx_power_set(ESP_BLE_PWR_TYPE_ADV, ESP_PWR_LVL_P9);
                            esp_ble_tx_power_set(ESP_BLE_PWR_TYPE_SCAN ,ESP_PWR_LVL_P9);
                            int pwrAdv  = esp_ble_tx_power_get(ESP_BLE_PWR_TYPE_ADV);
                            int pwrScan = esp_ble_tx_power_get(ESP_BLE_PWR_TYPE_SCAN);
                            int pwrDef  = esp_ble_tx_power_get(ESP_BLE_PWR_TYPE_DEFAULT);
                            Serial.println("Power Settings: (ADV,SCAN,DEFAULT)");         //all should show index7, aka +9dbm
                            Serial.println("puissance signale de Adv=>"+ pwrAdv);
                            Serial.println("puissance signale de Adv=>"+pwrScan);
                            Serial.println("puissance signale de Adv=>"+pwrDef);
                             BLEServer *pServer = BLEDevice::createServer();
                            BLEService *pService = pServer->createService(SERVICE_UUIDS);
                            BLECharacteristic *pCharacteristic = pService->createCharacteristic(
                                                                   CHARACTERISTIC_UUIDS,
                                                                   BLECharacteristic::PROPERTY_READ |
                                                                   BLECharacteristic::PROPERTY_WRITE
                                                                 );
                          
                            pCharacteristic->setValue("Hello World says Neil");
                            pService->start();
                            // BLEAdvertising *pAdvertising = pServer->getAdvertising();  // this still is working for backward compatibility
                            BLEAdvertising *pAdvertising = BLEDevice::getAdvertising();
                            pAdvertising->addServiceUUID(SERVICE_UUIDS);
                            pAdvertising->setScanResponse(true);
                            pAdvertising->setMinPreferred(0x06);  // functions that help with iPhone connections issue
                            pAdvertising->setMinPreferred(0x12);
                            BLEDevice::startAdvertising();
                }
                int ble_loop(){
                        BLEScan *scan = BLEDevice::getScan();
                        scan->setActiveScan(true);
                        BLEScanResults results = scan->start(1);
                        int best = CUTOFF;
                        String device_add;
                        int rssi = 0;
                        for (int i = 0; i < results.getCount(); i++) {
                          BLEAdvertisedDevice device = results.getDevice(i);
                          //int rssi = device.getRSSI();
                         /* if (rssi > best) {
                            best = rssi;
                            device_add= device.toString().c_str();
                            Serial.println(device_add);
                            Serial.println(F("Name -> "));
                            Serial.println(device.getName().c_str());
                            Serial.print(rssi);
                          }
                          */
                         if((device.haveServiceUUID() && device.isAdvertisingService(serviceUUID) )){
                           rssi = device.getRSSI();
                         // Serial.print(F("Name -> "));
                         // Serial.print(device.getName().c_str());
                          //Serial.println(device.getRSSI());
                          //delay(1);
                         }
                        }
                        Serial.println("le rssi ble mesurer est de  "+rssi);
                        return rssi;
                 }

////////////////////////////////////WIFI////////////////////////////////////////////////
 void wifi_setup(){
  connectToWifi();
 }
 void wifi_loop(int rssi){
   if(WiFi.status()== WL_CONNECTED){
    WiFiClient client;
    HTTPClient http;
    http.begin(client, serverName);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String httpRequestData = "api_key=" + apiKeyValue + "&table=" + sensorName + "&sensor=" + sensorName
                          + "&ip=" + WiFi.localIP() + "&value1=" + WiFi.RSSI()+ "&value2=" + rssi + ""; 
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
    delay(1);  
}
 



////////////////////////////////////////////////////////////////////////////////////////

void setup() {
 Serial.begin(115200);
 wifi_setup();
  ble_setup();
}
void loop() {
 wifi_loop(ble_loop());
}
