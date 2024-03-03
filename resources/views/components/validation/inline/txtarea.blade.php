<!--begin::Group-->
<div class="form-group row">
  <span class="col-xl-3 col-lg-3 col-form-label">{!! $title !!}</span>
  <div class="col-lg-9 col-xl-9">
    <textarea {{ $attributes->merge(['class' => 'form-control form-control-lg form-control-solid ']) }}>{{ $slot }}</textarea>
    <div class="invalid-feedback error-{{ $name }}"></div>
  </div>
</div>
<!--end::Group-->
