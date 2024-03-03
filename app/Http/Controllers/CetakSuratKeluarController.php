<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CetakSuratKeluarController extends Controller
{
  public function __construct()
  {
    // $this->middleware('isajaxreq')->except('index');
  }

  public function index()
  {
    return view('suratkeluar.cetak');
  }

  public function cetak(Request $request)
  {

    $from = date($request->start);
    $to = date($request->end);
    $filename = 'Rekap_surat_keluar_' . $request->start . '_to_' . $request->end;
    $periode = 'PERIODE ' . formatTanggal($request->start) . ' SAMPAI DENGAN ' . formatTanggal($request->end);

    $datas = SuratKeluar::whereBetween('date', [$from, $to])->orderBy('nomor')->get();
    // dd($suratkeluar->toArray());

    $spreadsheet = new Spreadsheet();

    $lineTitle = [
      'borders' => [
        'allBorders' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => [
            'argb' => '0000'
          ],
        ],
        'outline' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
        ],
      ],
    ];

    $lineJumlah = [
      'borders' => [
        'top' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
        'vertical' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
        'bottom' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
        ],
        'left' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
        ],
        'right' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
        ],
      ],
    ];

    $lineIsiTabel = [
      'borders' => [
        'vertical' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
        'horizontal' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
        ],
        'left' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
        ],
        'right' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
        ],
      ],
    ];

    $spreadsheet->getActiveSheet()->freezePane('A6');
    $spreadsheet->getActiveSheet()->mergeCells('A1:E1');
    $spreadsheet->getActiveSheet()->setCellValue('A1', 'KANTOR KEMENTARIAN AGAMA KABUPATEN KONAWE KEPULAUAN');
    $spreadsheet->getActiveSheet()->mergeCells('A2:E2');
    $spreadsheet->getActiveSheet()->mergeCells('A3:E3');
    $spreadsheet->getActiveSheet()->setCellValue('A2', 'REKAP SURAT KELUAR');
    $spreadsheet->getActiveSheet()->setCellValue('A3', strtoupper($periode));
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->setCellValue('A5', 'NO');
    $spreadsheet->getActiveSheet()->setCellValue('B5', 'NOMOR SURAT');
    $spreadsheet->getActiveSheet()->setCellValue('C5', 'PERIHAL');
    $spreadsheet->getActiveSheet()->setCellValue('D5', 'TANGGAL');
    $spreadsheet->getActiveSheet()->setCellValue('E5', 'TUJUAN');

    $spreadsheet->getActiveSheet()->setCellValue('A6', '1');
    $spreadsheet->getActiveSheet()->setCellValue('B6', '2');
    $spreadsheet->getActiveSheet()->setCellValue('C6', '3');
    $spreadsheet->getActiveSheet()->setCellValue('D6', '4');
    $spreadsheet->getActiveSheet()->setCellValue('E6', '5');
    $spreadsheet->getActiveSheet()->getStyle('A5:E5')->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:E6')->applyFromArray($lineTitle);
    $spreadsheet->getActiveSheet()->getStyle('A5:E5')->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getStyle('A6:E6')->getFont()->setSize(8);
    $spreadsheet->getActiveSheet()->getStyle('A6:E6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\FILL::FILL_SOLID)->getStartColor()->setRGB('ADADAD');

    $spreadsheet->getActiveSheet()->getStyle('A5:E6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:E6')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:E5')->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:E6')->getFont()->setItalic(true);

    $spreadsheet->getActiveSheet()->getRowDimension('5')->setRowHeight(20, 'pt');
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(100);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);

    $no = 7;
    $hit = 1;
    foreach ($datas as $data) {
      $spreadsheet->getActiveSheet()->setCellValue('A' . $no, $hit++);
      $spreadsheet->getActiveSheet()->setCellValue('B' . $no, $data->kombinasi);
      $spreadsheet->getActiveSheet()->setCellValue('C' . $no, $data->perihal);
      $spreadsheet->getActiveSheet()->setCellValue('D' . $no, $data->date);
      $spreadsheet->getActiveSheet()->setCellValue('E' . $no, $data->tujuan);
      $no++;
    }

    $spreadsheet->getActiveSheet()->getStyle('A7:E' . ($no - 1))->applyFromArray($lineIsiTabel);
    $spreadsheet->getActiveSheet()->getStyle('A7:B' . $no)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('D7:D' . $no)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A7:E' . ($no - 1))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
    $spreadsheet->getActiveSheet()->getStyle('C7:C' . ($no - 1))->getAlignment()->setWrapText(true);

    $spreadsheet->getActiveSheet()->mergeCells('A' . $no . ':E' . $no);
    $spreadsheet->getActiveSheet()->setCellValue('A' . $no, 'JUMLAH SURAT KELUAR : ' . count($datas));

    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\FILL::FILL_SOLID)->getStartColor()->setRGB('C9C9C9');
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->getFont()->setItalic(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->applyFromArray($lineJumlah);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    // ob_end_clean();
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');

    setlocale(LC_ALL, 'en_US');
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save('php://output');
    die();
  }
}
