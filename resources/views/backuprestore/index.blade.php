@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Kode Instansi" route="kdins.index">
    @slot('breadcrumb')
      <x-bc.item route="#">Detail</x-bc.item>
    @endslot
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <div class="viewdata">
    <div class="viewform">
      <form action="{{ route('backup.store') }}" class="row editform" id="editform" method="POST"
        enctype="multipart/form-data"> @csrf @method('PUT')
        <div class="col-md-12">
          <div class="card card-custom card-stretch gutter-b">
            <div class="card-header">
              <h3 class="card-title">Backup & Restore</h3>
            </div>
            <div class="card-body p-0">
              <div class="row justify-content-center mb-4 py-5">
                <button type="button" class="btn btn-primary font-weight-bolder py-4 mr-4"> Backup Surat
                  Masuk</button>
                <button type="button" class="btn btn-success font-weight-bolder py-4 ml-4"> Backup Surat
                  Keluar</button>
              </div>
              <x-separator margin="5" />
              <div class="py-10 px-10">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Backup</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ formatTW($item->created_at) }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/bootstrap_.js"></script>
  <!--end::Page Scripts-->
@endpush
