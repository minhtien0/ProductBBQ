@extends('admin.index')
@section('content')
<div x-data="editCompanyModal()">
    <div class="w-full bg-white">
        <div class="px-3 py-3">
            <!-- Action buttons -->
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border-collapse">
                    <thead class="bg-gray-500 text-white">
                        <tr>
                            <th class="w-12 py-1 px-2 text-left">
                                <input type="checkbox" class="form-checkbox h-4 w-4">
                            </th>
                            <th class="py-1 px-2 text-left text-sm">Tên</th>
                            <th class="py-1 px-2 text-left text-sm">Địa Chỉ</th>
                            <th class="py-1 px-2 text-left text-sm">Số Điện Thoại</th>
                            <th class="py-1 px-2 text-left text-sm">Email</th>
                            <th class="py-1 px-2 text-left text-sm">Mở Cửa</th>
                            <th class="py-1 px-2 text-left text-sm">Đóng Cửa</th>
                            <th class="py-1 px-2 text-left text-sm">Facebook</th>
                            <th class="py-1 px-2 text-left text-sm">Telegram</th>
                            <th class="py-1 px-2 text-left text-sm">Instagram</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr class="bg-gray-50">
                            @foreach ($companys as $company)
                                <td class="py-3 px-2 border-t border-gray-200">
                                    <input type="checkbox" class="form-checkbox h-4 w-4">
                                </td>
                                <td class="py-1 px-2 border-t border-gray-200 text-red-700">
                                    <a href="javascript:void(0)"
                                        @click="openEdit({{ $company->id }}, '{{ $company->name }}', '{{ $company->address }}', '{{ $company->sdt }}', '{{ $company->email }}', '{{ $company->timeopen }}', '{{ $company->timeclose }}', '{{ $company->facebook }}', '{{ $company->telegram }}', '{{ $company->instagram }}')"
                                        class="text-red-600 hover:underline cursor-pointer">
                                        {{ $company->name }}
                                    </a>
                                </td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700"><a
                                        href="">{{ $company->address }}</a></td>
                                <td class="py-1 px-2 border-t border-gray-200">
                                    <span class="text-gray-600">{{ $company->sdt }}</span>
                                </td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $company->email }}</td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $company->timeopen }}</td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $company->timeclose }}</td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $company->facebook }}</td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $company->telegram }}</td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $company->instagram }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
<div  x-show="show" style="display: none"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg shadow-xl relative">
        <h2 class="text-lg font-bold mb-4">Sửa thông tin công ty</h2>
        <form :action="'/admin/info/update/' + company.id" method="POST" class="space-y-3">
            @csrf
            <!-- Nếu cần PUT method -->
            @method('POST')
            <input type="hidden" name="id" :value="company.id">
            <div>
                <label class="text-xs">Tên</label>
                <input type="text" name="name" class="w-full border rounded p-2" x-model="company.name">
            </div>
            <div>
                <label class="text-xs">Địa Chỉ</label>
                <input type="text" name="address" class="w-full border rounded p-2" x-model="company.address">
            </div>
            <div>
                <label class="text-xs">Số Điện Thoại</label>
                <input type="text" name="sdt" class="w-full border rounded p-2" x-model="company.sdt">
            </div>
            <div>
                <label class="text-xs">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" x-model="company.email">
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="text-xs">Mở Cửa</label>
                    <input type="text" name="timeopen" class="w-full border rounded p-2" x-model="company.timeopen">
                </div>
                <div>
                    <label class="text-xs">Đóng Cửa</label>
                    <input type="text" name="timeclose" class="w-full border rounded p-2" x-model="company.timeclose">
                </div>
            </div>
            <div>
                <label class="text-xs">Facebook</label>
                <input type="text" name="facebook" class="w-full border rounded p-2" x-model="company.facebook">
            </div>
            <div>
                <label class="text-xs">Telegram</label>
                <input type="text" name="telegram" class="w-full border rounded p-2" x-model="company.telegram">
            </div>
            <div>
                <label class="text-xs">Instagram</label>
                <input type="text" name="instagram" class="w-full border rounded p-2" x-model="company.instagram">
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" @click="show=false"
                        class="px-4 py-2 border rounded bg-gray-200 hover:bg-gray-300">Hủy</button>
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-blue-700">Lưu</button>
            </div>
        </form>
        <button @click="show=false"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
    </div>
</div>
</div>
<script>
    function editCompanyModal() {
        return {
            show: false,
            company: {
                id: '',
                name: '',
                address: '',
                sdt: '',
                email: '',
                timeopen: '',
                timeclose: '',
                facebook: '',
                telegram: '',
                instagram: ''
            },
            openEdit(id, name, address, sdt, email, timeopen, timeclose, facebook, telegram, instagram) {
                this.company = { id, name, address, sdt, email, timeopen, timeclose, facebook, telegram, instagram };
                this.show = true;
            }
        }
    }
</script>
<x-notification-popup />
<script src="{{ asset('js/notification.js') }}"></script>
@endsection