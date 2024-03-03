<?php

namespace App\Helpers;

class DtHelper
{
  public static function showBtn($id)
  {
    $svg = file_get_contents("assets/media/svg/icons/General/Visible.svg");
    return "<button type='button' class='btn btn-sm btn-clean btn-icon mr-2' 
            onclick=\"show('" . $id . "')\" 
            title='Detail'><span class='svg-icon svg-icon-md'>" . $svg . "</span></button>";
  }

  public static function editBtn($id)
  {
    $svg = file_get_contents("assets/media/svg/icons/Design/Edit.svg");
    return "<button type='button' class='btn btn-sm btn-clean btn-icon mr-2' 
            onclick=\"edit('" . $id . "')\" 
            title='Ubah Data'><span class='svg-icon svg-icon-md'>" . $svg . "</span></button>";
  }

  public static function deleteBtn($id, $name)
  {
    $svg = file_get_contents("assets/media/svg/icons/General/Trash.svg");
    return "<button type='button' class='btn btn-sm btn-clean btn-icon mr-2' 
            onclick=\"destroy('" . $id . "', '" . $name . "')\" 
            title='Hapus Data'><span class='svg-icon svg-icon-md'>" . $svg . "</span></button>";
  }

  public static function defaultBtn($fn, $id, $hint, $icon = "General/Unlock.svg")
  {
    $svg = file_get_contents("assets/media/svg/icons/$icon");
    return "<button type='button' class='btn btn-sm btn-clean btn-icon mr-2' 
            onclick=\"$fn('$id')\" 
            title='$hint'><span class='svg-icon svg-icon-md'>$svg</span></button>";
  }

  public static function btn($route, $hint, $icon = "Layout/Layout-top-panel-5.svg")
  {
    $svg = file_get_contents("assets/media/svg/icons/" . $icon);
    return "<a href='" . $route . "' class='btn btn-sm btn-clean btn-icon mr-2' 
            title='" . $hint . "'><span class='svg-icon svg-icon-md'>" . $svg . "</span></a>";
  }

  public static function btnTargetBlank($route, $hint, $icon = "Files/File-done.svg")
  {
    $svg = file_get_contents("assets/media/svg/icons/" . $icon);
    return "<a href='" . $route . "' class='btn btn-sm btn-clean btn-icon mr-2' target='_blank' 
            title='" . $hint . "'><span class='svg-icon svg-icon-md'>" . $svg . "</span></a>";
  }

  public static function checkBox($id)
  {
    return "<th><label class=\"checkbox checkbox-single\">
            <input type=\"checkbox\" class=\"check-id\" name=\"ids[]\" value=\"$id\"/>
            <span></span></label></th>";
  }

  public static function label($name, $color = 'primary')
  {
    return "<span class='label label-light-" . $color . " font-weight-bold label-inline'>" . $name . "</span>";
  }

  public static function naviItem($url, $type, $onClick = "")
  {
    switch ($type) {
      case 'delete':
        $icon = "la la-trash";
        $text = "Hapus Data";
        break;

      case 'edit':
        $icon = "la la-pencil";
        $text = "Ubah Data";
        break;

      case 'upload_berkas':
        $icon = "la la-file-upload";
        $text = "Unggah Berkas";
        break;
    }
    return "<li class='navi-item'> <a href='$url' $onClick class='navi-link'> <span class='navi-icon'><i class='$icon'></i></span> <span class='navi-text'>$text</span> </a> </li>";
  }

  public static function aksiDropdown($naviitems)
  {

    return "
      <div class='dropdown dropdown-inline'>
        <a href='javascript:;' class='btn btn-sm btn-clean btn-icon mr-2' data-toggle='dropdown'>
          <span class='svg-icon svg-icon-md'>" . file_get_contents("assets/media/svg/icons/Code/Compiling.svg") . "</span>
        </a>
        <div class='dropdown-menu dropdown-menu-sm dropdown-menu-right' style='display: none;'>
          <ul class='navi flex-column navi-hover py-2'>
            <li class='navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2'> Pilih Aksi: </li>
            $naviitems
          </ul>
        </div>
      </div>";
  }
}
