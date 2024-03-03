<form action="{{ route('suratkeluar.store') }}" class="row createform" id="createform" method="POST">
  @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Isian Surat Keluar</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <x-form.select-static-stack2 name="is_otomatis" id="metode">
              Metode Penomoran<x-redstar />
              @slot('items', \App\Enums\MetodeSuratEnum::toArray())
            </x-form.select-static-stack2>
          </div>
          <div class="col-md-4">
            <x-form.datepicker-stack name="date" id="date" placeholder="Tanggal Surat" readonly="readonly">
              Tanggal Surat<x-redstar />
            </x-form.datepicker-stack>
          </div>
        </div>

        <div class="row txt-nomor" style="display: none;">
          <div class="col-md-4">
            <x-form.txt-stack name="nomor" id="nomor" placeholder="Nomor">Nomor<x-redstar /></x-form.txt-stack>
          </div>
          <div class="col-md-4">
            <x-form.txt-stack name="sisipan" id="sisipan" placeholder="Kode Tambahan">Kode
              Tambahan</x-form.txt-stack>
          </div>
        </div>

        <div class="row">

          <div class="col-md-4">
            <x-form.select-static-stack2 name="kategori" id="kategori">
              Kategori Surat<x-redstar />
              @slot('items', \App\Enums\KategoriSuratEnum::toArray())
            </x-form.select-static-stack2>
          </div>

          <div class="col-md-4">
            <x-form.select-static-stack2 name="sifat" id="sifat">
              Sifat<x-redstar />
              @slot('items', \App\Enums\SifatSuratEnum::toArray())
            </x-form.select-static-stack2>
          </div>

          <div class="col-md-4">
            <x-form.select-static-stack2 name="spesimen_id" id="spesimen_id">
              Pejabat Spesimen<x-redstar />
              @slot('items', $spesimens)
            </x-form.select-static-stack2>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <x-form.select-static-stack name="klasifikasi_id" id="klasifikasi_id">
              Klasifikasi Surat<x-redstar />
              @slot('items', $klasifikasis)
            </x-form.select-static-stack>
            <x-form.txtarea-stack name="perihal" id="perihal" placeholder="Perihal Surat">
              @slot('title') Perihal Surat<x-redstar />@endslot
            </x-form.txtarea-stack>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <x-form.txt-stack name="asal" id="asal" placeholder="Asal Surat">Asal Surat </x-form.txt-stack>
          </div>
          <div class="col-md-4">
            <x-form.txt-stack name="tujuan" id="tujuan" placeholder="Tujuan Surat">Tujuan Surat </x-form.txt-stack>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <x-form.txtarea-stack name="desc" id="desc" placeholder="Keterangan">
              @slot('title') Keterangan @endslot
            </x-form.txtarea-stack>
          </div>
        </div>

      </div>
      <x-form.submit-group2 />
    </div>
  </div>
</form>
<script>
  $(document).ready(function() {
    // basic
    $('#klasifikasi_id').select2({
      placeholder: "Pilih Klasifikasi Surat",
      allowClear: true
    });
  });
</script>
