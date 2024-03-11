@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/filepond/filepond.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/filepond/filepond-plugin-image-preview.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Surat Keluar" route="suratkeluar.index">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot
    <div class="default-btns">
      @can('multidelete nomor')
        <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;" class="btn-danger mr-2 btn-multdelete">
          Hapus Terpilih</x-btn.weight-bold-svg>
      @endcan

      @can('print nomor')
        <x-btn.a-weight-bold-svg svg="Files/DownloadedFile.svg" href="{{ route('suratkeluar.cetak') }}"
          class="btn-success mr-2 btn-report">
          Cetak</x-btn.a-weight-bold-svg>
      @endcan

      @can('create nomor')
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
  <input type="hidden" id="urx" value="{{ URL('suratkeluar') }}">
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
        data: 'nomor',
        name: 'full_nomor'
      },
      {
        data: 'perihal',
        name: 'perihal'
      },
      {
        data: 'tujuan',
        name: 'tujuan'
      },
      {
        data: 'date',
        name: 'date'
      },
      {
        data: 'berkas',
        name: 'berkas'
      },
      {
        data: 'aksi',
        name: 'aksi'
      },
    ];
    const columnDefs = [{
        targets: [0, 1, 7],
        orderable: false,
        className: 'text-center align-top font-size-xs'
      },
      {
        targets: [2, 3, 4, 5],
        orderable: false,
        className: 'align-top font-size-xs'
      },
      {
        targets: [6],
        orderable: false,
        className: 'text-center align-top font-size-xs'
      },
    ];
    const forms = ['perihal', 'date', 'klasifikasi_id', 'nomor'];
  </script>
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
  <script src="{{ asset('assets') }}/filepond/filepond.min.js"></script>
  <script src="{{ asset('assets') }}/filepond/filepond.jquery.js"></script>
  <script src="{{ asset('assets') }}/filepond/filepond-plugin-image-preview.min.js"></script>
  <script src="{{ asset('assets') }}/filepond/filepond-plugin-file-validate-size.min.js"></script>
  <script src="{{ asset('assets') }}/filepond/filepond-plugin-file-validate-type.min.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/bootstrap_.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/dt.js"></script>
  <script src="{{ asset('js') }}/suratkeluar.js"></script>
  <!--end::Page Scripts-->
@endpush
