<!--begin::Group-->
<div class="form-group row">
  <label class="col-form-label col-3 text-primary text-right text-left">{!! $slot !!}</label>
  <div class="col-9">
    <input class="form-control form-control-solid" type="text" value="{{ $value }}" disabled/>
  </div>
</div>
<!--end::Group-->