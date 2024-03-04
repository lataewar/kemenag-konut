<form action="{{ route('suratkeluar.berkas.store', ['id' => $data->id]) }}" class="row berkasform" id="berkasform"
  method="POST" enctype="multipart/form-data">
  @csrf
  <div class="col-md-12">
    <div class="card card-custom gutter-b">
      <div class="card-header">
        <h3 class="card-title">Unggah Berkas</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label>Nomor Surat</label>
          <input type="text" class="form-control" disabled="disabled" value="{{ $data->kombinasi }}" />
        </div>
        <div class="form-group">
          <label>Perihal</label>
          <textarea class="form-control" disabled="disabled" rows="3">{{ $data->perihal }}</textarea>
        </div>
        <input type="file" class="filepond" name="file">
      </div>
      <x-form.submit-group2 />
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
