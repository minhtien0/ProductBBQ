<?php

namespace App\Exports;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

class StaffsExport implements FromCollection, WithHeadings, WithEvents, WithStyles
{
    public function collection()
    {
        // Lấy danh sách staff với join branch
        return Staff::with('branch')->get()->map(function ($staff) {
            return [
                $staff->code_nv,
                $staff->fullname,
                $staff->date_of_birth,
                $staff->gender,
                $staff->SDT,
                $staff->CCCD,
                $staff->status,
                $staff->address,
                $staff->email,
                $staff->time_work,
                $staff->branch ? $staff->branch->name : '',
                $staff->type,
                $staff->role,
                $staff->hourly_wage,
                $staff->Basic_Salary,
                $staff->STK,
                $staff->bank
            ];
        });
    }

    // Heading đúng dòng 2
    public function headings(): array
    {
        return [
            'Mã NV',
            'Họ tên',
            'Ngày sinh',
            'Giới tính',
            'SĐT',
            'CCCD',
            'Trạng thái',
            'Địa chỉ',
            'Email',
            'Ngày vào làm',
            'Đơn vị',
            'Loại NV',
            'Chức vụ',
            'Lương giờ',
            'Lương cơ bản',
            'Số tài khoản',
            'Ngân hàng'
        ];
    }

    public function registerEvents(): array
    {
        return [
            // Chèn 1 dòng trước headings để dành cho title
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet->getDelegate()->insertNewRowBefore(1, 1);
            },
            // Style sau khi đã có dữ liệu
            AfterSheet::class => function (AfterSheet $event) {
                // Merge và set title ở dòng 1
                $event->sheet->mergeCells('A1:Q1');
                $event->sheet->setCellValue('A1', 'Danh Sách Nhân Viên');
                $event->sheet->getDelegate()->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Style heading ở dòng 2 (A2:Q2)
                $event->sheet->getDelegate()->getStyle('A2:Q2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Căn giữa toàn bộ dữ liệu bên dưới
                $highestRow = $event->sheet->getDelegate()->getHighestRow();
                $event->sheet->getDelegate()->getStyle("A2:Q$highestRow")->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 16]],
            2 => ['font' => ['bold' => true]],
        ];
    }
}
