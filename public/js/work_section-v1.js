$("document").ready(function (e) {
  jQuery(".work .card-slider").slick({
    slidesToShow: 4,
    autoplay: true,
    slidesToScroll: 4,
    dots: false,
    responsive: [
      {
        breakpoint: 980,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
});

let work_cards = document.querySelectorAll(".work .card");
let work_card;
let work_modal = document.querySelector(".work .modal-work");
let work_closeButton = document.querySelector(".work .modal__close-button");
let work_page = document.querySelector(".work .page");
const work_cardBorderRadius = 0;
const work_openingDuration = 600;
const work_closingDuration = 600;
const work_timingFunction = "cubic-bezier(.76,.01,.65,1.38)";

var work_Scrollbar = window.Scrollbar;
work_Scrollbar.init(document.querySelector(".work .modal__scroll-area"));

function work_flipAnimation(first, last, options) {
  let firstRect = first.getBoundingClientRect();
  let lastRect = last.getBoundingClientRect();

  let deltas = {
    top: firstRect.top - lastRect.top,
    left: firstRect.left - lastRect.left,
    width: firstRect.width / lastRect.width,
    height: firstRect.height / lastRect.height,
  };

  return last.animate(
    [
      {
        transformOrigin: "top left",
        borderRadius: `
    ${work_cardBorderRadius / deltas.width}px / ${work_cardBorderRadius / deltas.height}px`,
        transform: `
      translate(${deltas.left}px, ${deltas.top}px) 
      scale(${deltas.width}, ${deltas.height})
    `,
      },
      {
        transformOrigin: "top left",
        transform: "none",
        borderRadius: `${work_cardBorderRadius}px`,
      },
    ],
    options
  );
}

work_cards.forEach((item) => {
  item.addEventListener("click", (e) => {
    jQuery(".work .card-slider").slick("slickPause");
    work_card = e.currentTarget;
    work_page.dataset.modalState = "opening";
    work_card.classList.add("card--opened");
    work_card.style.opacity = 0;

    var work_card_index = work_card.id.split("-")[1];
    var work_card_data = getWorkData(work_card_index);
    $(".work .modal-wrapper .modal__content").html(work_card_data["bodyPost"]);
    $(".work .modal-wrapper .card__title").html(work_card_data["title"]);
    $(".work .modal-wrapper .card__category").html(work_card_data["category"]);
    $(".work .modal-wrapper .card__duration").html(work_card_data["date"]);
    $(".work .modal-wrapper .card__background img").attr('src', work_card_data["pict"]);

    $(".work").css('z-index', 0);

    document.querySelector("body").classList.add("no-scroll");

    let animation = work_flipAnimation(work_card, work_modal, {
      duration: work_openingDuration,
      easing: work_timingFunction,
      fill: "both",
    });

    animation.onfinish = () => {
      work_page.dataset.modalState = "open";
      animation.cancel();
    };
  });
});

work_closeButton.addEventListener("click", (e) => {
  work_page.dataset.modalState = "closing";
  document.querySelector("body").classList.remove("no-scroll");

  let animation = work_flipAnimation(work_card, work_modal, {
    duration: work_closingDuration,
    easing: work_timingFunction,
    direction: "reverse",
    fill: "both",
  });

  animation.onfinish = () => {
    work_page.dataset.modalState = "closed";
    work_card.style.opacity = 1;
    work_card.classList.remove("card--opened");
    jQuery(".work .card-slider").slick("slickPlay");
    animation.cancel();
  };

  $(".work").css('z-index', -1);

});
