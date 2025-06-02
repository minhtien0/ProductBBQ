<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, WithEvents, WithStyles
{
    protected $filters;

    /**
     * Nhận mảng filters từ controller
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Áp các điều kiện tìm kiếm vào query
     */
    protected function applyFilters($query)
    {
        $f = $this->filters;

        if (!empty($f['email'])) {
            $query->where('email', 'like', '%' . $f['email'] . '%');
        }
        if (!empty($f['birthday'])) {
            $query->whereDate('birthday', $f['birthday']);
        }
        if (!empty($f['fullname'])) {
            $keyword = $f['fullname'];
            $query->where(function($q) use ($keyword) {
                $q->where('fullname', 'like', "%{$keyword}%")
                  ->orWhere('user', 'like', "%{$keyword}%");
            });
        }
        if (!empty($f['gender'])) {
            $query->where('gender', $f['gender']);
        }
    }

    /**
     * Lấy collection đã áp filter, map ra array thuần
     */
    public function collection()
    {
        $query = User::query();

        // Áp filter
        $this->applyFilters($query);

        return $query->get()->map(function ($user) {
            return [
                $user->id,
                $user->user,
                $user->fullname,
                $user->email,
                $user->sdt,
                $user->birthday ? $user->birthday->format('Y-m-d') : '',
                $user->gender,
                $user->role,
                $user->created_at->format('Y-m-d H:i'),
            ];
        });
    }

    /**
     * Đăng ký event để thêm tiêu đề, style, v.v.
     */
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // Thêm dòng tiêu đề chính ở A1
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->setCellValue('A1', 'Danh Sách Người Dùng');
                // Merge A1:I1 (9 cột)
                $event->sheet->mergeCells('A1:I1');
            },
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Thiết lập tiêu đề các cột ở hàng 2
                $headings = [
                    'ID',
                    'Tên Đăng Nhập',
                    'Họ Và Tên',
                    'Email',
                    'SĐT',
                    'Ngày Sinh',
                    'Giới Tính',
                    'Vai Trò',
                    'Ngày Tạo'
                ];
                $col = 'A';
                foreach ($headings as $heading) {
                    $sheet->setCellValue("{$col}2", $heading);
                    $col++;
                }

                // Style cho hàng A1
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFD3D3D3'],
                    ],
                ]);

                // Style cho hàng tiêu đề cột (A2:I2)
                $sheet->getStyle('A2:I2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFEFEFEF'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Style dữ liệu từ hàng 3 trở xuống
                $highestRow = $sheet->getHighestRow();
                if ($highestRow > 2) {
                    $sheet->getStyle("A3:I{$highestRow}")->applyFromArray([
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                    ]);
                }

                // Tự động điều chỉnh độ rộng cột
                foreach (range('A', 'I') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }

    /**
     * Với Vòng đời worksheet có thể để trống, hoặc tùy chỉnh thêm
     */
    public function styles(Worksheet $sheet)
    {
        // Không làm gì thêm
    }
}
