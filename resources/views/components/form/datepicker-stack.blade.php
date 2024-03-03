<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <div class="input-group date">
    <input type="text" class="form-control kt_datepicker" data-date-format="yyyy-mm-dd" name="{{ $name }}"
      {{ $attributes }}>
    <div class="input-group-append">
      <span class="input-group-text datepicker_icon">
        <i class="la la-calendar datepicker_i"></i>
      </span>
    </div>
    <div class="invalid-feedback error-{{ $name }}"></div>
  </div>
</div>
<!--end::Group-->
