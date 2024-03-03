<button type='button' class='btn btn-sm btn-clean btn-icon mr-2' 
  onclick="edit({{ $slot }})"
  title='Ubah Data'>
  <span class='svg-icon svg-icon-md'>
    {!! file_get_contents("assets/media/svg/icons/Design/Edit.svg") !!}
  </span>
</button>