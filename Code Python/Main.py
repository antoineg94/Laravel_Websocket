import paho.mqtt.client as paho
import RPi.GPIO as GPIO
import time
from time import sleep
import datetime
import math
from ADCDevice import *
import Freenove_DHT as DHT
from rpi_ws281x import *
from Adafruit_LCD1602 import Adafruit_CharLCD
from PCF8574 import PCF8574_GPIO
import logging
import threading
import socket



GPIO.setmode(GPIO.BOARD)

# Configuration des LED
LED_COUNT      = 8
LED_PIN        = 18
LED_FREQ_HZ    = 800000
LED_DMA        = 10
LED_BRIGHTNESS = 255
LED_INVERT     = False
LED_CHANNEL    = 0


redLED = 33
yellowLED = 35
greenLED = 37

relayPin = 40     # define the relayPin


ledPin = 22       
sensorPin = 13    
 
def setupsensor():
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(relayPin, GPIO.OUT)   # set relayPin to OUTPUT mode
   

def setupSensor():
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(ledPin, GPIO.OUT)
    GPIO.setup(sensorPin, GPIO.IN)

def setupUltramove():
    GPIO.setmode(GPIO.BOARD)        # use PHYSICAL GPIO Numbering
    GPIO.setup(ledPin, GPIO.OUT)    # set ledPin to OUTPUT mode
    GPIO.setup(sensorPin, GPIO.IN)  # set sensorPin to INPUT mode

def setupLed():
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(redLED, GPIO.OUT)
    GPIO.setup(yellowLED, GPIO.OUT)
    GPIO.setup(greenLED, GPIO.OUT)
# Initialisation de l'ADC
adc = ADCDevice()
def setup():
    global adc
    if adc.detectI2C(0x48):
        adc = PCF8591()
    elif adc.detectI2C(0x4b):
        adc = ADS7830()
        time.sleep(3)
    else:
        print("Lumière : I2C address incorrecte.")
        exit(-1)
setup()

# Paramètres de temporisation
timerHumidite = 1
timerLumiere = 1
timerTemperature = 1

# Initialisation des variables d'envoi
envoiTemperature = ''
envoiHumidite = ''
envoiLumiere = ''
statusMove=""
statuLed=""
envoiLed = 'on'
intrusion=''

# Configuration du client MQTT
broker = "172.16.72.193"
port = 1884


client = paho.Client("client-publisher")
# Fonction de gestion des messages MQTT
def on_message(client,userdata, message):
    print("JE SUiS LA")
    global envoiLed
    topic = message.topic
    payload = message.payload.decode('utf-8')
    if topic == "topicEtatEclairage":
        print("Received message on topicEclairage:", payload)
        # Appel de control_led avec l'état reçu
        envoiLed = payload
        control_led(payload)
client.connect(broker, port)
client.on_message = on_message
client.subscribe("topicEtatEclairage")
# Connexion à l'broker MQTT
# Fonction pour envoyer la température
def envoyerTemperature():
    while True:
        global adc, envoiTemperature
        value = adc.analogRead(0)
        voltage = value / 255.0 * 3.3
        Rt = 10 * voltage / (3.3 - voltage)
        tempK = 1/(1/(273.15 + 25) + math.log(Rt/10)/3950.0)
        tempC = tempK - 273.15
        envoiTemperature = round(tempC,2)
        time.sleep(timerTemperature)
        client.publish("topicTemperature", envoiTemperature)
        time.sleep(3)

# Fonction pour envoyer la lumière
def envoyerLumiere():
    while True:
        global adc, envoiLumiere
        value = adc.analogRead(1)
        envoiLumiere = value
        time.sleep(timerLumiere)
        client.publish("topicLumiere", envoiLumiere)
        time.sleep(3)

# Fonction pour envoyer l'humidité
def envoyerHumidite():
    
    while True:
        print("hum")
        GPIO.setmode(GPIO.BOARD)
        global envoiHumidite
        DHTPin = 11
        dht = DHT.DHT(DHTPin)
        for i in range(0, 15):            
            chk = dht.readDHT11()
            if chk is dht.DHTLIB_OK:
                print("DHT11,OK!")
                break   
        envoiHumidite = dht.humidity
        time.sleep(timerHumidite)
        client.publish("topicHumidite", envoiHumidite)
        time.sleep(3)
        

def envoieMouvement():
    while True:
        global statuLed
        setupUltramove()
        if GPIO.input(sensorPin)==GPIO.HIGH:
            GPIO.output(ledPin,GPIO.HIGH) # turn on led
            statuLed == "on"
        else :
            GPIO.output(ledPin,GPIO.LOW) # turn off led
            statuLed == "off"
   


