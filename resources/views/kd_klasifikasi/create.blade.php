<form action="{{ route('kdkla.store') }}" class="row createform" id="createform" method="POST"> @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Isian Kode Klasifikasi</h3>
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

            <x-validation.inline.txtarea name="desc" id="desc" placeholder="Keterangan" rows="5">
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
                <button type="button"
                  class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4 mr-2 btn-back"
                  data-wizard-type="action-prev">Batal</button>
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
