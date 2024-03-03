// Class definition

var KTBootstrapDatepicker = (function () {
  var arrows;
  if (KTUtil.isRTL()) {
    arrows = {
      leftArrow: '<i class="la la-angle-right"></i>',
      rightArrow: '<i class="la la-angle-left"></i>',
    };
  } else {
    arrows = {
      leftArrow: '<i class="la la-angle-left"></i>',
      rightArrow: '<i class="la la-angle-right"></i>',
    };
  }

  // Private functions
  var demos = function () {
    // input group layout
    $('.kt_datepicker')
      .datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        // orientation: 'top right',
        orientation: 'bottom right',
        templates: arrows,
        autoclose: true,
      })
      .datepicker('setDate', 'now');

    $('.datepicker_default')
      .datepicker({
        autoclose: true,
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: 'bottom left',
        templates: arrows,
      })
      .datepicker('setDate', '0');

    $('.datepicker_nodefault').datepicker({
      autoclose: true,
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      orientation: 'bottom left',
      templates: arrows,
    });
  };

  return {
    // public functions
    init: function () {
      demos();
    },
  };
})();

// jQuery(document).ready(function () {
//   KTBootstrapDatepicker.init();
// });
