(function () {
  FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
  const inputElement = document.querySelector('input[class="filepond"]');
  pond = FilePond.create(inputElement, {
    allowFileTypeValidation: true,
    acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
    labelFileTypeNotAllowed: 'Masukkan format jpg / jpeg / png',
    allowFileSizeValidation: true,
    maxFileSize: '2MB',
    labelMaxFileSize: 'Ukuran maksimal berkas adalah {filesize}',
    labelMaxFileSizeExceeded: 'Berkas terlalu besar',
  });
  FilePond.setOptions({
    server: {
      url: 'files/',
      process: 'process',
      revert: 'revert',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
    },
  });
})();
