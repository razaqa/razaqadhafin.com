$(document).ready(function () {
  $(".scroll-down-btn").on("click", function (event) {
    if (this.hash !== "") {
      event.preventDefault();

      var hash = this.hash;

      $("html, body").animate(
        {
          scrollTop: $(hash).offset().top,
        },
        800,
        function () {
          window.location.hash = hash;
        }
      );
    }
  });
});

function changeMetaContent(metaName, newMetaContent) {
  $("meta").each(function() {

    if($(this).attr("name") == metaName) {
      $(this).attr("content" , newMetaContent);
    };
  });
}