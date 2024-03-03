<button type='button' class='btn btn-sm btn-clean btn-icon' 
  onclick="destroy({{ $slot }}, {{ $name }})"
  title='Hapus Data'>
  <span class='svg-icon svg-icon-md'>
    {!! file_get_contents("assets/media/svg/icons/General/Trash.svg") !!}
  </span>
</button>