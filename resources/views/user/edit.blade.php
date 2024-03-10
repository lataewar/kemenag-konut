<form action="{{ route('user.update', ['user' => $data->id]) }}" class="row editform" id="editform" method="POST">
  @method('PUT')
  @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Isian User</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 bgi-no-repeat"
            style="background-position: center; background-size: 80% auto; background-image: url(assets/media/bg/working.png)">
          </div>
          <div class="col-md-6">
            <input type="hidden" name="r_type" value="edit">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <x-form.txt-stack name="name" id="name" value="{{ $data->name }}">Nama
              <x-redstar /></x-form.txt-stack>
            <x-form.input-stack type="email" name="email" id="email" value="{{ $data->email }}">Email
              <x-redstar /></x-form.input-stack>
            <x-form.input-stack type="password" name="password" id="password" placeholder="Password">Password
              <x-redstar /></x-form.input-stack>
            <x-form.input-stack type="password" name="password_confirmation" id="password_confirmation"
              placeholder="Konfirmasi Password">Konfirmasi Password <x-redstar /></x-form.input-stack>
            <x-form.select-static-stack name="role_id" id="role_id">
              Role <x-redstar />
              @slot('items', \App\Enums\UserRole::toArray())
              @slot('current', $data->role_id)
            </x-form.select-static-stack>
            <div class="div-satker" @if (!$data->role_id->isSatker()) style="display: none;" @endif>
              <x-form.select-static-stack name="satker_id" id="satker_id">
                Satuan Kerja<x-redstar />
                @slot('items', $satkers)
                @slot('current', $data->satker_id)
              </x-form.select-static-stack>
            </div>
          </div>
        </div>
      </div>
      <x-form.submit-group2 />
    </div>

    {{-- <div class="card card-custom card-stretch gutter-b"> --}}
    <div class="card card-custom bgi-no-repeat gutter-b">
    </div>
  </div>


</form>
