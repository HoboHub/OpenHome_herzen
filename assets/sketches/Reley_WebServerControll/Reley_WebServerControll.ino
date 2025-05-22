#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

/* Установите здесь свои SSID и пароль */
const char* ssid = "yourwifiname";  // SSID
const char* password = "wifipas"; // password

ESP8266WebServer server(80);

uint8_t reley1 = D0;  //pin that connected with relay
bool reley1status = HIGH;

void setup() 
{
  Serial.begin(115200);
  delay(100);
  pinMode(reley1, OUTPUT);

  Serial.println("Connecting to ");
  Serial.println(ssid);

  // подключиться к вашей локальной wi-fi сети
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
  server.on("/reley1on", handle_reley1on);
  server.on("/reley1off", handle_reley1off);
  server.onNotFound(handle_NotFound);

  server.begin();
  Serial.println("HTTP server started");
}

void loop() 
{
  server.handleClient();
  
  if(reley1status)
    digitalWrite(reley1, HIGH);
  else
    digitalWrite(reley1, LOW);
}

void handle_OnConnect() 
{
  Serial.print("GPIO Status: ");
  if(reley1status)
    Serial.print("OFF");
  else
    Serial.print("ON");

  Serial.println("");
  server.send(200, "text/html", SendHTML(reley1status)); 
}

void handle_reley1on() 
{
  reley1status = HIGH;
  Serial.println("GPIO Status: OFF");
  server.send(200, "text/html", SendHTML(reley1status)); 
}

void handle_reley1off() 
{
  reley1status = LOW;
  Serial.println("GPIO Status: ON");
  server.send(200, "text/html", SendHTML(reley1status)); 
}

void handle_NotFound()
{
  server.send(404, "text/plain", "Not found");
}

