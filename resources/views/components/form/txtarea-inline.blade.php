<!--begin::Group-->
<div class="form-group row">
  <label class="col-xl-3 col-lg-3 col-form-label">{!! $slot !!}</label>
  <div class="col-lg-9 col-xl-9">
    <textarea class="form-control form-control-lg" name="{{ $name }}"></textarea>
    <div class="invalid-feedback error-{{ $name }}"></div>
  </div>
</div>
<!--end::Group-->