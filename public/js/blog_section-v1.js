$("document").ready(function (e) {
  jQuery(".blog .card-slider").slick({
    slidesToShow: 1,
    autoplay: true,
    slidesToScroll: 1,
    dots: false,
    centerMode: true,
    centerPadding: "20vw",
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          centerMode: false,
        },
      },
    ],
  });
});

let blog_cards = document.querySelectorAll(".blog .card");
let blog_card;
let blog_modal = document.querySelector(".blog .modal-blog");
let blog_closeButton = document.querySelector(".blog .modal__close-button");
let blog_page = document.querySelector(".blog .page");
const blog_cardBorderRadius = 20;
const blog_openingDuration = 600;
const blog_closingDuration = 600;
const blog_timingFunction = "cubic-bezier(.76,.01,.65,1.38)";

var blog_Scrollbar = window.Scrollbar;
blog_Scrollbar.init(document.querySelector(".blog .modal__scroll-area"));

function flipAnimation(first, last, options) {
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
      ${blog_cardBorderRadius / deltas.width}px / ${blog_cardBorderRadius / deltas.height}px`,
        transform: `
        translate(${deltas.left}px, ${deltas.top}px) 
        scale(${deltas.width}, ${deltas.height})
      `,
      },
      {
        transformOrigin: "top left",
        transform: "none",
        borderRadius: `${blog_cardBorderRadius}px`,
      },
    ],
    options
  );
}

blog_cards.forEach((item) => {
  item.addEventListener("click", (e) => {
    jQuery(".blog .card-slider").slick("slickPause");
    blog_card = e.currentTarget;
    blog_page.dataset.modalState = "opening";
    blog_card.classList.add("card--opened");
    blog_card.style.opacity = 0;
    
    var blog_card_index = blog_card.id.split("-")[1];
    var blog_card_data = getBlogData(blog_card_index);
    $(".blog .modal-wrapper .modal__content .paragraph").html(blog_card_data["bodyPost"]);
    $(".blog .modal-wrapper .card__title").html(blog_card_data["title"]);
    $(".blog .modal-wrapper .card__category").html(blog_card_data["category"]);
    $(".blog .modal-wrapper .card__duration").html(blog_card_data["date"]);
    $(".blog .modal-wrapper .card__background img").attr('src', blog_card_data["pict"]);
    $(".blog .modal-wrapper .content-footer .comment-field form").attr('action', blog_card_data["commentRoute"]);
    $(".blog .modal-wrapper .content-footer #like-form").attr('action', blog_card_data["likeRoute"]);
    $(".blog .modal-wrapper .content-footer #likes-count").attr('likes-number', blog_card_data["likesCount"]);
    $(".blog .modal-wrapper .content-footer #comments-count").attr('comments-number', blog_card_data["commentsCount"]);
    $(".blog .modal-wrapper .content-footer #fb-route").attr('href', blog_card_data["fbRoute"]);
    $(".blog .modal-wrapper .content-footer #twitter-route").attr('href', blog_card_data["twitterRoute"]);
    if (blog_card_data["commentsCount"] == 0) {
      $(".blog .modal-wrapper .content-footer .comments-list").html("<i>there are no comments so far...</i>");
    } else {
      $(".blog .modal-wrapper .content-footer .comments-list").html(blog_card_data["comments"]);
    }

    $(".blog").css('z-index', 0);

    document.querySelector("body").classList.add("no-scroll");

    let animation = flipAnimation(blog_card, blog_modal, {
      duration: blog_openingDuration,
      easing: blog_timingFunction,
      fill: "both",
    });

    animation.onfinish = () => {
      blog_page.dataset.modalState = "open";
      animation.cancel();
    };
  });
});

blog_closeButton.addEventListener("click", (e) => {
  blog_page.dataset.modalState = "closing";
  document.querySelector("body").classList.remove("no-scroll");

  let animation = flipAnimation(blog_card, blog_modal, {
    duration: blog_closingDuration,
    easing: blog_timingFunction,
    direction: "reverse",
    fill: "both",
  });

  animation.onfinish = () => {
    blog_page.dataset.modalState = "closed";
    blog_card.style.opacity = 1;
    blog_card.classList.remove("card--opened");
    jQuery(".blog .card-slider").slick("slickPlay");
    animation.cancel();
  };

  $(".blog").css('z-index', -1);
});
