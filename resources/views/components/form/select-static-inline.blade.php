<!--begin::Group-->
<div class="form-group row">
  <label class="col-xl-3 col-lg-3 col-form-label">{!! $slot !!}</label>
  <div class="col-lg-9 col-xl-9">
    <select class="form-control form-control-lg" name="{{ $name }}" {{ $attributes }}>
      <option value="" hidden>- Pilih Salah Satu -</option>
      {!! $option !!}
    </select>
    <div class="invalid-feedback error-{{ $name }}"></div>
  </div>
</div>
<!--end::Group-->