<form action="{{ route('role.store') }}" class="row createform" id="createform" method="POST">
  @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Tambah Role</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <x-form.txt-stack name="name" id="name" >Nama Role <x-redstar /></x-form.txt-stack>
          </div>
          <div class="col-md-6">
            <x-form.txtarea-stack name="desc" id="desc" placeholder="Keterangan">
              @slot('title') Keterangan @endslot
            </x-form.txtarea-stack>
          </div>
        </div>
      </div>
      <x-form.submit-group2 />
    </div>
    <div class="card card-custom bgi-no-repeat gutter-b" >
    </div>
  </div>
</form>