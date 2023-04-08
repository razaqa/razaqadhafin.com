$("document").ready(function (e) {
  setTimeout(function () {
    $("head").append('<style type="text/css"></style>');
    var newStyleElement = $("head").children(":last");
    newStyleElement.html("#content{display: block; opacity: 1;}");

    $("head").append('<style type="text/css"></style>');
    var newStyleElement = $("head").children(":last");
    newStyleElement.html(".loader {height: 0;width: 0;margin: 0;display: none;}");

    $("#nav-logo").addClass("rotate-scale-up-hor");
    $("#nav-title").addClass("rotate-hor-center");

    var url = new URL(window.location.href);
    target = url.hash == "" ? null : url.hash;
    targetId = target == null ? "headline" : target.replace("#", "");
    for (var i = 0; i < divs.length; i++) {
      if (divs[i].id == targetId) {
        divIndex = i;
      }
    }
    _handleScroll();
  }, 3200);

  var tid = setTimeout(headlineText, 3000);
  function headlineText() {
    var headlineDisplay = $("#headline-text1").css("display");
    if (headlineDisplay == "none") {
      $("#headline-text1").css("display", "block");
      $("#headline-text2").css("display", "none");
    } else {
      $("#headline-text1").css("display", "none");
      $("#headline-text2").css("display", "block");
    }
    tid = setTimeout(headlineText, 3000);
  }
});

window.addEventListener("mousemove", handleMouseMove);
window.addEventListener("resize", handleWindowResize);

const spansSlow = document.querySelectorAll(".spanSlow");
const spansFast = document.querySelectorAll(".spanFast");

let width = window.innerWidth;

function handleMouseMove(e) {
  let normalizedPosition = e.pageX / (width / 2) - 1;
  let speedSlow = 100 * normalizedPosition;
  let speedFast = 200 * normalizedPosition;
  spansSlow.forEach((span) => {
    span.style.transform = `translate(${speedSlow}px)`;
  });
  spansFast.forEach((span) => {
    span.style.transform = `translate(${speedFast}px)`;
  });
}

function handleWindowResize() {
  width = window.innerWidth;
}
