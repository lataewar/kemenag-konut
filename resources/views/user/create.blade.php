<form action="{{ route('user.store') }}" class="row createform" id="createform" method="POST">
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
            <x-form.txt-stack name="name" id="name" placeholder="Nama">Nama <x-redstar /></x-form.txt-stack>
            <x-form.input-stack type="email" name="email" id="email" placeholder="Email">Email
              <x-redstar /></x-form.input-stack>
            <x-form.input-stack type="password" name="password" id="password" placeholder="Password">Password
              <x-redstar /></x-form.input-stack>
            <x-form.input-stack type="password" name="password_confirmation" id="password_confirmation"
              placeholder="Konfirmasi Password">Konfirmasi Password <x-redstar /></x-form.input-stack>
            <x-form.select-static-stack name="role_id" id="role_id">
              Role <x-redstar />
              @slot('items', \App\Enums\UserRole::toArray())
            </x-form.select-static-stack>
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
