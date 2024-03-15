<form action="{{ route('suratmasuk.store') }}" class="row createform" id="createform" method="POST">
  @csrf
  <div class="col-md-8">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Isian Surat Masuk</h3>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <x-form.datepicker-stack name="date" id="date" placeholder="Tanggal Surat" readonly="readonly">
              Tanggal Surat<x-redstar />
            </x-form.datepicker-stack>
          </div>
          <div class="col-md-6">
            <x-form.txt-stack name="nomor" id="nomor" placeholder="Nomor">Nomor<x-redstar /></x-form.txt-stack>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <x-form.txtarea-stack name="perihal" id="perihal" placeholder="Perihal Surat">
              @slot('title')
                Perihal Surat<x-redstar />
              @endslot
            </x-form.txtarea-stack>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <x-form.txt-stack name="asal" id="asal" placeholder="Asal Surat">Asal
              Surat<x-redstar /></x-form.txt-stack>
          </div>
          <div class="col-md-6">
            <x-form.select-static-stack name="satker_id" id="satker_id">
              Tujuan<x-redstar />
              @slot('items', $satkers)
              @slot('current', auth()->user()->role_id->isSatker() ?? null)
            </x-form.select-static-stack>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <x-form.txtarea-stack name="desc" id="desc" placeholder="Keterangan">
              @slot('title')
                Keterangan
              @endslot
            </x-form.txtarea-stack>
          </div>
        </div>

      </div>
      <x-form.submit-group2 />
    </div>
  </div>

  <div class="col-md-4">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Berkas</h3>
      </div>
      <div class="card-body">

        <label>Unggah Berkas: </label>
        <input type="file" class="filepond" name="file">

      </div>
    </div>
  </div>
</form>
<script>
  (function() {
    FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType,
      FilePondPluginFileValidateSize);
    const inputElement = document.querySelector('input[class="filepond"]');
    pond = FilePond.create(inputElement, {
      allowFileTypeValidation: true,
      acceptedFileTypes: ['application/pdf'],
      labelFileTypeNotAllowed: 'Masukkan berkas dengan format .pdf',
      allowFileSizeValidation: true,
      maxFileSize: '512KB',
      labelMaxFileSize: 'Ukuran maksimal berkas adalah {filesize}',
      labelMaxFileSizeExceeded: 'Berkas terlalu besar',
    });
    FilePond.setOptions({
      server: {
        url: 'files/',
        process: 'processberkas',
        revert: 'revert',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
      },
    });
  })();
</script>
