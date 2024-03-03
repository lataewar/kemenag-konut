<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <select class="form-control" name="{{ $name }}" {{ $attributes }}>
    <option value="" hidden>- Pilih Salah Satu -</option>
    @foreach ($items as $item)
      <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
  </select>
  <div class="invalid-feedback error-{{ $name }}"></div>
</div>
<!--end::Group-->