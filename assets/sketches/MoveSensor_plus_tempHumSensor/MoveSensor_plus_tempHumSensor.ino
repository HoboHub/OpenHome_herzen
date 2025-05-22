#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include "DHT.h"

#include <ESP8266mDNS.h>
#include <WiFiUdp.h>
#include <ArduinoOTA.h> 

// Раскомментируйте одну из строк ниже в зависимости от того, какой датчик вы используете!
#define DHTTYPE DHT11   // DHT 11
//#define DHTTYPE DHT21   // DHT 21 (AM2301)
//#define DHTTYPE DHT22   // DHT 22  (AM2302), AM2321

/* Введите свои SSID и пароль */
const char* ssid = "yourwifiname";  // SSID
const char* password = "wifipassword"; // pass

ESP8266WebServer server(80);

// датчик DHT
uint8_t DHTPin = D8; 
               
// инициализация датчика DHT.
DHT dht(DHTPin, DHTTYPE);                

float Temperature;
float Humidity;
int Move;
String MoveStat;
 
void setup() 
{ 
  Serial.begin(115200);
  delay(100);

  pinMode(D7, INPUT); //датчик
  pinMode(D2, OUTPUT); //светодиод
  digitalWrite(D2, LOW); //светодиод выкл. при первом включении

  delay(10000); //задержка для настройки датчика (обычно от 30000 до 60000)
  Serial.println("Датчик настроен");
  
  pinMode(DHTPin, INPUT);

  dht.begin();

  Serial.println("Connecting to ");
  Serial.println(ssid);

  // подключаемся к локальной wi-fi сети
  WiFi.begin(ssid, password);

  // проверить, подключился ли wi-fi модуль к wi-fi сети
  while (WiFi.status() != WL_CONNECTED) 
  {
    delay(1000);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected..!");
  Serial.print("Got IP: ");  Serial.println(WiFi.localIP());

  server.on("/", handle_OnConnect);
  server.onNotFound(handle_NotFound);

  server.begin();
  Serial.println("HTTP server started");

//////////////////////////////
  ArduinoOTA.setHostname("ESP8266-00001"); // Задаем имя сетевого порта
  //ArduinoOTA.setPassword((const char *)"0000"); // Задаем пароль доступа для удаленной прошивки
  ArduinoOTA.begin(); // Инициализируем OTA
/////////////
}

void loop() 
{
  ArduinoOTA.handle(); ////////***
  server.handleClient();

  ///добавил от себя для проверки
  Serial.print("Temp: "); Serial.print(dht.readTemperature()); Serial.print("   ");
  Serial.print("Hum: "); Serial.println(dht.readHumidity());
  delay(2000);
  ///
}

void handle_OnConnect() 
{
  Temperature = dht.readTemperature(); // получить значение температуры
  Humidity = dht.readHumidity();       // получить значение влажности
  
  Move = digitalRead(D7); //движение 1 - есть, 0 - нет
  MoveStat = "Движения нет";
  if (Move) {
    MoveStat = "Есть движение";
  }
  else {
    MoveStat = "Движения нет";
  }
  
  server.send(200, "text/html", SendHTML(Temperature,Humidity, MoveStat)); 

//срабатывание светодиода при движении (проверка датчика)
  if (digitalRead(D7)) {
    digitalWrite(D2, HIGH);
    Serial.println("Есть движение!");
  }
  else {
    digitalWrite(D2, LOW);
  }
  delay(1000);
//---------------------
}

void handle_NotFound()
{
  server.send(404, "text/plain", "Not found");
}

String SendHTML(float TempCstat,float Humiditystat, String MoveStat)
{
  String ptr = "<!DOCTYPE html> <html>\n";
  ptr +="<head><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=no\">\n";
//  ptr+="<meta http-equiv='refresh' content='3' >\n";  //ЗДЕСЬ МЕНЯТЬ ВРЕМЯ ОБНОВЛЕНИЯ СТРАНИЦЫ (content=X сек.)
  ptr+="<meta charset=\"utf-8\">\n";
  ptr +="<link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,400,600\" rel=\"stylesheet\">\n";
  ptr +="<title>ESP8266 Weather Report</title>\n";
  ptr +="<style>html { font-family: 'Open Sans', sans-serif; display: block; margin: 0px auto; text-align: center;color: #333333;}\n";
  ptr +="body{margin-top: 50px;}\n";
  ptr +="h1 {margin: 50px auto 30px;}\n";
  ptr +=".side-by-side{display: inline-block;vertical-align: middle;position: relative;}\n";
  ptr +=".humidity-icon{background-color: #3498db;width: 30px;height: 30px;border-radius: 50%;line-height: 36px;}\n";
  ptr +=".humidity-text{font-weight: 600;padding-left: 15px;font-size: 19px;width: 160px;text-align: left;}\n";
  ptr +=".humidity{font-weight: 300;font-size: 60px;color: #3498db;}\n";
  ptr +=".move{font-weight: 600;font-size: 20px;color: #000;}\n";
  ptr +=".temperature-icon{background-color: #f39c12;width: 30px;height: 30px;border-radius: 50%;line-height: 40px;}\n";
  ptr +=".temperature-text{font-weight: 600;padding-left: 15px;font-size: 19px;width: 160px;text-align: left;}\n";
  ptr +=".temperature{font-weight: 300;font-size: 60px;color: #f39c12;}\n";
  ptr +=".superscript{font-size: 17px;font-weight: 600;position: absolute;right: -20px;top: 15px;}\n";
  ptr +=".data{padding: 10px;}\n";
  ptr +="</style>\n";
  //ajax (обновления статы без перезагрузки страницы)
  ptr +="<script>\n";
  ptr +="setInterval(loadDoc,200);\n";  //функция вызывается каждые 200 милисек. (в самой функции идет проверка: изменились ли данные)
  ptr +="function loadDoc() {\n";
  ptr +="var xhttp = new XMLHttpRequest();\n";
  ptr +="xhttp.onreadystatechange = function() {\n";
  ptr +="if (this.readyState == 4 && this.status == 200) {\n";
  ptr +="document.getElementById(\"webpage\").innerHTML =this.responseText}\n";
  ptr +="};\n";
  ptr +="xhttp.open(\"GET\", \"/\", true);\n";
  ptr +="xhttp.send();\n";
  ptr +="}\n";
  ptr +="</script>\n";
  //---------------------ajax end
  ptr +="</head>\n";
  ptr +="<body>\n";
  
  ptr +="<div id=\"webpage\">\n";
  
  ptr +="<div class=\"data\">\n";
  ptr +="<div class=\"side-by-side temperature-icon\">\n";
  ptr +="<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n";
  ptr +="width=\"9.915px\" height=\"22px\" viewBox=\"0 0 9.915 22\" enable-background=\"new 0 0 9.915 22\" xml:space=\"preserve\">\n";
  ptr +="<path fill=\"#FFFFFF\" d=\"M3.498,0.53c0.377-0.331,0.877-0.501,1.374-0.527C5.697-0.04,6.522,0.421,6.924,1.142\n";
  ptr +="c0.237,0.399,0.315,0.871,0.311,1.33C7.229,5.856,7.245,9.24,7.227,12.625c1.019,0.539,1.855,1.424,2.301,2.491\n";
  ptr +="c0.491,1.163,0.518,2.514,0.062,3.693c-0.414,1.102-1.24,2.038-2.276,2.594c-1.056,0.583-2.331,0.743-3.501,0.463\n";
  ptr +="c-1.417-0.323-2.659-1.314-3.3-2.617C0.014,18.26-0.115,17.104,0.1,16.022c0.296-1.443,1.274-2.717,2.58-3.394\n";
  ptr +="c0.013-3.44,0-6.881,0.007-10.322C2.674,1.634,2.974,0.955,3.498,0.53z\"/>\n";
  ptr +="</svg>\n";
  ptr +="</div>\n";
  ptr +="<div class=\"side-by-side temperature-text\">Temperature</div>\n";
  ptr +="<div class=\"side-by-side temperature\">";
  ptr +=(int)TempCstat;
  ptr +="<span class=\"superscript\">°C</span></div>\n";
  ptr +="</div>\n";
  ptr +="<div class=\"data\">\n";
  ptr +="<div class=\"side-by-side humidity-icon\">\n";
  ptr +="<svg version=\"1.1\" id=\"Layer_2\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n\"; width=\"12px\" height=\"17.955px\" viewBox=\"0 0 13 17.955\" enable-background=\"new 0 0 13 17.955\" xml:space=\"preserve\">\n";
  ptr +="<path fill=\"#FFFFFF\" d=\"M1.819,6.217C3.139,4.064,6.5,0,6.5,0s3.363,4.064,4.681,6.217c1.793,2.926,2.133,5.05,1.571,7.057\n";
  ptr +="c-0.438,1.574-2.264,4.681-6.252,4.681c-3.988,0-5.813-3.107-6.252-4.681C-0.313,11.267,0.026,9.143,1.819,6.217\"></path>\n";
  ptr +="</svg>\n";
  ptr +="</div>\n";
  ptr +="<div class=\"side-by-side humidity-text\">Humidity</div>\n";
  ptr +="<div class=\"side-by-side humidity\">";
  ptr +=(int)Humiditystat;
  ptr +="<span class=\"superscript\">%</span></div>\n";
  ptr +="</div>\n";
  
  ///Movement
  ptr +="<div class=\"data\">\n";
  ptr +="<div class=\"side-by-side\">\n";
  ptr +="<svg version='1.1' width='40px' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 458.667 458.667' style='enable-background:new 0 0 458.667 458.667;' xml:space='preserve'><g><path d='M250.667,85.333c23.467,0,42.667-19.2,42.667-42.667C293.333,19.2,274.133,0,250.667,0S208,19.2,208,42.667S227.2,85.333,250.667,85.333z'/><path d='M368,245.333v-42.667c-39.467,0-73.6-21.333-92.8-52.267l-20.267-34.133C247.467,103.467,233.6,96,218.667,96c-5.333,0-10.667,1.067-16,3.2l-112,45.867v100.267h42.667v-71.467l37.333-16L112,458.667h44.8L194.133,288L240,330.667v128h42.667V297.6l-43.733-43.733l12.8-64C279.467,224,321.067,245.333,368,245.333z'/></g></svg>\n";
  ptr +="</div>\n";
  ptr +="<div class=\"side-by-side humidity-text\">Movement</div>\n";
  ptr +="<div class=\"side-by-side move\">\n";
  ptr +=MoveStat;
  ptr +="</div>\n";
  ptr +="</div>\n";
  //end movement----------
  
  ptr +="</div>\n";
  ptr +="</body>\n";
  ptr +="</html>\n";
  return ptr;
}
