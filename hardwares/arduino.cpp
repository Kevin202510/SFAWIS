#include <Adafruit_Sensor.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <DHT.h>

// WiFi Credentials
const char* ssid = "BIGTIME";
const char* password = "01130125";

// Server URL (Change to your PHP script location)
const char* serverUrl = "http://192.168.100.17:8000/api/esp8266";  

// DHT11 Setup
#define DHTPIN D4
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

// Sensor Pins
#define SOIL_MOISTURE_PIN A0
#define WATER_LEVEL_PIN D3
#define RELAY_PIN D0
#define SOIL_THRESHOLD 1000

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);
    
    Serial.print("Connecting to WiFi");
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println("\nConnected!");
    
    dht.begin();
    pinMode(WATER_LEVEL_PIN, INPUT);
    pinMode(RELAY_PIN, OUTPUT);
    digitalWrite(RELAY_PIN, HIGH);
}

void loop() {
    turnBoardLed();
    if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;
        WiFiClient client;

        // Read Temperature & Humidity
        float temperature = dht.readTemperature();
        float humidity = dht.readHumidity();

        // Read Soil Moisture (0-1023)
        int soilMoisture = analogRead(SOIL_MOISTURE_PIN);

        // Read Water Level (0 or 1)
        int waterLevel = digitalRead(WATER_LEVEL_PIN);

        Serial.print(waterLevel);

        // Check sensor readings
        if (isnan(temperature) || isnan(humidity)) {
            Serial.println("Failed to read from DHT sensor!");
            return;
        }

        // Prepare data to send
        String postData = "temperature=" + String(temperature) +
                          "&humidity=" + String(humidity) +
                          "&soil_moisture=" + String(soilMoisture) +
                          "&water_level=" + String(waterLevel);

        http.begin(client, serverUrl);
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");

        int httpResponseCode = http.POST(postData);

        if (httpResponseCode > 0) {
            Serial.println("Data sent successfully: " + String(httpResponseCode));
            Serial.println("Response: " + http.getString());
        } else {
            Serial.println("Error sending data: " + String(httpResponseCode));
        }

        http.end();

        if (soilMoisture >= SOIL_THRESHOLD) {
            Serial.println("Soil is dry! Turning on water pump...");
            digitalWrite(RELAY_PIN, LOW);
        } else {
            Serial.println("Soil is wet. Pump OFF.");
            digitalWrite(RELAY_PIN, HIGH);
        }
    } else {
        Serial.println("WiFi not connected!");
    }

    delay(5000);
}

void turnBoardLed() {
    digitalWrite(LED_BUILTIN, LOW); 
    delay(1000);
    digitalWrite(LED_BUILTIN, HIGH);
    delay(1000);
}
