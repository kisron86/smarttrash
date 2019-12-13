#include <WiFi.h>
#include <HTTPClient.h>
#include <HTTPUpdate.h>
#include <SimpleTimer.h>


#define USE_SERIAL Serial
const int trigPin = 26;
const int echoPin = 27;


 
// Buat object Wifi
const char* ssid = "didinx";
const char* password =  "qwaszx23";


HTTPClient http;
String url = "http://3.89.128.93/smarttrash/Api?id=";
String payload;

float d1, d2, d3, d4, d5;
long tinggi, level, average;
long  deviasi = 10;
long  tinggiBaks = 150;

//DEEP_SLEEP interval = 5m
int sleepInterval = 300;

void setup(){
  USE_SERIAL.begin(115200);
  USE_SERIAL.setDebugOutput(false);
  for(uint8_t t = 4; t > 0; t--) {
        USE_SERIAL.printf("[SETUP] Tunggu %d...\n", t);
        USE_SERIAL.flush();
        delay(1000);
  } 
  konekToWifi();
  Serial.println("Levelling...");
  tinggi = ukurTinggi();
  average = ukurAverage();
  Serial.println(average);
  level = ukurLevel(average);
  Serial.print("#Tinggi Sampah (CM) =  ");
  Serial.println(tinggiBaks - average);
  Serial.print("#Level (%) =  ");
  Serial.println(level);
  kirimData();
  Serial.println("Goto sleep for 5 minute...");
  gotoSleep();
  delay(100);
  }

float ukurTinggi(){
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  long duration, distance;
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(1000);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distance = (duration / 2) / 29.1;
  return distance;
  }

float ukurAverage(){
  d1 = ukurTinggi();
  delay(2000);
  d2 = ukurTinggi();
  delay(2000);
  d3 = ukurTinggi();
  delay(2000);
  d4 = ukurTinggi();
  delay(2000);
  d5 = ukurTinggi();
  return (d1 + d2 + d3 + d4 + d5)/ 5;
  }

float ukurLevel(float ukurAverage){
  long persen;
  persen = 100-(((ukurAverage-deviasi)*100)/tinggiBaks);
  return persen;
  }

void konekToWifi(){
  Serial.println("- Coba Koneksi WIFI SSID : " + String(ssid));
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    }
  Serial.println();
  Serial.println("- Koneksi Sukses");
  }

void kirimData(){
  if((WiFi.status() == WL_CONNECTED)) {
    USE_SERIAL.print("[HTTP] Memulai...\n");
    http.begin( url + 2 + "&ketinggian=" + level);
    delay(2000);
    USE_SERIAL.print("[HTTP] Melakukan GET ke server...\n");
    int httpCode = http.GET();
    if(httpCode > 0) {
      USE_SERIAL.printf("[HTTP] kode response GET: %d\n", httpCode);
        if(httpCode == HTTP_CODE_OK) {
           payload = http.getString();
           USE_SERIAL.println(payload);
          }
    } else { 
      USE_SERIAL.printf("[HTTP] GET gagal, error: %s\n", http.errorToString(httpCode).c_str());
      }
    http.end();
    }
  delay(5000);
  }

void gotoSleep(){
  ESP.deepSleep(1000000 * sleepInterval);
  }
void loop(){
  }
