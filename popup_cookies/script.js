(function () {
  "use strict";
  var $popup = document.getElementById("popup-cookie");
  var $button = document.getElementById("popup-cookie-btn");
  $button.addEventListener("click", function (ev) {
    ev.preventDefault();
    localStorage.setItem("cookie_popup", "true");
    $popup.classList.remove("active");
  });
  if (!localStorage.getItem("cookie_popup")) {
    setTimeout(function () {
      $popup.classList.add("active");
    }, 2000);
  }
})();
