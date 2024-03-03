<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <div class="input-group date">
    <input type="text" class="form-control datepicker_nodefault" data-date-format="yyyy-mm-dd" name="{{ $name }}" {{ $attributes }}>
    <div class="input-group-append">
      <span class="input-group-text">
        <i class="la la-calendar"></i>
      </span>
    </div>
  </div>
  <div class="invalid-feedback error-{{ $name }}"></div>
</div>
<!--end::Group-->