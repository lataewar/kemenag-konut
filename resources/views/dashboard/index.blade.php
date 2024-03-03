@extends('layouts.template')

@section('content')
<!--begin::Row-->
<div class="row">
  <div class="col-xl-12">
    <div class="row">
      <div class="col-xl-6">
        <div class="row">
          <div class="col-xl-6">
            <!--begin::Tiles Widget 12-->
            <div class="card card-custom gutter-b" style="height: 150px">
              <div class="card-body">
                <span class="svg-icon svg-icon-3x svg-icon-success">
                  {!! file_get_contents("assets/media/svg/icons/Communication/Thumbtack.svg") !!}
                </span>
                <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $lastnomor }}</div>
                <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Nomor</a>
              </div>
            </div>
            <!--end::Tiles Widget 12-->
          </div>
          <div class="col-xl-6">
            <!--begin::Tiles Widget 11-->
            <div class="card card-custom bg-primary gutter-b" style="height: 150px">
              <div class="card-body">
                <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                  {!! file_get_contents("assets/media/svg/icons/Communication/Outgoing-mail.svg") !!}
                </span>
                <div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3">{{ formatNomor($suratkeluar) }}</div>
                <a href="{{ route('suratkeluar.index') }}" class="text-inverse-primary font-weight-bold font-size-lg mt-1">Surat Keluar</a>
              </div>
            </div>
            <!--end::Tiles Widget 11-->
          </div>
        </div>
        <!--begin::Tiles Widget 13-->
        <div class="card card-custom bgi-no-repeat gutter-b" style="height: 175px; background-color: #663259; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url({{ asset('assets') }}/media/svg/patterns/taieri.svg)">
          <!--begin::Body-->
          <div class="card-body d-flex align-items-center">
            <div>
              <h3 class="text-white font-weight-bolder line-height-lg mb-5">Pengambilan Nomor
                <br />Surat Keluar
              </h3>
              {{-- <a href='{{ route('suratkeluar.index') }}' class="btn btn-success font-weight-bold px-6 py-3">Ambil Nomor</a> --}}
              <!-- Button trigger modal-->
              <input type="hidden" id="urx" value="{{ URL('suratkeluar') }}">
              <button type="button" onclick="create()" class="btn btn-success font-weight-bold px-6 py-3" data-toggle="modal" data-target="#staticBackdrop">
                Ambil Nomor
              </button>
            </div>
          </div>
          <!--end::Body-->
        </div>
        <!--end::Tiles Widget 13-->
      </div>
      <div class="col-xl-6">
        <!--begin::Mixed Widget 14-->
        <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b card-stretch" style="background-image: url({{ asset('assets') }}/media/stock-600x600/img-16.jpg)">
          <!--begin::Body-->
          <div class="card-body d-flex flex-column align-items-start justify-content-start">
            <div class="p-1 flex-grow-1">
              <h3 class="text-white font-weight-bolder line-height-lg mb-5">Selamat Datang {{ auth()->user()->name }},
                <br />Pada Aplikasi Penomoran Surat Secara Online
              </h3>
            </div>
            <a href='{{ route('suratkeluar.cetak') }}' class="btn btn-link btn-link-warning font-weight-bold">Cetak rekap surat keluar
              <span class="svg-icon svg-icon-lg svg-icon-warning">
                {!! file_get_contents("assets/media/svg/icons/Navigation/Arrow-right.svg") !!}
              </span></a>
          </div>
          <!--end::Body-->
        </div>
        <!--end::Mixed Widget 14-->
      </div>
    </div>
  </div>
</div>
<!--end::Row-->
<!-- Modal-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ambil Nomor Surat Keluar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-isi">
        <div class="d-flex justify-content-center w-100 p-7">
          <div class="spinner spinner-success spinner-lg"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
<script src="{{ asset('js') }}/bootstrap_.js"></script>
<script src="{{ asset('js') }}/app.js"></script>
<script src="{{ asset('js') }}/suratkeluar.js"></script>
<script src="{{ asset('js') }}/dashboard.js"></script>
<!--end::Page Vendors-->
@endpush