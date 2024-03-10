@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="User" route="kdkla.index">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot
    <div class="default-btns">
      @can('multidelete klasifikasi')
        <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;" class="btn-danger mr-2 btn-multdelete">
          Hapus Terpilih</x-btn.weight-bold-svg>
      @endcan

      @can('create klasifikasi')
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
  <input type="hidden" id="urx" value="{{ URL('kdkla') }}">
  <div class="viewdata">

  </div>
  <!--end::Card-->
@endsection

@push('js')
  <script>
    const columns = [{
        data: 'cb',
        name: 'cb'
      },
      {
        data: null,
        sortable: false,
        render: function(data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        data: 'kode',
        name: 'kode'
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
        data: 'aksi',
        name: 'aksi'
      },
    ];
    const columnDefs = [{
        targets: [0, 5],
        orderable: false,
        className: 'text-center'
      },
      {
        targets: [2, 3],
        orderable: true
      },
    ];
    const forms = ['name', 'kode', 'desc'];
  </script>
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/bootstrap_.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
