<form action="{{ route('menu.store') }}" class="row createform" id="createform" method="POST">
  @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Tambah Menu</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <x-form.txt-stack name="name" id="name" >Nama Menu <x-redstar /></x-form.txt-stack>
            <x-form.txt-stack name="route" id="route" >Route </x-form.txt-stack>
            <x-form.switch-stack name="has_submenu" id="has_submenu" >
              @slot('checked') 0 @endslot
              Has Submenu 
            </x-form.switch-stack>
          </div>
          <div class="col-md-6">
            <x-form.txt-stack name="icon" id="icon" >Icon </x-form.txt-stack>
            <x-form.txtarea-stack name="desc" id="desc" placeholder="Keterangan">
              @slot('title') Keterangan @endslot
            </x-form.txtarea-stack>
          </div>
        </div>
      </div>
      <x-form.submit-group2 />
    </div>
  
    {{-- <div class="card card-custom card-stretch gutter-b"> --}}
    <div class="card card-custom bgi-no-repeat gutter-b" >
    </div>
  </div>
  <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-switch.js"></script>


</form>