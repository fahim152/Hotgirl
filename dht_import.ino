#include <DHT.h>

// Constants
#define DHTPIN A0    
#define DHTTYPE DHT11 
#define LED_PIN 13 
#define TEMP_THRESHOLD 26
#define HUMIDITY_THRESHOLD 60.0

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(9600);
  pinMode(LED_PIN, OUTPUT);
  dht.begin();
}

void loop() {
  float temp = dht.readTemperature(); 
  float humidity = dht.readHumidity(); 
  
  if (isnan(temp)) {
    Serial.println("Failed to read from DHT sensor!");
  } else {
    // Print data in the specified format
    Serial.print("Temperature: ");
    Serial.println(temp);
    Serial.print("Humidity: ");
    Serial.println(humidity);
    Serial.println("------------------");

    // Check temperature threshold
    if (temp > TEMP_THRESHOLD) {
      digitalWrite(LED_PIN, HIGH); 
    } else {
      digitalWrite(LED_PIN, LOW); 
    }
  }

  delay(2000);  // Wait 500 milliseconds before the next read
}