# Fonction pour contrôler les LED
def control_led():

    print(envoiLed)
    while True:
        ORDER = "RGB"
        strip = Adafruit_NeoPixel(LED_COUNT, LED_PIN, LED_FREQ_HZ, LED_DMA, LED_INVERT, LED_BRIGHTNESS, LED_CHANNEL)
        strip.begin()
        now = datetime.datetime.now()
        max_brightness = 255
        current_hour = now.hour + now.minute / 60
        if current_hour < 12:
            brightness = (current_hour / 12) * max_brightness
        else:
            brightness = ((17 - current_hour) / 5) * max_brightness
            if brightness < 0:
                brightness = 0
        for i in range(LED_COUNT):
                strip.setPixelColor(i, Color(int(brightness), int(brightness), int(brightness)))
        strip.show()
        
        client.publish("topicEtatEclairage")
       

def capteurHumidite():
    while True:
        global adc, envoiHumiditePlante,humidity_percentage,statuLed,intrusion
        value = adc.analogRead(3)
        envoiHumiditePlante = value
        
        print(value)
        humid_value = 100  # représentant 0% d'humidité (très humide)
        dry_value = 224    # représentant 100% d'humidité (très sec)
        min_moisture_value = humid_value + (dry_value - humid_value) * 0.40  # 40% d'humidité
        max_moisture_value = humid_value + (dry_value - humid_value) * 0.55  # 40% d'humidité
        target_moisture_value = humid_value + (dry_value - humid_value) * 0.50  # 50% d'humidité

        soil_moisture = adc.analogRead(3)  # supposant que le capteur est sur le canal 3
        envoiHumiditePlante = soil_moisture
        humidity_percentage = (1 - (soil_moisture - humid_value) / (dry_value - humid_value)) * 100
        humidity_percentage = round(humidity_percentage, 2)

        time.sleep(1)  # attendre 1 seconde entre les lectures pour ne pas surcharger le capteur

        # Vérifier si l'humidité est en dessous de 40%
        if envoiHumiditePlante < min_moisture_value:
            print("Trop humide: Alarme rouge")
            statuLed = "humide"
            setupLed()
            GPIO.output(redLED, GPIO.HIGH)
            GPIO.output(yellowLED, GPIO.LOW)
            GPIO.output(greenLED, GPIO.LOW)
            #GPIO.output(pump_relay_pin, GPIO.HIGH)  # Active la pompe

        if envoiHumiditePlante> min_moisture_value and envoiHumiditePlante < target_moisture_value:
            print("Presque trop humide: Alarme jaune")
            statuLed = "presquehumide"
            setupLed()
            GPIO.output(redLED, GPIO.LOW)
            GPIO.output(yellowLED, GPIO.HIGH)
            GPIO.output(greenLED, GPIO.LOW)
            
            
        if envoiHumiditePlante> target_moisture_value and envoiHumiditePlante < max_moisture_value:
            print("Presque sec: Alarme jaune")
            statuLed = "presquesec"
            setupLed()
            GPIO.output(redLED, GPIO.LOW)
            GPIO.output(yellowLED, GPIO.HIGH)
            GPIO.output(greenLED, GPIO.LOW)

        
        # Vérifier si l'humidité a atteint 50%
        if envoiHumiditePlante == target_moisture_value:
            print("Humidité atteinte: Alarme verte (Arrêt de la pompe)")
            statuLed = "humiditéatteinte"
            setupLed()
            GPIO.output(redLED, GPIO.LOW)
            GPIO.output(yellowLED, GPIO.LOW)
            GPIO.output(greenLED, GPIO.HIGH)

         # Sort de la boucle si l'humidité désirée est atteinte
        if envoiHumiditePlante > max_moisture_value:
            print("Trop sec: Alarme rouge (Demarrer la pompe)")
            statuLed = "sec"
            setupLed()
            GPIO.output(redLED, GPIO.HIGH)
            GPIO.output(yellowLED, GPIO.LOW)
            GPIO.output(greenLED, GPIO.LOW)
            setupsensor()
            GPIO.output(relayPin,GPIO.HIGH)
          
            # motor_on(relayPin,relayPin2)
            time.sleep(5)
            GPIO.output(relayPin,GPIO.LOW)
          
            time.sleep(0.5)
            GPIO.cleanup()
        client.publish("topicSenseurHumidite", statuLed)
    
        

def capteurHumiditevalue():
    global adc, envoiHumiditePlante,humidity_percentage
    value = adc.analogRead(3)
    envoiHumiditePlante = value
    print(value)
    humid_value = 100  # représentant 0% d'humidité (très humide)
    dry_value = 224    # représentant 100% d'humidité (très sec)
    min_moisture_value = humid_value + (dry_value - humid_value) * 0.40  # 40% d'humidité
    max_moisture_value = humid_value + (dry_value - humid_value) * 0.55  # 40% d'humidité
    target_moisture_value = humid_value + (dry_value - humid_value) * 0.50  # 50% d'humidité

    soil_moisture = adc.analogRead(3)  # supposant que le capteur est sur le canal 3
    envoiHumiditePlante = soil_moisture
    humidity_percentage = (1 - (soil_moisture - humid_value) / (dry_value - humid_value)) * 100
    humidity_percentage = round(humidity_percentage, 2)
    return humidity_percentage
        

