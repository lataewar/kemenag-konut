const showData = function () {
  ajaxCall(urx + '/dt', 'post', { type: 'table' }, 'json', null, null, function (response) {
    $('.viewdata').html(response.data);
    $('#KTDatatable').DataTable({
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: urx + '/dt',
        type: 'POST',
        complete: function () {
          toggleMBD();
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
        },
      },
      columnDefs,
      columns,
      responsive: true,
    });
  });
};

const create = function () {
  ajaxCall(
    urx + '/create',
    'get',
    null,
    'json',
    function () {
      loader('show');
    },
    function () {
      $('.viewtable').hide();
      loader('hide');
    },
    function (response) {
      if (response.data) {
        back('show', 'Tambah Data');
        $('.viewform').html(response.data).show();
        initBootsrap();
      }
    }
  );
};

const store = function () {
  $(document).on('submit', '.createform', function (e) {
    e.preventDefault();
    const formData = new FormData(document.getElementById('createform'));

    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,
      data: formData,
      beforeSend: function () {
        loader('show');
        $('.btn-simpan').attr('disabled', true);
        $('.btn-simpan').addClass('spinner spinner-white spinner-left');
      },
      complete: function () {
        loader('hide', 500);
        $('.btn-simpan').removeAttr('disabled');
        $('.btn-simpan').removeClass('spinner spinner-white spinner-left');
      },
      success: function (response) {
        succeedRes(response);
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      error: function (xhr, ajaxOptions, thrownError) {
        loader('hide', 400);
        if (xhr.status === 422) {
          validate(JSON.parse(xhr.responseText).errors);
        } else {
          alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
        }
      },
    });
  });
};

const show = function (id) {
  ajaxCall(
    urx + '/' + id,
    'get',
    null,
    'json',
    function () {
      loader('show');
    },
    function () {
      $('.viewtable').hide();
      loader('hide');
    },
    function (response) {
      if (response.data) {
        back('show', 'Detail Data');
        $('.viewform').html(response.data).show();
      }
    }
  );
};

const edit = function (id) {
  ajaxCall(
    urx + '/' + id + '/edit',
    'get',
    null,
    'json',
    function () {
      loader('show');
    },
    function () {
      $('.viewtable').hide();
      loader('hide');
    },
    function (response) {
      if (response.data) {
        back('show', 'Ubah Data');
        $('.viewform').html(response.data).show();
        initBootsrap();
      }
    }
  );
};

const update = function () {
  $(document).on('submit', '.editform', function (e) {
    e.preventDefault();
    const formData = new FormData(document.getElementById('editform'));
    formData.append('_method', 'PUT');

    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,
      data: formData,
      beforeSend: function () {
        loader('show');
        $('.btn-edit').attr('disabled', true);
        $('.btn-edit').addClass('spinner spinner-white spinner-left');
      },
      complete: function () {
        loader('hide', 400);
        $('.btn-edit').removeAttr('disabled');
        $('.btn-edit').removeClass('spinner spinner-white spinner-left');
      },
      success: function (response) {
        succeedRes(response);
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      error: function (xhr, ajaxOptions, thrownError) {
        loader('hide', 400);
        if (xhr.status === 422) {
          validate(JSON.parse(xhr.responseText).errors);
        } else {
          alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
        }
      },
    });
  });
};

const destroy = function (id, name) {
  Swal.fire({
    title: `Apakah anda yakin?`,
    text: `Menghapus '${name}'`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      ajaxCall(
        urx + '/' + id,
        'delete',
        { id, name },
        'json',
        function () {
          loader('show');
        },
        function () {
          loader('hide');
        },
        function (response) {
          succeedRes(response, 0);
        }
      );
    }
  });
};

const multiplydelete = function () {
  $(document).on('click', '#check-all', function (e) {
    if ($(this).is(':checked')) {
      $('.check-id').prop('checked', true).change();
    } else {
      $('.check-id').prop('checked', false).change();
    }
  });

  $(document).on('change', '.check-id', function (e) {
    if ($(this).is(':checked')) {
      $(this).closest('tr').addClass('tr-active');
    } else {
      $(this).closest('tr').removeClass('tr-active');
    }
    toggleMBD();
  });

  $(document).on('click', '.btn-multdelete', function (e) {
    e.preventDefault();
    let datas = $('.check-id:checked');
    if (datas.length === 0) {
      sweetAlert('Perhatian', 'Belum ada data yang dipilih.', 'error');
    } else {
      Swal.fire({
        title: `Apakah anda yakin?`,
        text: `Menghapus ${datas.length} data`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {
          ajaxCall(
            $('#form-multdelete').attr('action'),
            'post',
            $('#form-multdelete').serialize(),
            'json',
            function () {
              loader('show');
            },
            function () {
              loader('hide');
            },
            function (response) {
              succeedRes(response, 0);
            }
          );
        }
      });
    }
  });
};

$(document).ready(function () {
  showData();
  backEvent();
  store();
  update();
  multiplydelete();
});
