// Include library yang diperlukan
#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
 
// Gunakan serial sebagai monitor
#define USE_SERIAL Serial
 
// Buat object Wifi
ESP8266WiFiMulti WiFiMulti;
 
// Buat object http
HTTPClient http;
 
// Deklarasikan variable untuk suhu
float vref = 3.3;
float resolusi = vref*100/1023;
float suhu;
String payload;
 
// Ini adalah alamat script (URL) yang kita pasang di web server
// Silahkan sesuaikan alamat IP dengan ip komputer anda atau alamat domain (bila di web hosting)
// '?suhu=' adalah adalah nama parameter yang akan dikirimkan ke script PHP 
 
//String url = "http://192.168.43.66/demo_nodemcu/simpandata.php?suhu=";
//String url = "http://66.42.57.140/air_monitoring/index1.php?data1=";
String url = "http://34.68.48.177/smarttrash/Api?id=";
 
void setup() {
 
    USE_SERIAL.begin(115200);
    USE_SERIAL.setDebugOutput(false);
 
    for(uint8_t t = 4; t > 0; t--) {
        USE_SERIAL.printf("[SETUP] Tunggu %d...\n", t);
        USE_SERIAL.flush();
        delay(1000);
    }
 
    WiFi.mode(WIFI_STA);
    WiFiMulti.addAP("wifiku", "kudalumping"); // Sesuaikan SSID dan password ini
}
 
void loop() {
    
    // Baca suhu dari pin analog
    suhu = analogRead(A0);
    suhu = suhu*resolusi;
    //----------------------
 
    // Cek apakah statusnya sudah terhubung
    if((WiFiMulti.run() == WL_CONNECTED)) {
 
        // Tambahkan nilai suhu pada URL yang sudah kita buat
        USE_SERIAL.print("[HTTP] Memulai...\n");
        http.begin( url + "1" + "&ketinggian=" + 99);//+ "&data3=" + suhu+ "&data4=" + suhu+ "&data5=" + suhu+ "&data6=" + suhu+ "&data7=" + suhu+ "&data8=" + suhu+ "&data9=" + suhu+ "&data10=" + suhu ); 
        delay(2000);
        // Mulai koneksi dengan metode GET
        USE_SERIAL.print("[HTTP] Melakukan GET ke server...\n");
        int httpCode = http.GET();
 
        // Periksa httpCode, akan bernilai negatif kalau error
        if(httpCode > 0) {
            
            // Tampilkan response http
            USE_SERIAL.printf("[HTTP] kode response GET: %d\n", httpCode);
 
            // Bila koneksi berhasil, baca data response dari server
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
