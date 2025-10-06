<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Str;
class ChatbotController extends Controller
{
    public function handle(Request $request)
    {
        // đảm bảo mbstring dùng UTF-8 (thường đã đúng trong Laravel nhưng gọi an toàn)
        mb_internal_encoding('UTF-8');

        $incoming = trim($request->input('message', ''));

        if (empty($incoming)) {
            return response()->json(['messages' => [
                ['type' => 'text', 'text' => 'Không có tin nhắn gửi lên.']
            ]]);
        }

        $lower = mb_strtolower($incoming);

        // --- TÌM MÓN: bắt đầu bằng "tìm món " (Unicode-safe)
        if (Str::startsWith($lower, 'tìm món ') || Str::startsWith($lower, 'tim mon ')) {
            // dùng mb_substr để cắt chính xác
            $prefixLen = mb_strlen('tìm món ');
            $name = trim(mb_substr($incoming, $prefixLen));

            if ($name === '') {
                return response()->json(['messages' => [
                    ['type' => 'text', 'text' => 'Bạn chưa nhập tên món. Ví dụ: "tìm món phở bò"']
                ]]);
            }

            // ... phần truy vấn DB như trước, sử dụng $name
            // ví dụ:
            $foods = Food::query()
                ->where('status', operator: 'Còn Hàng')
                ->where(function($q) use ($name) {
                    $q->where('name', 'like', "%{$name}%");
                })
                ->take(6)
                ->get();

            // xử lý kết quả (như code bạn đang dùng)
            if ($foods->isEmpty()) {
                return response()->json(['messages' => [
                    ['type' => 'text', 'text' => "Không tìm thấy món nào với \"{$name}\"."]
                ]]);
            }

            $messages = [];
            foreach ($foods as $f) {
                $imageUrl = $f->image ? asset('img/' . $f->image) : asset('images/no-image.png');
                $detailUrl = url("/menudetail/{$f->id}/{$f->slug}");
                $price = is_numeric($f->price) ? number_format($f->price, 0, ',', '.') . ' đ' : ($f->price ?? 'Liên hệ');
                $short = $f->description ? Str::limit($f->description, 120) : '';

                $messages[] = [
                    'type' => 'card',
                    'title' => $f->name,
                    'subtitle' => "{$price}" . ($short ? " — {$short}" : ""),
                    'image' => $imageUrl,
                    'url' => $detailUrl,
                    'id' => $f->id,
                ];
            }

            array_unshift($messages, ['type' => 'text', 'text' => "Kết quả tìm kiếm cho \"{$name}\":"]);
            return response()->json(['messages' => $messages]);
        }

        // --- HỎI GIÁ: bắt đầu bằng "giá " (Unicode-safe)
        if (Str::startsWith($lower, 'giá ') || Str::startsWith($lower, 'gia ')) {
            $prefixLen = mb_strlen('giá ');
            $name = trim(mb_substr($incoming, $prefixLen));

            if ($name === '') {
                return response()->json(['messages' => [
                    ['type' => 'text', 'text' => 'Bạn chưa nhập tên món. Ví dụ: "giá phở bò"']
                ]]);
            }

            $food = Food::query()
                ->where('status', 'Còn Hàng')
                ->where(function($q) use ($name) {
                    $q->where('name', 'like', "%{$name}%")
                      ->orWhere('slug', $name);
                })
                ->first();

            if (!$food) {
                return response()->json(['messages' => [
                    ['type' => 'text', 'text' => "Mình không tìm thấy món \"{$name}\" để báo giá."]
                ]]);
            }

           $imageUrl = $food->image ? asset('img/' . $food->image) : asset('images/no-image.png');
            $detailUrl = url("/menudetail/{$food->id}/{$food->slug}");
            $price = is_numeric($food->price) ? number_format($food->price, 0, ',', '.') . ' đ' : ($food->price ?? 'Liên hệ');
            $desc = $food->description ? Str::limit($food->description, 200) : '';

            $messages = [
                ['type' => 'text', 'text' => "{$food->name}\nGiá: {$price}\n{$desc}"],
                [
                    'type' => 'card',
                    'title' => $food->name,
                    'subtitle' => "{$price}",
                    'image' => $imageUrl,
                    'url' => $detailUrl,
                    'id' => $food->id,
                ]
            ];

            return response()->json(['messages' => $messages]);
        }

        // phần fallback giữ nguyên...
        return response()->json(['messages' => [
            ['type' => 'text', 'text' => "Xin lỗi, mình chưa hiểu. Gõ 'help' để xem các lệnh hỗ trợ."]
        ]]);
    }
}

