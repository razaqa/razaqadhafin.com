var body = $("html, body"),
  win = $(window),
  divs = $(".section-to-scroll"),
  divsLen = divs.length - 1,
  lastScroll = 0,
  divIndex = 0,
  scrolling = false,
  target = null;

// win.on("scroll", _handleScroll);

function _handleScroll(e) {
  
  if (scrolling) {
    return false;
  }

  scrolling = true;

  if (target == null) {
    if (win.scrollTop() > lastScroll) {
      if (divIndex < divsLen) {
        divIndex++;
      } else {
        scrolling = false;
        return false;
      }
    } else {
      if (divIndex > 0) {
        divIndex--;
      } else {
        scrolling = false;
        return false;
      }
    }

    $("body").css("opacity", 0);
    body.stop(true).animate(
      {
        scrollTop: divs.eq(divIndex).offset().top,
        opacity: 1,
      },
      2500,
      function () {
        setTimeout(function () {
          scrolling = false;

          lastScroll = win.scrollTop();

          target = null;
        }, 50);
      }
    );
  } else {
    $("body").css("opacity", 0);
    body.stop(true).animate(
      {
        scrollTop: $(target).offset().top,
        opacity: 1,
      },
      2500,
      function () {
        setTimeout(function () {
          scrolling = false;

          lastScroll = win.scrollTop();

          target = null;
        }, 50);
      }
    );
  }
}
