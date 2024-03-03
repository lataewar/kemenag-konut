<div class="viewform" style="display: none;">

</div>
<div class="card card-custom gutter-b viewtable">
  <div class="card-body">
    <form action="{{ route('kdkla.multdelete') }}" id="form-multdelete">
      {{ csrf_field() }}
      <!--begin: Datatable-->
      <table class="table table-hover" id="KTDatatable">
        <thead>
          <tr>
            <th>
              <label class="checkbox checkbox-single">
                <input type="checkbox" id="check-all"/>
                <span></span>
              </label>
            </th>
            <th>No</th>
            <th>Kode</th>
            <th>Name</th>
            <th>Keterangan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
      <!--end: Datatable-->
    </form>
  </div>
</div>