<?php
namespace App\Exports;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StaffsExport implements FromCollection, WithEvents, WithStyles
{
    protected $filters;

    /**
     * Nhận mảng filters từ controller
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

     protected function applyFilters($query)
    {
        $f = $this->filters;

        if (!empty($f['branch_id'])) {
            $query->where('branch_id', $f['branch_id']);
        }
        if (!empty($f['staff_type'])) {
            $query->where('type', $f['staff_type']);
        }
        if (!empty($f['status'])) {
            $query->where('status', $f['status']);
        }
        if (!empty($f['position'])) {
            $query->where('role', $f['position']);
        }
        if (!empty($f['min_basic_salary'])) {
            $query->where('Basic_Salary', '>=', $f['min_basic_salary']);
        }
        if (!empty($f['min_hourly_salary'])) {
            $query->where('hourly_wage', '>=', $f['min_hourly_salary']);
        }
        if (!empty($f['q'])) {
            $q = $f['q'];
            $query->where(function($q2) use($q) {
                $q2->where('code_nv',   'like', "%{$q}%")
                   ->orWhere('fullname', 'like', "%{$q}%");
            });
        }
    }
    public function collection()
    {
        $query = Staff::with('branch');

        // Áp filter
        $this->applyFilters($query);

        // Lấy data rồi map ra mảng thuần
        return $query->get()->map(function ($staff) {
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
                $staff->bank,
            ];
        });
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // Chèn một hàng mới ở trên đầu
                $event->sheet->insertNewRowBefore(1, 1);
                // Đặt nội dung "Danh Sách Nhân Viên" vào ô A1
                $event->sheet->setCellValue('A1', 'Danh Sách Nhân Viên');
                // Merge các ô từ A1 đến Q1
                $event->sheet->mergeCells('A1:Q1');
            },
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Gán tiêu đề thủ công vào A2:Q2
                $headings = [
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
                    'Đơn vị (ID)',
                    'Loại NV',
                    'Chức vụ',
                    'Lương giờ',
                    'Lương cơ bản',
                    'Số tài khoản',
                    'Ngân hàng'
                ];
                $col = 'A';
                foreach ($headings as $heading) {
                    $sheet->setCellValue("{$col}2", $heading);
                    $col++;
                }

                // Style cho hàng tiêu đề chính (A1)
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFD3D3D3'],
                    ],
                ]);

                // Style cho hàng headings (A2:Q2)
                $sheet->getStyle('A2:Q2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
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

                // Style cho dữ liệu (từ hàng 3 trở đi)
                $highestRow = $sheet->getHighestRow();
                if ($highestRow > 2) {
                    $sheet->getStyle("A3:Q{$highestRow}")->applyFromArray([
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                    ]);
                }

                // Tự động điều chỉnh kích thước cột
                foreach (range('A', 'Q') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }


    public function styles(Worksheet $sheet)
    {
        // Định dạng cơ bản (nếu cần bổ sung thêm)
    }
}
?>