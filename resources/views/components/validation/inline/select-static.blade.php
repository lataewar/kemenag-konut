<!--begin::Group-->
<div class="form-group row">
  <label class="col-xl-3 col-lg-3 col-form-label">{!! $slot !!}</label>
  <div class="col-lg-9 col-xl-9">
    <select {{ $attributes->merge(['class' => 'form-control form-control-lg form-control-solid ']) }}>
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
</div>
<!--end::Group-->
