window.addEventListener("resize", function() {
  "use strict";
  c.width = window.innerWidth;
  c.height = window.innerHeight;
});

window.onload = function() {
  "use strict";
  var c = document.getElementById("c"),
    ctx = c.getContext("2d");
  c.height = window.innerHeight;
  c.width = window.innerWidth;
  var character = 'abcdefghijklmnopqrstuvwxyz',
    font_size = 30,
    columns = c.width,
    lines = c.height,
    drops = [],
    tmp = [],
    x;
  for (x = 0; x < columns; x++) {
    drops[x] = lines + 1;
    tmp[x] = "";
  }

  function draw() {
    var i,
      text = character[Math.floor(Math.random() * character.length)];
    ctx.fillStyle = "rgba(0, 0, 0, 0.06)";
    ctx.fillRect(0, 0, c.width, c.height);
    ctx.font = font_size + "px MatrixCode";
    for (i = 0; i < drops.length; i++) {
      ctx.fillStyle = "#0F0";
      ctx.fillText(tmp[i], i * font_size, (drops[i] - 1) * font_size);
      ctx.fillStyle = "#FFF";
      ctx.fillText(text, i * font_size, drops[i] * font_size);
      tmp[i] = text;
      if (drops[i] * font_size > c.height && Math.random() > 0.975) {
        drops[i] = 0;
      }
      drops[i]++;
    }
  }
  setInterval(draw, 33);
};