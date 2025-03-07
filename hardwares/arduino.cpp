#include <Adafruit_Sensor.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <DHT.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>

// Initialize LCD with I2C address 0x27
LiquidCrystal_I2C lcd(0x27, 16, 2);

// WiFi Credentials
const char* ssid = "SSID";
const char* password = "PASSWORD";

// Server URL (Change to your PHP script location)
const char* serverUrl = "http://192.168.100.17:8000/api/esp8266";  

// DHT11 Setup
#define DHTPIN D4
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

// Sensor Pins
#define SOIL_MOISTURE_PIN A0
#define RELAY_PIN D0
#define RELAY_PIN2 D6
#define SOIL_THRESHOLD 1000
#define TEMPERATURE_THRESHOLD 30

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);

    lcd.init();       // Initialize LCD
    lcd.backlight();  // Turn on LCD backlight
    lcd.setCursor(0, 0);
    lcd.print("Connecting WiFi");

    Serial.print("Connecting to WiFi");
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println("\nConnected!");

    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("WiFi Connected!");
    delay(2000);

    dht.begin();
    pinMode(RELAY_PIN, OUTPUT);
    digitalWrite(RELAY_PIN, HIGH);
    pinMode(RELAY_PIN2, OUTPUT);
    digitalWrite(RELAY_PIN2, HIGH);
}

void loop() {
    turnBoardLed();
    if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;
        WiFiClient client;

        float temperature = dht.readTemperature();
        float humidity = dht.readHumidity();
        int soilMoisture = analogRead(SOIL_MOISTURE_PIN);

        if (isnan(temperature) || isnan(humidity)) {
            Serial.println("Failed to read from DHT sensor!");
            lcd.clear();
            lcd.setCursor(0, 0);
            lcd.print("DHT Read Error!");
            return;
        }

        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("T:");
        lcd.print(temperature);
        lcd.print("C H:");
        lcd.print(humidity);
        lcd.print("%");

        lcd.setCursor(0, 1);
        lcd.print("Soil:");
        lcd.print(soilMoisture);

        // Prepare data to send
        String postData = "temperature=" + String(temperature) +
                          "&humidity=" + String(humidity) +
                          "&soil_moisture=" + String(soilMoisture);

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

        //Check Temperature Threshold
        if (temperature >= TEMPERATURE_THRESHOLD) {
            Serial.println("Temperature is High! Turning on fan...");
            lcd.setCursor(0, 0);
            lcd.print(" Fan: ON ");
            digitalWrite(RELAY_PIN2, LOW);
        } else {
            Serial.println("Temperature is Neutral Fan is OFF.");
            digitalWrite(RELAY_PIN2, HIGH);
        }

        //Check Soil Moisture Threshold
        if (soilMoisture >= SOIL_THRESHOLD) {
            Serial.println("Soil is dry! Turning on water pump...");
            lcd.setCursor(0, 1);
            lcd.print(" Pump: ON ");
            digitalWrite(RELAY_PIN, LOW);
        } else {
            Serial.println("Soil is wet. Pump OFF.");
            digitalWrite(RELAY_PIN, HIGH);
        }
    } else {
        Serial.println("WiFi not connected!");
        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("WiFi Disconnected");
    }

    delay(10000);
}

void turnBoardLed() {
    digitalWrite(LED_BUILTIN, LOW); 
    delay(1000);
    digitalWrite(LED_BUILTIN, HIGH);
    delay(1000);
}