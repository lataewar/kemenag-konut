$(document).on("change", "#metode", function (e) {
  if ($("#metode").val() == 0) {
    $(".txt-nomor").show("fast");
    $("#nomor").val("");
    $("#sisipan").val("");

    $(document).on("change", "#date", function (e) {
      ajaxCall(
        urx + "/manualcheck",
        "post",
        {
          kategori: $("#kategori").val(),
          data: $("#date").val(),
        },
        "json",
        function () {
          $(".datepicker_icon").addClass(
            "spinner spinner-primary spinner-right"
          );
          $(".datepicker_i").hide("fast");
        },
        function () {
          $(".datepicker_icon").removeClass(
            "spinner spinner-primary spinner-right"
          );
          $(".datepicker_i").show("fast");
        },
        function (response) {
          if (response.data) {
            $("#nomor").val(response.data);
          }
        }
      );
    });
  } else {
    $(".txt-nomor").hide("fast");
    $(document).off("change", "#date");
  }
});

const berkas = function (id) {
  ajaxCall(
    urx + "/" + id + "/berkas",
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
        back("show", "Upload Berkas");
        $(".viewform").html(response.data).show();
      }
    }
  );
};

$(document).on("submit", "#berkasform", function (e) {
  e.preventDefault();
  const formData = new FormData(document.getElementById("berkasform"));

  $.ajax({
    url: $(this).attr("action"),
    type: "POST",
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    cache: false,
    data: formData,
    beforeSend: function () {
      loader("show");
      $(".btn-edit").attr("disabled", true);
      $(".btn-edit").addClass("spinner spinner-white spinner-left");
    },
    complete: function () {
      loader("hide", 400);
      $(".btn-edit").removeAttr("disabled");
      $(".btn-edit").removeClass("spinner spinner-white spinner-left");
    },
    success: function (response) {
      succeedRes(response);
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
