<form action="{{ route('permission.update', ['permission' => $data->id]) }}" class="row editform" id="editform"
  method="POST">
  @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Edit Permission</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <x-form.txt-stack name="name" id="name" value="{{ $data->name }}">Nama
              Permission<x-redstar /></x-form.txt-stack>
          </div>
        </div>
      </div>
      <x-form.submit-group2 />
    </div>

  </div>

</form>
