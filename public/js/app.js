const urx = $("#urx").val();
const loader = function (type, delay = 250) {
  if (type === "show") {
    $("#status_").fadeIn("fast");
    $("#preloader_").fadeIn("fast");
  } else {
    $("#status_").fadeOut();
    $("#preloader_").delay(delay).fadeOut("slow");
  }
};

const back = function (type, title = "") {
  $(".bc-title").text(title);
  if (type === "show") {
    $(".default-btns").hide();
    $(".btn-back").show();
    $(".bc-dot").show();
    $(".bc-title").show();
  } else {
    $(".default-btns").show();
    $(".btn-back").hide();
    $(".bc-dot").hide();
    $(".bc-title").hide();
  }
};

const backEvent = function () {
  $(document).on("click", ".btn-back", function (e) {
    $(".viewform").html("");
    $(".viewtable").show("fast");
    back("hide");
  });
};

const toggleMBD = function () {
  if ($(".check-id:checked").length) {
    $(".btn-multdelete").show();
  } else {
    $(".btn-multdelete").hide();
  }
};

const sweetAlert = function (title, text, icon) {
  Swal.fire({
    title,
    html: text,
    icon,
    buttonsStyling: false,
    confirmButtonText: "Ya, Saya Mengerti!",
    customClass: {
      confirmButton: "btn btn-primary",
    },
    timer: 10000,
  });
};

const succeedRes = function (response, type = 1) {
  if (response.sukses) {
    if (type) back("hide");
    showData();
    sweetAlert("Sukses", response.sukses, "success");
  } else {
    sweetAlert("Gagal", response.gagal, "error");
  }
};

const validate = function (error) {
  let arrError = [];
  for (const prop in error) {
    arrError.push(prop);
    $("#" + prop).addClass("is-invalid");
    $(".error-" + prop).html(error[prop]);
  }
  forms
    .filter((item) => !arrError.includes(item))
    .forEach((item) => {
      $("#" + item).removeClass("is-invalid");
      $(".error-" + item).html("");
    });
};

const initBootsrap = function () {
  KTBootstrapDatepicker.init();
};

const ajaxCall = function (
  url,
  type,
  data,
  dataType,
  beforeSend,
  complete,
  success
) {
  $.ajax({
    url,
    type,
    data,
    dataType,
    beforeSend,
    complete,
    success,
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    error: function (xhr, ajaxOptions, thrownError) {
      loader("hide", 400);
      if (xhr.status === 422) {
        validate(JSON.parse(xhr.responseText).errors);
      } else if (xhr.status === 419) {
        sweetAlert(
          "Gagal",
          "Sesi anda telah habis, silahkan login kembali",
          "error"
        );
      } else if (xhr.status === 403) {
        sweetAlert(
          "Gagal",
          "Anda tidak memiliki akses pada fitur ini.",
          "error"
        );
      } else {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    },
  });
};
