<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <select class="form-control" name="{{ $name }}" {{ $attributes }}>
    <option value="" hidden>- Pilih Salah Satu -</option>
    @foreach ($items as $item)
      @if (isset($current) && $current == $item['id'])
        <option value="{{ $item['id'] }}" selected>{{ $item['name'] }}</option>
      @else
        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
      @endif
    @endforeach
  </select>
  <div class="invalid-feedback error-{{ $name }}"></div>
</div>
<!--end::Group-->