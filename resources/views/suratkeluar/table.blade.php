<div class="viewform" style="display: none;">

</div>
<div class="card card-custom gutter-b viewtable">
  <div class="card-body">
    <form action="{{ route('suratkeluar.multdelete') }}" id="form-multdelete">
      {{ csrf_field() }}
      <!--begin: Datatable-->
      <table class="table table-hover table-sriped table-bordered" id="KTDatatable">
        <thead>
          <tr>
            <th width="4%">
              <label class="checkbox checkbox-single">
                <input type="checkbox" id="check-all" />
                <span></span>
              </label>
            </th>
            <th width="4%" class="text-center">No</th>
            <th width="18%">Nomor Surat</th>
            <th width="35%">Perihal</th>
            <th width="10%">Tujuan</th>
            <th width="10%">Tanggal</th>
            <th width="9%">Berkas</th>
            <th width="5%" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      <!--end: Datatable-->
    </form>
  </div>
</div>
