function updateClock() {
  var currentTime = new Date();
  var currentHours = currentTime.getHours();
  var currentMinutes = currentTime.getMinutes();
  var currentSeconds = currentTime.getSeconds();

  // Pad the minutes and seconds with leading zeros, if required
  currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
  currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

  // Choose either "AM" or "PM" as appropriate
  var timeOfDay = currentHours < 12 ? "AM" : "PM";

  // time with seconds
  var currentTimeString =
    currentHours +
    ":" +
    currentMinutes +
    ":" +
    currentSeconds +
    " " +
    timeOfDay;
  //without seconds
  var currentTimeNoSec = currentHours + ":" + currentMinutes + " " + timeOfDay;

  $("#clock_content").html(currentTimeNoSec);
}

$(document).ready(function () {
  setInterval("updateClock()", 1000);
});
