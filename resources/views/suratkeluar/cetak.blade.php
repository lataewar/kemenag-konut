@extends('layouts.template')

@push('css')
@endpush

@section('subheader')
  <x-subheader title="Surat Keluar" route="suratkeluar.index">
    @slot('breadcrumb')
      <x-bc.item route="#">Cetak Surat Keluar</x-bc.item>
    @endslot
    <div class="default-btns">
      <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('suratkeluar.index') }}"
        class="btn-success mr-2 btn-report">
        Kembali</x-btn.a-weight-bold-svg>
    </div>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('suratkeluar.postcetak') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Cetak Surat Keluar</h3>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label class="col-form-label text-right col-md-4 col-sm-12">Rentang Waktu</label>
            <div class="col-md-4 col-sm-12">
              <div class="input-daterange input-group" id="kt_datepicker_5" data-date-format="yyyy-mm-dd">
                <input type="text" class="form-control" name="start" value="{{ date('Y-m-d') }}" readonly />
                <div class="input-group-append">
                  <span class="input-group-text"> ke </span>
                </div>
                <input type="text" class="form-control" name="end" value="{{ date('Y-m-d') }}" readonly />
              </div>
              <span class="form-text text-muted">Pilih rentang waktu berdasarkan tanggal</span>
            </div>
            <div class="col-md-4 col-sm-12">
              <button type="submit" class="btn btn-primary btn-cetak">Cetak</button>
            </div>
          </div>

          @include('layouts.validation-error')

        </div>
      </div>
    </div>
  </form>
  <!--end::Card-->
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      var arrows;
      if (KTUtil.isRTL()) {
        arrows = {
          leftArrow: '<i class="la la-angle-right"></i>',
          rightArrow: '<i class="la la-angle-left"></i>'
        }
      } else {
        arrows = {
          leftArrow: '<i class="la la-angle-left"></i>',
          rightArrow: '<i class="la la-angle-right"></i>'
        }
      }

      // range picker
      $('#kt_datepicker_5').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: 'bottom right',
        templates: arrows,
        autoclose: true,
      });
    });
  </script>
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/bootstrap_.js"></script>
  <!--end::Page Scripts-->
@endpush
