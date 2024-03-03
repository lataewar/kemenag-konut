<form action="{{ route('akses.sync', ['role' => $app->data->id]) }}" class="row aksiform" id="aksiform" method="POST">
  @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Role Akses</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label>Akses Ke Menu</label>
          <select class="form-control select2" name="menus[]" multiple="multiple">
            @foreach ($app->menus as $menu)
              <option value="{{ $menu->id }}"
                @foreach ($app->data->menus as $item)
                @if ($item->id == $menu->id)
                  selected
                @endif @endforeach>
                {{ $menu->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <x-form.submit-group2 />
    </div>
  </div>
</form>
<script>
  $(document).ready(function() {
    // multi select
    $('.select2').select2({
      placeholder: 'Select a state',
    });
  });
</script>
