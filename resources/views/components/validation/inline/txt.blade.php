<!--begin::Group-->
<div class="form-group row">
  <span class="col-xl-3 col-lg-3 col-form-label">{!! $slot !!}</span>
  <div class="col-lg-9 col-xl-9">
    <input {{ $attributes->merge(['class' => 'form-control form-control-lg form-control-solid ']) }}>
    <div class="invalid-feedback error-{{ $name }}"></div>
  </div>
</div>
<!--end::Group-->
