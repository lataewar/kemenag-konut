<form action="{{ route('permission.sync', ['role' => $app->id]) }}" class="row aksiform" id="aksiform" method="POST">
  @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Perizinan</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label>Beri Izin ke aksi</label>
          <select class="form-control select2" name="permissions[]" multiple="multiple">
            @foreach ($app->permissions as $permission)
              <option value="{{ $permission }}"
                @foreach ($app->data as $item)
                @if ($item == $permission)
                  selected
                @endif @endforeach>
                {{ $permission }}</option>
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
