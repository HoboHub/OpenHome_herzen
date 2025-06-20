Open Home
Работа для ВКР:
## "Разработка веб-интерфейса системы управления умным домом"
Салаватов М.В. 
ИВТ 1.1 (4 курс)


## Описание проекта
Цель — создание удобного и расширяемого интерфейса, позволяющего взаимодействовать с различными IoT-устройствами (умные розетки, датчики и т.д.) через браузер.


## 🧰 Cтэк

### Backend:
- PHP
- SQL
- MySQL
- PhpMyAdmin/OpenServer

### Frontend:
- HTML
- CSS
- JavaScript
- JQuery UI (Draggable)

### Микроконтроллер:
- Arduino IDE
- Язык: C++ (упрощённый)

---

## 🔧 Оборудование

- **NodeMCU v3 (ESP8266)** — микроконтроллер с поддержкой Wi-Fi
- **1-канальный модуль реле** — для управления питанием нагрузки
- **AC/DC преобразователь** — для питания модуля
- **DHT11** — датчик температуры и влажности
- **HS-SR501** — датчик движения

---

## 📦 Принцип работы

### Устройство умной розетки:
Модуль на основе ESP8266 подключается к Wi-Fi сети и предоставляет веб-интерфейс для управления реле. Через него можно включать/выключать бытовые приборы удалённо.

### Веб-интерфейс:
- Позволяет добавлять устройства по IP-адресу
- Отображает состояния устройств в виде отдельных **фреймов**
- Поддерживает группировку фреймов в **комнаты**
- Сохраняет расположение комнат и фреймов в **LocalStorage**

![Интерфейс](https://github.com/user-attachments/assets/c9687c1e-2521-4390-9a67-94cda52e1b5b)


### Фреймы:
- Каждый фрейм представляет собой отдельное устройство
- Может содержать кнопки управления или данные с датчиков
- Доступен только внутри своей комнаты

Пример фреймов:

![Фрейм с лампочкой](https://github.com/user-attachments/assets/75f5f65a-35d8-4938-b6fc-a7bdf553c5d1)
![Фрейм - датчики температуры, влажности, движения](https://github.com/user-attachments/assets/a347a51b-450a-487a-85ef-4af5909ac379)


### Комнаты:
- Логическое разделение устройств по зонам (например, «Гостиная», «Кухня»)
- При удалении комнаты удаляются все связанные с ней фреймы
- Размеры и позиции комнат сохраняются локально
  
![Комнаты](https://github.com/user-attachments/assets/ef610968-6961-42f7-bb7b-1cb6e2624cc8)


---

## 🔄 Пример использования

1. Нажмите кнопку **"+"** в интерфейсе
2. Введите **FrameID** и **IP-адрес** устройства
3. В интерфейсе появится новый фрейм, ссылающийся на указанное устройство
4. Если устройство подключено к сети — отобразятся элементы управления или данные с датчиков
5. Фрейм можно перемещать и масштабировать внутри комнаты
   
![Создание фрейма](https://github.com/user-attachments/assets/c076062f-0e78-4bdd-8e1a-6f8fc5bb1bff)

---

## 📐 Архитектура

- **UML-диаграмма классов**
![Диаграмма классов](https://github.com/user-attachments/assets/95bb7247-d0a8-4cc5-9638-c2722748e096)

  
- **Диаграмма последовательности действий**
![Диаграмма последовательности](https://github.com/user-attachments/assets/b93829f4-2e87-4756-817d-11bc007d7415)


## 🎥 Preview:
- Удаленное управление розеткой с лампой в качестве нагрузки
<img src="https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExNXljZ2I4amw4Zjd3dnNld3cxYXJvNGhjODkyNTVmamN0ZWZraWt4dyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/c2EjIMNOWVHYg5zGAD/giphy.gif" title="Smart Socket" alt="Iot Remote socket"/>


- Создание фрейма
  
![media4_upload](https://github.com/user-attachments/assets/b65438cd-1f20-4297-bb7e-77296eb91b22)


- Создание и работа с комнатами
  
![media5_upload](https://github.com/user-attachments/assets/423993fc-8129-4220-bcb8-9b1c2924c510)



