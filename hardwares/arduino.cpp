#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid = "Your_SSID";          // Change to your WiFi SSID
const char* password = "Your_PASSWORD";  // Change to your WiFi Password
const char* serverUrl = "http://192.168.1.100:8000/api/sensor";  // Replace with Laravel API URL

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);

    Serial.print("Connecting to WiFi");
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println("\nConnected to WiFi!");
}

void loop() {
    if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;

        http.begin(serverUrl);
        http.addHeader("Content-Type", "application/json");

        // Simulated Sensor Data
        float temperature = random(20, 30);  
        float humidity = random(40, 60);

        String jsonPayload = "{\"temperature\": " + String(temperature) + ", \"humidity\": " + String(humidity) + "}";

        int httpResponseCode = http.POST(jsonPayload);

        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);

        http.end();
    } else {
        Serial.println("WiFi Disconnected!");
    }

    delay(5000);  // Send data every 5 seconds
}
