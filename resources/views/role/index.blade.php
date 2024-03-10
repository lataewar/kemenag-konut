@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Role" route="role.index">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot
    <div class="default-btns">
      @can('create role')
        <x-btn.weight-bold-svg svg="Design/Flatten.svg" onclick="create()" class="btn-success btn-create">
          Tambah Data</x-btn.weight-bold-svg>
      @endcan
    </div>
    <x-btn.weight-bold-svg svg="Navigation/Angle-left.svg" style="display: none;" class="btn-primary ml-2 btn-back">
      Kembali</x-btn.weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ URL('role') }}">
  <div class="viewdata">

  </div>
  <!--end::Card-->
@endsection

@push('js')
  <script>
    const columns = [{
        data: null,
        sortable: false,
        render: function(data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'desc',
        name: 'desc'
      },
      {
        data: 'menus_count',
        name: 'menus_count'
      },
      {
        data: 'permissions_count',
        name: 'permissions_count'
      },
      {
        data: 'aksi',
        name: 'aksi'
      },
    ];
    const columnDefs = [{
        targets: [0, 3, 4, 5],
        orderable: false,
        className: 'text-center'
      },
      {
        targets: [1, 2],
        orderable: true
      },
    ];
    const forms = ['name'];
  </script>
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/bootstrap_.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/dt.js"></script>
  <script>
    const akses = function(id) {
      ajaxCall(
        urx + '/' + id + '/akses',
        'get',
        null,
        'json',
        function() {
          loader('show');
        },
        function() {
          $('.viewtable').hide();
          loader('hide');
        },
        function(response) {
          if (response.data) {
            back('show', 'Role Akses');
            $('.viewform').html(response.data).show();
            initBootsrap();
          }
        }
      );
    };

    const izin = function(id) {
      ajaxCall(
        urx + '/' + id + '/permission',
        'get',
        null,
        'json',
        function() {
          loader('show');
        },
        function() {
          $('.viewtable').hide();
          loader('hide');
        },
        function(response) {
          if (response.data) {
            back('show', 'Role Akses');
            $('.viewform').html(response.data).show();
            initBootsrap();
          }
        }
      );
    };

    $(document).on('submit', '.aksiform', function(e) {
      e.preventDefault();
      const formData = new FormData(document.getElementById('aksiform'));

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        beforeSend: function() {
          loader('show');
          $('.btn-edit').attr('disabled', true);
          $('.btn-edit').addClass('spinner spinner-white spinner-left');
        },
        complete: function() {
          loader('hide', 400);
          $('.btn-edit').removeAttr('disabled');
          $('.btn-edit').removeClass('spinner spinner-white spinner-left');
        },
        success: function(response) {
          succeedRes(response);
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        error: function(xhr, ajaxOptions, thrownError) {
          loader('hide', 400);
          if (xhr.status === 422) {
            validate(JSON.parse(xhr.responseText).errors);
          } else {
            alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
          }
        },
      });
    });
  </script>
  <!--end::Page Scripts-->
@endpush
