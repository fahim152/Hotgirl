import serial
import mysql.connector
import datetime

# Setup the connection to the MySQL database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="heat_data"
)
cursor = db.cursor()

# Setup the serial connection
ser = serial.Serial('COM4', 9600)

try:
    while True:
        if ser.in_waiting > 0:
            line = ser.readline().decode('utf-8').strip()
            timestamp = datetime.datetime.now()
            if line.startswith("Temperature:"):
                temperature = line.split(': ')[1]
            elif line.startswith("Humidity:"):
                humidity = line.split(': ')[1]
            elif line == "------------------":
                # SQL query to insert data when the separator line is detected
                query = "INSERT INTO history (temperature, humidity, timestamp) VALUES (%s, %s, %s)"
                values = (temperature, humidity, timestamp)
                cursor.execute(query, values)
                db.commit()
                print(f"Data inserted: {timestamp}, {temperature}, {humidity}")
except KeyboardInterrupt:
    print("Program stopped manually")
finally:
    ser.close()
    cursor.close()
    db.close()
    print("Resources have been released")