String SendHTML(uint8_t reley1stat)
{
  String ptr = "<!DOCTYPE html> <html>\n";
  ptr +="<head><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=no\">\n";
  ptr +="<title>Reley Control</title>\n";
  ptr +="<style>html { font-family: Helvetica; display: inline-block; margin: 0px auto; text-align: center;}\n";
  ptr +="body{margin-top: 50px;} h1 {color: #444444;margin: 50px auto 30px;} h3 {color: #444444;margin-bottom: 50px;}\n";
  ptr +=".button {display: block;width: 80px;background-color: #1abc9c;border: none;color: white;padding: 13px 30px;text-decoration: none;font-size: 25px;margin: 0px auto 35px;cursor: pointer;border-radius: 4px;}\n";
  ptr +=".button-on {background-color: #1abc9c;}\n";
  ptr +=".button-on:active {background-color: #16a085;}\n";
  ptr +=".button-off {background-color: #34495e;}\n";
  ptr +=".button-off:active {background-color: #2c3e50;}\n";
  ptr +="p {font-size: 14px;color: #888;margin-bottom: 10px;}\n";
  ptr +=".state_icon {position: absolute; left: 15px; top: 15px;}\n"; //класс для иконки
  ptr +="</style>\n";
  ptr +="</head>\n";
  ptr +="<body>\n";
  
  if(reley1stat){
    ptr +="<p>Reley Status: OFF</p><a class=\"button button-on\" href=\"/reley1off\">ON</a>\n";
    //ptr +="<img width='40px' alt='lamp_off' src='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMy4wLjIsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDYwMi43IDYyNS4xIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MDIuNyA2MjUuMTsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGcgaWQ9IkxheWVyXzEiPg0KCTxnPg0KCQk8cGF0aCBkPSJNNDIwLjgsMTYzLjZjLTMyLjYtMzIuNS03NS45LTUwLjUtMTIyLTUwLjVzLTg5LjQsMTcuOS0xMjIsNTAuNWMtMzIuNiwzMi41LTUwLjUsNzUuOC01MC41LDEyMS45YzAsMzIuNCw5LDY0LDI2LjIsOTEuMw0KCQkJYzE1LDIzLjksMzUuNiw0My44LDU5LjksNTcuOXYyNS44djgwLjFjMCw0Ni43LDM4LDg0LjYsODQuNiw4NC42aDIuM2M0Ni43LDAsODQuNy0zOCw4NC43LTg0LjZ2LTgwLjFsMC0yNS4yDQoJCQljMjQuNi0xNCw0NS41LTMzLjksNjAuNy01Ny45YzE3LjQtMjcuNSwyNi41LTU5LjIsMjYuNS05MS45QzQ3MS4zLDIzOS40LDQ1My40LDE5Ni4xLDQyMC44LDE2My42TDQyMC44LDE2My42eiBNMjQyLjQsNTExLjR2LTM2DQoJCQloMTExLjd2MzZMMjQyLjQsNTExLjR6IE0yOTkuNCw1OTUuMWgtMi4zYy0yOS44LDAtNTQuMi0yNC01NC42LTUzLjhoMTExLjdDMzUzLjYsNTcxLjEsMzI5LjMsNTk1LjEsMjk5LjQsNTk1LjF6IE00MTkuNCwzNjEuMw0KCQkJYy0xNCwyMi4xLTMzLjcsMzkuOS01Nyw1MS42Yy01LjEsMi41LTguMyw3LjctOC4zLDEzLjRsMCwxOS4xSDI0Mi40di0xOS43YzAtNS42LTMuMi0xMC44LTguMi0xMy40DQoJCQljLTQ4LTI0LjUtNzcuOS03My4xLTc3LjktMTI2LjljMC0zOCwxNC44LTczLjgsNDEuNy0xMDAuNmMyNi45LTI2LjksNjIuNy00MS43LDEwMC44LTQxLjdjMzguMSwwLDczLjksMTQuOCwxMDAuOCw0MS43DQoJCQljMjYuOSwyNi45LDQxLjcsNjIuNiw0MS43LDEwMC42QzQ0MS4zLDMxMi40LDQzMy44LDMzOC42LDQxOS40LDM2MS4zTDQxOS40LDM2MS4zeiIvPg0KCQk8cGF0aCBkPSJNMzMxLjYsMjczLjVoLTM4LjJsMzQuNy01NC4xYzQuNS03LDIuNC0xNi4yLTQuNS0yMC43Yy03LTQuNS0xNi4yLTIuNC0yMC43LDQuNWwtNDkuNSw3Ny4xYy0zLDQuNi0zLjIsMTAuNS0wLjUsMTUuMw0KCQkJYzIuNiw0LjgsNy43LDcuOCwxMy4yLDcuOGgzOC40bC00MS42LDY1LjZjLTQuNCw3LTIuNCwxNi4zLDQuNiwyMC43YzIuNSwxLjYsNS4zLDIuMyw4LDIuM2M1LDAsOS44LTIuNSwxMi43LTdsNTYuMi04OC43DQoJCQljMi45LTQuNiwzLjEtMTAuNSwwLjUtMTUuM0MzNDIuMSwyNzYuNSwzMzcuMSwyNzMuNSwzMzEuNiwyNzMuNUwzMzEuNiwyNzMuNXoiLz4NCgk8L2c+DQo8L2c+DQo8ZyBpZD0i0KHQu9C+0LlfMiI+DQoJPHBhdGggZD0iTTI4OC44LDh2NzljMCw2LjQsMTAsNi40LDEwLDBWOEMyOTguOCwxLjYsMjg4LjgsMS42LDI4OC44LDh6Ii8+DQoJPHBhdGggZD0iTTQ4MS4zLDc0LjVsLTUxLDUxYy00LjYsNC42LDIuNSwxMS42LDcuMSw3LjFsNTEtNTFDNDkyLjksNzcsNDg1LjksNjkuOSw0ODEuMyw3NC41eiIvPg0KCTxwYXRoIGQ9Ik01OTcuOCwyNjloLTkyYy02LjQsMC02LjQsMTAsMCwxMGg5MkM2MDQuMywyNzksNjA0LjMsMjY5LDU5Ny44LDI2OXoiLz4NCgk8cGF0aCBkPSJNMTM4LjQsMTYyLjVjLTI1LjMtMjUuMy01MC43LTUwLjctNzYtNzZjLTQuNi00LjYtMTEuNiwyLjUtNy4xLDcuMWMyNS4zLDI1LjMsNTAuNyw1MC43LDc2LDc2DQoJCUMxMzUuOSwxNzQuMSwxNDIuOSwxNjcsMTM4LjQsMTYyLjV6Ii8+DQoJPHBhdGggZD0iTTg2LjgsMjk0aC04MmMtNi40LDAtNi40LDEwLDAsMTBoODJDOTMuMywzMDQsOTMuMywyOTQsODYuOCwyOTR6Ii8+DQoJPHBhdGggZD0iTTEyOC4zLDQxMy41Yy0xNi43LDE2LjctMzMuMywzMy4zLTUwLDUwYy00LjYsNC42LDIuNSwxMS42LDcuMSw3LjFjMTYuNy0xNi43LDMzLjMtMzMuMyw1MC01MA0KCQlDMTM5LjksNDE2LDEzMi45LDQwOC45LDEyOC4zLDQxMy41eiIvPg0KCTxwYXRoIGQ9Ik01MTQuNCw0NTIuNWwtNDgtNDhjLTQuNi00LjYtMTEuNiwyLjUtNy4xLDcuMWw0OCw0OEM1MTEuOSw0NjQuMSw1MTguOSw0NTcsNTE0LjQsNDUyLjV6Ii8+DQo8L2c+DQo8L3N2Zz4NCg=='>\n";
    ptr+="<svg id='Layer_1' class='state_icon' width='40px' enable-background='new 0 0 512.322 512.322' viewBox='0 0 512.322 512.322' width='512' xmlns='http://www.w3.org/2000/svg'><g><path d='m378.197 50.497c-32.598-32.564-75.939-50.497-122.037-50.497s-89.438 17.934-122.035 50.497c-32.602 32.567-50.556 75.869-50.556 121.928-.001 32.409 9.054 63.996 26.185 91.346 14.997 23.943 35.601 43.815 59.952 57.915v25.814 80.136c0 46.696 37.99 84.686 84.686 84.686h2.292c46.752 0 84.788-37.99 84.788-84.686v-80.135l-.001-25.167c24.643-14.016 45.511-33.909 60.724-57.977 17.375-27.489 26.559-59.278 26.559-91.931-.002-46.06-17.956-89.362-50.557-121.929zm-178.491 348.006v-36.002h111.765v36.002zm56.977 83.819h-2.292c-29.863 0-54.197-24.065-54.664-53.819h111.721c-.466 29.754-24.846 53.819-54.765 53.819zm120.151-233.994c-13.966 22.096-33.697 39.936-57.06 51.589-5.089 2.539-8.305 7.736-8.305 13.423l.001 19.161h-111.763v-19.728c0-5.643-3.167-10.808-8.195-13.368-48.078-24.474-77.944-73.129-77.942-126.979 0-38.041 14.83-73.805 41.758-100.705 26.931-26.904 62.741-41.721 100.832-41.721 38.092 0 73.902 14.816 100.835 41.721 26.928 26.9 41.758 62.664 41.758 100.705-.001 26.97-7.58 53.217-21.919 75.902z'/><path d='m288.999 160.49h-38.225l34.718-54.095c4.475-6.972 2.45-16.251-4.522-20.726-6.971-4.474-16.25-2.451-20.726 4.521l-49.544 77.198c-2.963 4.616-3.169 10.481-.54 15.295 2.63 4.813 7.678 7.807 13.163 7.807h38.408l-41.638 65.688c-4.435 6.997-2.358 16.265 4.639 20.7 2.492 1.579 5.27 2.333 8.017 2.333 4.967 0 9.828-2.466 12.684-6.971l56.236-88.719c2.929-4.62 3.11-10.468.474-15.261-2.639-4.793-7.675-7.77-13.144-7.77z'/></g></svg>\n";
  }
  else {
    ptr +="<p>Reley Status: ON</p><a class=\"button button-off\" href=\"/reley1on\">OFF</a>\n";
    ptr+="<svg id='Layer_1' width='40px' class='state_icon' enable-background='new 0 0 512 512' viewBox='0 0 512 512' width='512' xmlns='http://www.w3.org/2000/svg'><g><g><path d='m422.622 166.912c0-92.183-74.598-166.913-166.623-166.912-92.023.001-166.622 74.729-166.621 166.912-.001 64.939 37.022 121.213 91.073 148.805l-.001 32.58 149.889.001-.001-31.98c54.706-27.365 92.284-83.986 92.284-149.406z' fill='#ffda2d'/></g></g><path d='m260.654 508.915h-10.518c-38.486 0-69.686-31.199-69.686-69.686v-93.405h149.889v93.405c0 38.486-31.199 69.686-69.685 69.686z' fill='#fff4f4'/><path d='m255.999 0c-.435 0-.867.013-1.302.017v348.281h75.643l-.001-31.979c54.706-27.365 92.284-83.986 92.284-149.406-.001-92.184-74.599-166.914-166.624-166.913z' fill='#fdbf00'/><path d='m254.697 508.915h1.855c40.692 0 73.788-33.079 73.788-73.885v-89.205h-75.643z' fill='#eee1dc'/><g><g><path d='m231.245 280.133c-2.904 0-5.841-.799-8.476-2.473-7.398-4.703-9.594-14.529-4.904-21.948l44.024-69.647h-40.609c-5.799 0-11.136-3.174-13.917-8.278s-2.562-11.322.57-16.217l52.383-81.849c4.732-7.392 14.543-9.538 21.913-4.794 7.372 4.744 9.513 14.582 4.782 21.975l-36.708 57.355h40.415c5.783 0 11.108 3.157 13.896 8.238 2.788 5.082 2.596 11.282-.501 16.18l-59.458 94.066c-3.019 4.777-8.158 7.391-13.41 7.392z' fill='#ff9100'/></g></g><g fill='#ff641a'><path d='m290.719 154.257h-36.022v31.808h7.192l-7.192 11.378v59.413l49.417-78.18c3.097-4.899 3.289-11.099.501-16.18-2.788-5.082-8.113-8.239-13.896-8.239z'/><path d='m282.23 74.928c-7.37-4.744-17.181-2.598-21.913 4.794l-5.62 8.781v58.89l32.315-50.49c4.73-7.393 2.59-17.231-4.782-21.975z'/></g><path d='m180.45 423.13v14.985c0 40.806 32.987 73.885 73.679 73.885h2.423c40.692 0 73.788-33.079 73.788-73.885v-14.985z' fill='#00337a'/><path d='m254.697 512h1.855c40.692 0 73.788-33.079 73.788-73.885v-14.985h-75.643z' fill='#002659'/></svg>\n";
  }
    

  ptr +="</body>\n";
  ptr +="</html>\n";
  return ptr;
}
