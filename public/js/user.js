$(document).on("change", "#role_id", function (e) {
  if ($("#role_id").val() == 4) {
    $(".div-satker").show("fast");
  } else {
    $(".div-satker").hide("fast");
  }
});
