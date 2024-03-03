<!--begin::Group-->
<div class="form-group row">
  <label class="col-form-label col-3 text-right text-primary text-left">{!! $slot !!}</label>
  <div class="col-9">
    <textarea class="form-control form-control-solid" disabled>{{ $value }}</textarea>
  </div>
</div>
<!--end::Group-->