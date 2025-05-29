<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class StaffsTemplateExport implements FromCollection, WithEvents, WithStyles,SkipsEmptyRows
{
    public function collection()
    {
        // Trả về collection rỗng, KHÔNG có dữ liệu
        return new Collection([]);
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->setCellValue('A1', 'Danh Sách Nhân Viên (Mẫu)');
                $event->sheet->mergeCells('A1:O1');
            },
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Định nghĩa các cột và trạng thái bắt buộc
                $headings = [
                    ['name' => 'Họ tên', 'required' => true],
                    ['name' => 'Ngày sinh', 'required' => true],
                    ['name' => 'Giới tính', 'required' => true],
                    ['name' => 'SĐT', 'required' => true],
                    ['name' => 'CCCD', 'required' => true],
                    ['name' => 'Trạng thái', 'required' => false],
                    ['name' => 'Địa chỉ', 'required' => true],
                    ['name' => 'Email', 'required' => true],
                    ['name' => 'Ngày vào làm', 'required' => true],
                    ['name' => 'Loại NV', 'required' => false],
                    ['name' => 'Chức vụ', 'required' => false],
                    ['name' => 'Lương giờ', 'required' => false],
                    ['name' => 'Lương cơ bản', 'required' => false],
                    ['name' => 'Số tài khoản', 'required' => true],
                    ['name' => 'Ngân hàng', 'required' => true]
                ];

                // Gán headings với dấu * đỏ cho các cột bắt buộc
                $col = 'A';
                foreach ($headings as $heading) {
                    if ($heading['required']) {
                        // Tạo rich text với dấu * màu đỏ
                        $richText = new RichText();
                        $richText->createText($heading['name']);
                        
                        $redAsterisk = $richText->createTextRun(' *');
                        $redAsterisk->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFF0000'));
                        $redAsterisk->getFont()->setBold(true);
                        
                        $sheet->setCellValue("{$col}2", $richText);
                    } else {
                        $sheet->setCellValue("{$col}2", $heading['name']);
                    }
                    $col++;
                }

                // Style title
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFD3D3D3'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Style heading
                $sheet->getStyle('A2:O2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFEFEFEF'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Tự động điều chỉnh kích thước cột
                foreach (range('A', 'O') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }

                // Set chiều cao cho các dòng
                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(2)->setRowHeight(20);
            },
        ];
    }   

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 16],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ],
            2 => [
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ],
        ];
    }
}