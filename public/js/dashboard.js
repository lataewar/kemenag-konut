const create = function () {
  ajaxCall(
    $("#nomor_url").val(),
    "get",
    null,
    "json",
    function () {
      loader("show");
    },
    function () {
      $(".viewtable").hide();
      loader("hide");
    },
    function (response) {
      if (response.data) {
        $(".modal-isi").html(response.data).show();
        initBootsrap();
      }
    }
  );
};

$(document).on("submit", ".createform", function (e) {
  e.preventDefault();
  const formData = new FormData(document.getElementById("createform"));

  $.ajax({
    url: $(this).attr("action"),
    type: "POST",
    processData: false,
    contentType: false,
    cache: false,
    data: formData,
    beforeSend: function () {
      loader("show");
      $(".btn-simpan").attr("disabled", true);
      $(".btn-simpan").addClass("spinner spinner-white spinner-left");
    },
    complete: function () {
      loader("hide", 500);
      $(".btn-simpan").removeAttr("disabled");
      $(".btn-simpan").removeClass("spinner spinner-white spinner-left");
    },
    success: function (response) {
      if (response.sukses) {
        sweetAlert("Sukses", response.sukses, "success");
        $("#staticBackdrop").modal("hide");
        $(".modal-isi").html("");
      } else {
        sweetAlert("Gagal", response.gagal, "error");
      }
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    error: function (xhr, ajaxOptions, thrownError) {
      loader("hide", 400);
      if (xhr.status === 422) {
        validate(JSON.parse(xhr.responseText).errors);
      } else {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    },
  });
});
