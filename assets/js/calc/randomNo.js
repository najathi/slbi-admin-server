function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor(Math.random() * 10);
    n += randomNumber.toString();
  }
  return n;
}

function callNumber() {
  document.getElementById('num').value = randomNumber(9);
}