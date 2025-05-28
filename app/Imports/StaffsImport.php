<?php

namespace App\Imports;

use App\Models\Staff;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\ValidationException;

class StaffsImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * Map và tạo model Staff từ mỗi dòng.
     */
    public function model(array $row)
    {
        // 1. Map lại key: bỏ dấu *, chuyển thành snake_case
        $mapped = [];
        foreach ($row as $key => $value) {
            $key = trim(str_replace('*', '', $key));
            $key = Str::slug($key, '_');
            $mapped[$key] = $value;
        }

        // 2. Tạo Staff
        return new Staff([
            'fullname'      => $mapped['ho_ten']            ?? null,
            'date_of_birth'      => $this->transformDate($mapped['ngay_sinh'] ?? null),
            'gender'        => $mapped['gioi_tinh']         ?? null,
            'SDT'           => $mapped['sdt']               ?? null,
            'CCCD'          => $mapped['cccd']              ?? null,
            'status'        => $mapped['trang_thai']        ?? 'Thử Việc',
            'address'       => $mapped['dia_chi']           ?? null,
            'email'         => $mapped['email']             ?? null,
            'time_work'     => $this->transformDate($mapped['ngay_vao_lam'] ?? null),
            'type'          => $mapped['loai_nv']           ?? 'Part Time',
            'role'          => $mapped['chuc_vu']           ?? 'Nhân Viên',
            'hourly_salary' => $mapped['luong_gio']         ?? null,
            'basic_salary'  => $mapped['luong_co_ban']      ?? null,
            'STK'           => $mapped['so_tai_khoan']      ?? null,
            'bank'          => $mapped['ngan_hang']         ?? null,
            'code_nv'       =>'NV'.$mapped['cccd'] ,
            'branch_id'     =>1,
            

        ]);
    }

    /**
     * Chuyển định dạng ngày DD/MM/YYYY => Y-m-d
     */
    protected function transformDate($value)
    {
        if (empty($value)) return null;
        try {
            return \Carbon\Carbon::createFromFormat('d/m/Y', $value)
                                  ->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Chỉ định heading row nằm ở dòng 2
     */
    public function headingRow(): int
    {
        return 2;
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            '*.ho_ten'        => 'required|string|max:255',
            '*.ngay_sinh'     => 'required|date_format:d/m/Y',
            '*.gioi_tinh'     => ['required', Rule::in(['Nam','Nữ','Khác'])],
            '*.sdt'           => 'required|digits_between:9,10',
            '*.cccd'          => 'required|string|max:20',
            '*.dia_chi'       => 'required|string|max:255',
            '*.email'         => 'required|email|max:255',
            '*.ngay_vao_lam'  => 'required|date_format:d/m/Y',
            '*.so_tai_khoan'  => 'required|string|max:30',
            '*.ngan_hang'     => 'required|string|max:100',
        ];
    }

    /**
     * Custom messages
     */
    public function customValidationMessages()
    {
        return [
            '*.ho_ten.required'       => 'Họ tên là bắt buộc.',
            '*.ngay_sinh.date_format' => 'Ngày sinh phải định dạng DD/MM/YYYY.',
            '*.gioi_tinh.in'          => 'Giới tính chỉ: Nam, Nữ hoặc Khác.',
            '*.sdt.digits_between'    => 'SĐT phải 9–10 chữ số.',
            '*.email.email'           => 'Email không đúng định dạng.',
            '*.ngay_vao_lam.date_format' => 'Ngày vào làm phải DD/MM/YYYY.',
            // ... thêm nếu cần
        ];
    }
}
