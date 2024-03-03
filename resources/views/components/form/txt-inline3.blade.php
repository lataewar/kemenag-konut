<!--begin::Group-->
<div class="form-group row">
  <label class="col-form-label col-3 text-primary text-right text-left">{!! $slot !!}</label>
  <div class="col-lg-9">
    <div class="input-group input-group-solid">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="{{ $icon }}"></i>
        </span>
      </div>
      <input type="text" class="form-control form-control-solid" value="{{ $value }}" />
    </div>
  </div>
</div>
<!--end::Group-->