<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
  <!--begin::Info-->
  <div class="d-flex align-items-center flex-wrap mr-1">
    <!--begin::Heading-->
    <div class="d-flex flex-column">
      <!--begin::Title-->
      <h2 class="text-white font-weight-bold my-2 mr-5">{{ $title }}</h2>
      <!--end::Title-->
      <!--begin::Breadcrumb-->
      <div class="d-flex align-items-center font-weight-bold my-2">
        <!--begin::Item-->
        <a href="#" class="opacity-75 hover-opacity-100">
          <i class="flaticon2-shelter text-white icon-1x"></i>
        </a>
        <!--end::Item-->
        <!--begin::Item-->
        {{ $breadcrumb ?? ' ' }}
        <!--end::Item-->
        <!--begin::Item-->
        <span class="label label-dot label-sm bg-white opacity-75 mx-3 bc-dot" style="display: none;"></span>
        <a href="{{ url()->current() }}#" class="text-white text-hover-white opacity-75 hover-opacity-100 bc-title"
          style="display: none;">Tambah Data</a>
        <!--end::Item-->
      </div>
      <!--end::Breadcrumb-->
    </div>
    <!--end::Heading-->
  </div>
  <!--end::Info-->
  <!--begin::Toolbar-->
  <div class="d-flex align-items-center">
    <!--begin::Button-->
    {{ $slot }}
    <!--end::Button-->
  </div>
  <!--end::Toolbar-->
</div>
