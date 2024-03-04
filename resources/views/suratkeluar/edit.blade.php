<form action="{{ route('suratkeluar.update', ['suratkeluar' => $data->id]) }}" class="row editform" id="editform"
  method="POST">
  @method('PUT')
  @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Isian Surat Keluar</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <x-form.txt-stack name="" value="{{ $data->full_nomor }}" readonly>Nomor
            </x-form.txt-stack>
          </div>
          <div class="col-md-4">
            <x-form.txt-stack name="" value="{{ $data->date }}" readonly>Tanggal Surat
            </x-form.txt-stack>
          </div>
        </div>
        <div class="row">
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
              @slot('current', $data->spesimen_id)
            </x-form.select-static-stack2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <x-form.select-static-stack name="klasifikasi_id" id="klasifikasi_id">
              Klasifikasi Surat <x-redstar />
              @slot('items', $klasifikasis)
              @slot('current', $data->klasifikasi_id)
            </x-form.select-static-stack>
            <x-form.txtarea-stack name="perihal" id="perihal" placeholder="Perihal Surat">
              @slot('title') Perihal Surat<x-redstar /> @endslot
              {{ $data->perihal }}
            </x-form.txtarea-stack>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <x-form.txt-stack name="asal" id="asal" value="{{ $data->asal }}">Asal Surat </x-form.txt-stack>
          </div>
          <div class="col-md-4">
            <x-form.txt-stack name="tujuan" id="tujuan" value="{{ $data->tujuan }}">Tujuan Surat </x-form.txt-stack>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <x-form.txtarea-stack name="desc" id="desc" placeholder="Keterangan">
              @slot('title') Keterangan @endslot
              {{ $data->desc }}
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
    $('.pegawais').select2({
      placeholder: "Pilih Pegawai",
      allowClear: true
    });
  });
</script>
