<form action="{{ route('suratmasuk.update', ['suratmasuk' => $data->id]) }}" class="row editform" id="editform"
  method="POST"> @method('PUT') @csrf

  <div class="col-md-8">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Isian Surat Masuk</h3>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <x-form.datepicker-stack name="date" id="date" value="{{ $data->date }}" readonly="readonly">
              Tanggal Surat<x-redstar />
            </x-form.datepicker-stack>
          </div>
          <div class="col-md-6">
            <x-form.txt-stack name="nomor" id="nomor" value="{{ $data->nomor }}"
              placeholder="Nomor">Nomor<x-redstar /></x-form.txt-stack>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <x-form.txtarea-stack name="perihal" id="perihal" placeholder="Perihal Surat">
              @slot('title')
                Perihal Surat<x-redstar />
              @endslot
              {{ $data->perihal }}
            </x-form.txtarea-stack>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <x-form.txt-stack name="asal" id="asal" value="{{ $data->asal }}" placeholder="Asal Surat">Asal
              Surat<x-redstar /></x-form.txt-stack>
          </div>
          <div class="col-md-6">
            <x-form.select-static-stack name="satker_id" id="satker_id">
              Tujuan<x-redstar />
              @slot('items', $satkers)
              @slot('current', $data->satker_id)
            </x-form.select-static-stack>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <x-form.txtarea-stack name="desc" id="desc" placeholder="Keterangan">
              @slot('title')
                Keterangan
              @endslot
              {{ $data->desc }}
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

        <h6 class="font-weight-bolder mb-3">Berkas Unggahan:</h6>
        <div class="text-dark-50 line-height-lg">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-between">
              @if ($data->hasMedia())
                <span class="font-weight-bold mr-15">Surat Masuk:</span>
                <span class="text-right">
                  <a href="{{ $data->getMedia()->first()->getUrl() }}" target="_blank" class="btn btn-icon btn-info">
                    <i class="flaticon-interface"></i>
                  </a>
                </span>
              @else
                <span class="font-weight-bold">Berkas belum ada</span>
              @endif
            </div>
          </div>
        </div>

        <x-separator margin="3" />

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
