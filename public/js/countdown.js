function getId(id) {
  return document.getElementById(id);
}

// Set the date we're counting down to
var countDownDate = new Date("Jul 29, 2020 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's time string
  var currentDateTime = new Date().getTime();

  // Find the difference between current date and the count down date
  var difference = countDownDate - currentDateTime;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(difference / (1000 * 60 * 60 * 24));
  var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((difference % (1000 * 60)) / 1000);

  // Display the result in the elements respectively
  getId("time-days").innerText = days;
  getId("time-hours").innerText = hours;
  getId("time-minutes").innerText = minutes;
  getId("time-seconds").innerText = seconds;

  // If it is done counting down
  if (difference < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "WE ARE HERE!";
  }
}, 1000);