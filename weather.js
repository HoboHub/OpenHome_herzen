$(document).ready(function () {
  $.get(
    "https://api.openweathermap.org/data/2.5/weather",
    {
      id: "498817", //insert id of your city
      appid: "afff3a7ce74be14fc34c0e78c16cd14a", //INSERT YOUR API KEY by openweathermap.org
    },
    function (data) {
      // console.log(data);

      //получение времени восхода и заката
      let unixrise = data.sys.sunrise;
      let unixset = data.sys.sunset;
      let sunrise = new Date(unixrise * 1000);
      let sunriseMin = sunrise.getMinutes();
      sunriseMin = sunriseMin < 10 ? "0" + sunriseMin : sunriseMin;
      let sunriseHour = sunrise.getHours();
      let sunriseTime = sunriseHour + ":" + sunriseMin;

      let sunset = new Date(unixset * 1000);
      let sunsetMin = sunset.getMinutes();
      sunsetMin = sunsetMin < 10 ? "0" + sunsetMin : sunsetMin;
      let sunsetHour = sunset.getHours();
      let sunsetTime = sunsetHour + ":" + sunsetMin;

      // console.log(sunriseTime);
      // console.log(sunsetTime);
      //---------------------------------
      let sun = "";
      sun += "Восход: <b>" + sunriseTime + "</b><br>";
      sun += "Закат: <b>" + sunsetTime + "</b><br>";
      $("#sun").html(sun);
      //------------------------------

      //вывод информации о погоде в регионе (Санкт-Петербург)
      let out = "";
      out += data.name + "<br>";
      out += "Погода: <b>" + data.weather[0].main + "</b><br>";
      out +=
        '<p style="text-align:center"<img src="https://openweathermap.org/img/w/' +
        data.weather[0].icon +
        '.png"></p>';
      out +=
        'Температура: <span style="color:#FF1F44"><b>' +
        Math.round(data.main.temp - 273) +
        "&#176;C</b></span><br>";
      out += "Влажность: <b>" + data.main.humidity + "%</b><br>";
      out +=
        "Давление: <b>" +
        Math.round(data.main.pressure * 0.00750063755419211 * 100) +
        " мм.рт.ст.</b><br>";
      out += "Видимость: <b>" + data.visibility / 1000 + " км</b><br>";
      // console.log(data.main);
      $("#weather").html(out); //в блок с id = weather вставляются полученные значения
      //----------------------
    }
  );
});

//498817 - Питер
//apiKey (appid) - afff3a7ce74be14fc34c0e78c16cd14a
