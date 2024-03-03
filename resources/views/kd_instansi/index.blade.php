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
      <form action="{{ route('kdins.update', ['kdin' => $data->id]) }}" class="row editform" id="editform" method="POST"
        enctype="multipart/form-data"> @csrf @method('PUT')
        <div class="col-md-12">
          <div class="card card-custom card-stretch gutter-b">
            <div class="card-header">
              <h3 class="card-title">Isian Kode Instansi</h3>
            </div>
            <div class="card-body p-0">
              <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                <div class="col-xl-12 col-xxl-9">

                  <x-validation.inline.txt type="text" name="kode" id="kode" placeholder="Kode"
                    value="{{ $data->kode ?? '' }}">
                    Kode<x-redstar />
                  </x-validation.inline.txt>

                  <x-validation.inline.txt type="text" name="name" id="name" placeholder="Nama"
                    value="{{ $data->name ?? '' }}">
                    Nama<x-redstar />
                  </x-validation.inline.txt>

                  <x-validation.inline.txtarea name="desc" id="desc" placeholder="Keterangan">
                    @slot('title')
                      Keterangan<x-redstar />
                    @endslot
                    {{ $data->desc ?? '' }}
                  </x-validation.inline.txtarea>

                  <!--begin::Wizard Actions-->
                  <div class="d-flex justify-content-between border-top mt-5 pt-10">
                    <div class="mr-2">
                    </div>
                    <div>
                      <button type="submit"
                        class="btn btn-success font-weight-bolder text-uppercase px-9 py-4 btn-simpan">Simpan</button>
                    </div>
                  </div>
                  <!--end::Wizard Actions-->

                </div>
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
  <script>
    const forms = ['name', 'kode', 'desc'];
  </script>
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/bootstrap_.js"></script>
  <!--end::Page Scripts-->
@endpush
