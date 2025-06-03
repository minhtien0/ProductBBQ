@extends('admin.index')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white shadow p-6 rounded">
        <h2 class="text-xl font-semibold mb-4">Phản hồi đến: <span class="text-blue-700">{{ $help->email }}</span></h2>
        <p class="text-sm mb-2 text-gray-600">Tiêu đề câu hỏi: <span class="font-medium">{{ $help->question }}</span></p>
        <div>
            <label class="block mb-1">Nội dung câu hỏi</label>
            <textarea readonly name="content" rows="5" class="w-full border px-3 py-2 rounded" >{{ $help->content }}</textarea>
        </div>

        <form action="{{ route('help.sendReply', $help->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1">Tiêu đề phản hồi</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block mb-1">Nội dung phản hồi</label>
                <textarea name="content" rows="5" class="w-full border px-3 py-2 rounded" required></textarea>
            </div>
            <div class="flex justify-between  space-x-2 mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Gửi</button>
                <a href="{{ route('admin.help') }}"
                    class="inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 shadow transition">
                    ← Quay lại
                </a>
            </div>
        </form>
    </div>
    <x-notification-popup />
    <script src="{{ asset('js/notification.js') }}"></script>
@endsection