def get_time_now():
    while True:
        return datetime.datetime.now().strftime('    %H:%M:%S')

def destroy():
    lcd.clear()
    GPIO.cleanup()

PCF8574_address = 0x27  # Adresse I2C du chip PCF8574
PCF8574A_address = 0x3F  # Adresse I2C du chip PCF8574A
try:
    mcp = PCF8574_GPIO(PCF8574_address)
except:
    try:
        mcp = PCF8574_GPIO(PCF8574A_address)
    except:
        print('Erreur d\'adresse I2C !')
        exit(1)
lcd = Adafruit_CharLCD(pin_rs=0, pin_e=2, pins_db=[4,5,6,7], GPIO=mcp)

def intrus():
    setupUltramove()
    while True:
        if GPIO.input(sensorPin)==GPIO.HIGH:
            time.sleep(4)
            intrusion= "intrusdétecté"
            GPIO.output(ledPin,GPIO.HIGH) # turn on led
            
        if GPIO.input(sensorPin)==GPIO.LOW:
            time.sleep(1)
            intrusion= "aucunintrus"
            GPIO.output(ledPin,GPIO.LOW) # turn off led
            
        
        client.publish("topicIntrus", intrusion)
        time.sleep(1)
    

def loop():

    message_index = 0 
    while True:
        
        if intrusion =="intrusdétecté":
            lcd.clear()
            mcp.output(3,1)     # Allumer le rétroéclairage LCD
            lcd.begin(16,2)     # Définir le nombre de lignes et de colonnes du LCD
            lcd.setCursor(0,0)  # Définir la position du curseur
            lcd.message('Intrusion!!!')  # Afficher l'état d'humidit
            time.sleep(4)
        else:
            lcd.clear()

            messages = [
            'Humidite: {}%'.format(capteurHumiditevalue()),
            'Temp: {}C'.format(envoiTemperature),
            'Lumiere: {}'.format(envoiLumiere)
            ]
            mcp.output(3,1)     # Allumer le rétroéclairage LCD
            lcd.begin(16,2)     # Définir le nombre de lignes et de colonnes du LCD
            lcd.setCursor(0,0)  # Définir la position du curseur
            #lcd.message('Humidite: ' + str(capteurHumiditevalue()) +'%'+ '\n')  # Afficher l'état d'humidité du 
            lcd.message(messages[message_index])

            # Passer au message suivant pour le prochain cycle
            message_index = (message_index + 1) % len(messages)

            # Afficher l'heure sur la deuxième ligne
            lcd.setCursor(0,1)  # Déplacer le curseur à la deuxième ligne
            lcd.message(get_time_now())

            sleep(1)  # Attendre une seconde avant la prochaine mise à jour
     # Définir le nombre de lignes et de colonnes du LCD
def check_internet():     
    try:         
        socket.create_connection(("www.google.com", 80)) 

    except OSError: 
            setupLed()
            GPIO.output(redLED, GPIO.HIGH)
            GPIO.output(yellowLED, GPIO.LOW)
            GPIO.output(greenLED, GPIO.LOW)        


""" if check_internet():     
    print("Connexion Internet disponible.")
else:     
    print("Pas de connexion Internet.")
 """
control_intrus = threading.Thread(target=intrus)
control_intrus.start() 
humidite_sol = threading.Thread(target=capteurHumidite)
humidite_sol.start()
lumiere = threading.Thread(target=envoyerLumiere)
lumiere.start()

alerte = threading.Thread(target=envoieMouvement)
alerte.start()

temperature = threading.Thread(target=envoyerTemperature)
temperature.start()

humidite_piece = threading.Thread(target=envoyerHumidite)
humidite_piece.start()

""" on_messagearrived = threading.Thread(target=on_message)
on_messagearrived.start() """

""" temperature = threading.Thread(target=envoyerTemperature)
temperature.start()
humidite_piece = threading.Thread(target=envoyerHumidite)
humidite_piece.start()
humidite_sol = threading.Thread(target=capteurHumidite)
humidite_sol.start() """
""" alerte = threading.Thread(target=envoieMouvement)
alerte.start()

control_lumiere = threading.Thread(target=envoiLed(),args=(envoiLed))
control_lumiere.start()
 """
lecteur= threading.Thread(target=loop)
lecteur.start()
""" control_lumiere = threading.Thread(target=envoiLed())
control_lumiere.start() """  
control_lumiere = threading.Thread(target=control_led)
control_lumiere.start() 

control_internet = threading.Thread(target=check_internet)
control_internet.start() 


