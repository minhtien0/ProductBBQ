<?php

namespace App\Http\Controllers;
use App\Models\BookingTable;
use App\Models\Company;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Address;
use App\Models\User;
use App\Models\Food;
use App\Models\Image;
use App\Models\Menu;
use App\Models\Rate;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Voucher;
use App\Models\Help;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function index()
    {
        $allFoods = Food::with('menus')->get();
        $favIds = Cart::where('user_id', session('user_id'))
            ->where('type', 'Yêu Thích')
            ->pluck('food_id')
            ->toArray();

        //dd(session('role'));
        return view('index', compact('allFoods', 'favIds'));
    }
    public function searchFood(Request $request)
    {
        $q = $request->input('term'); // Select2 sẽ gửi 'term'
        $foods = \App\Models\Food::where('name', 'like', "%$q%")->limit(10)->get();

        $results = [];
        foreach ($foods as $food) {
            $results[] = [
                'id' => $food->id,
                'slug' => $food->slug,
                'text' => $food->name,
                'image' => asset('img/' . $food->image), // hoặc đúng đường dẫn ảnh
                'price' => $food->price,
                'desc' => $food->description ?? '',
            ];
        }


        return response()->json(['results' => $results]);
    }

    public function order()
    {
        return view('qrorder');
    }
    public function about()
    {
        $newBlogs = Blog::join('staffs', 'staffs.id', '=', 'blog.id_staff')
            ->where('blog.created_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('blog.created_at', 'desc')
            ->select('blog.*', 'staffs.*', 'blog.type as type_blog', 'blog.id as id_blog')
            ->get();
        $countStaff = Staff::count();
        $countUser = User::count();
        $countRate = Rate::count();

        return view('about', compact('countStaff', 'countUser', 'countRate'), ['newBlogs' => $newBlogs]);
    }
    public function menu()
    {
        $menus=Menu::all();
        $foods = Food::with('menus')->get();
        return view('menu',compact('menus','foods'));
    }
    public function blog()
    {
        $blogs = Blog::join('staffs', 'blog.id_staff', '=', 'staffs.id')
            ->select('blog.*', 'staffs.*', 'blog.id as id_blog', 'blog.created_at as time_blog', 'staffs.avata as avatar', 'blog.type as type_blog')
            ->get();
        return view('blog', compact('blogs'));
    }
    public function ajaxSearchBlog(Request $request)
    {
        $q = $request->input('q');
        $blogs = Blog::where('title', 'like', '%' . $q . '%')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get(['id', 'slug', 'title', 'image', 'created_at']);

        $results = $blogs->map(function ($b) {
            return [
                'id' => $b->id,
                'slug' => $b->slug,
                'title' => $b->title,
                'image' => asset('img/blog/' . $b->image),
                'date' => $b->created_at ? $b->created_at->format('d/m/Y') : '',
            ];
        });

        return response()->json(['results' => $results]);
    }
    public function contact()
    {
        $infos = Company::first(); //lấy dữ liệu

        return view('contact', compact('infos'));
    }
    public function storeBookingTable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nameuser' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sdt' => 'required|regex:/^[0-9]{9,15}$/',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'quantitypeople' => 'required|integer|min:1|max:20',
        ], [
            'nameuser.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'sdt.required' => 'Vui lòng nhập số điện thoại.',
            'sdt.regex' => 'Số điện thoại không hợp lệ.',
            'date.required' => 'Vui lòng chọn ngày.',
            'date.after_or_equal' => 'Ngày đặt bàn phải từ hôm nay trở đi.',
            'time.required' => 'Vui lòng chọn thời gian.',
            'quantitypeople.required' => 'Vui lòng chọn số lượng người.',
            'quantitypeople.integer' => 'Số lượng phải là số.',
            'quantitypeople.min' => 'Phải có ít nhất 1 người.',
            'quantitypeople.max' => 'Tối đa 20 người.',
        ]);

        if ($validator->fails()) {
            // Trả về lỗi cho AJAX
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->all(),
            ], 422);
        }
        $validated = $validator->validated();

        try {
            $booking = new BookingTable();
            $booking->nameuser = $validated['nameuser'];
            $booking->email = $validated['email'];
            $booking->sdt = $validated['sdt'];
            $booking->quantitypeople = $validated['quantitypeople'];
            $booking->time_booking = $validated['date'] . ' ' . $validated['time'] . ':00';
            $booking->status = 'Chờ xác nhận';
            $booking->time_order = now();
            $booking->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Đặt bàn thành công! Chúng tôi sẽ liên hệ lại bạn sớm.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'errors' => ['Có lỗi xảy ra khi đặt bàn. Vui lòng thử lại sau!']
            ], 500);
        }
    }
    public function addContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'sdt' => 'required|digits_between:8,12',
            'purpose' => 'required|max:255',
            'question' => 'required|max:255',
            'content' => 'required|max:1000',
            'time' => 'required|date',

        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Tên không được vượt quá 100 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 100 ký tự.',
            'sdt.required' => 'Vui lòng nhập số điện thoại.',
            'sdt.digits_between' => 'Số điện thoại phải từ 8 đến 12 số.',
            'purpose.required' => 'Vui lòng nhập chủ đề.',
            'purpose.max' => 'Chủ đề không được vượt quá 255 ký tự.',
            'question.required' => 'Vui lòng nhập tiêu đề.',
            'question.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'content.max' => 'Nội dung không được vượt quá 1000 ký tự.',
            'time.required' => 'Vui lòng chọn ngày.',
            'time.date' => 'Ngày không hợp lệ.',
        ]);

        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        try {
            $data = $request->only(['name', 'email', 'sdt', 'purpose', 'question', 'content', 'time']);
            $data['status'] = '0';
            Help::create($data);

            return redirect()->back()->with('success', 'Gửi liên hệ thành công!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gửi liên hệ không thành công! ' . $e->getMessage());
        }
    }


    public function menudetail($id, $slug)
    {
        $foods = Food::with('menus')->where('id', '=', $id)->first();
        $detailImages = Image::where('id_food', '=', $id)->get();
        $rates = Rate::join('users', 'rates.user_id', '=', 'users.id')
            ->where('food_id', '=', $id)
            ->select('rates.*', 'users.*')
            ->get();
        //dd($detailImages);
        return view('menudetail', compact('foods', 'detailImages', 'rates'));
    }
    public function blogdetail($id, $slug)
    {
        $blog = Blog::join('staffs', 'blog.id_staff', '=', 'staffs.id')
            ->where('blog.id', '=', $id)
            ->select('blog.*', 'staffs.*', 'blog.id as id_blog', 'blog.created_at as time_blog', 'staffs.avata as avatar')
            ->first();
        $allTags = Blog::select('type')->distinct()->get();
        $newBlogs = Blog::where('created_at', '>=', Carbon::now()->subDays(30))
            ->where('id', '!=', $blog->id_blog)
            ->orderBy('created_at', 'desc')
            ->get();
        $commentBlogs = Blog::join('rates', 'blog.id', '=', 'rates.blog_id')
            ->join('users', 'rates.user_id', '=', 'users.id')
            ->where('blog.id', '=', $id)
            ->select('rates.time as time_comment', 'users.fullname as name_comment', 'users.avatar as avatar_comment', 'rates.content as content_comment')
            ->get();
        //dd($commentBlogs);
        return view('blogdetail', compact('blog', 'allTags', 'newBlogs', 'commentBlogs'));
    }
    //Trang chi tiết người dùng
    public function userdetail()
    {
        $address = Address::where('user_id', session('user_id'))
            ->where('default', 1)
            ->first();
        $addressAll = Address::where('user_id', session('user_id'))
            ->get();
        $foodFavorites = Cart::join('foods', 'carts.food_id', '=', 'foods.id')
            ->join('menus', 'foods.type', '=', 'menus.id')
            ->where('carts.user_id', '=', session('user_id'))
            ->where('carts.type', '=', 'Yêu Thích')
            ->select('carts.*', 'foods.*', 'menus.name as type_menu', 'carts.id as id_cart')
            ->get();
        $myReviews = Rate::join('foods', 'rates.food_id', '=', 'foods.id')
            ->join('menus', 'foods.type', '=', 'menus.id')
            ->join('users', 'users.id', '=', 'rates.user_id')
            ->where('users.id', '=', session('user_id'))
            ->select('rates.*', 'foods.*', 'menus.name as type_menu')
            ->get();
        $myOrderLists = Order::join('users', 'users.id', '=', 'orders.id_user')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('foods', 'order_details.product_id', '=', 'foods.id')
            ->where('users.id', session('user_id'))
            ->select(
                'order_details.*',
                'foods.*',
                'users.*',
                'orders.*',
                'orders.id as id_order',
                'orders.code as order_code', // Lấy code của đơn hàng, tránh trùng code với food/user
                'orders.created_at as time_order'
            )
            ->orderBy('time_order', 'desc')
            ->get()
            ->groupBy('order_id');
        //dd($myOrderLists);
        return view('userdetail', compact('address', 'addressAll', 'foodFavorites', 'myReviews', 'myOrderLists'));
    }

    //Trang Chi Tiết Đơn Hàng
    public function ajaxDetailOrder($orderId)
    {
        $order = \App\Models\Order::where('orders.id', $orderId)
            ->join('users', 'users.id', '=', 'orders.id_user')
            ->join('addresses', 'orders.address', '=', 'addresses.id')
            ->select('orders.*', 'users.fullname as customer_name', 'users.sdt', 'addresses.house_number', 'addresses.ward', 'addresses.district', 'addresses.city')
            ->first();
        //dd($order);
        if (!$order)
            return response()->json(['status' => 'error', 'message' => 'Không tìm thấy đơn hàng'], 404);

        $orderDetails = \App\Models\OrderDetail::where('order_id', $orderId)
            ->join('foods', 'foods.id', '=', 'order_details.product_id')
            ->select('order_details.*', 'foods.name as food_name', 'foods.price as food_price')
            ->get();

        // Lấy giá trị voucher
        $voucher = \App\Models\Voucher::where('id', $order->voucher ?? 0)->first();
        $voucherPrice = $voucher ? $voucher->value : 0;

        return response()->json([
            'status' => 'success',
            'order' => $order,
            'details' => $orderDetails,
            'discount' => $voucherPrice,
            'shipping' => 10, // tuỳ bạn cứng code phí ship
        ]);
    }

    //Hủy Đơn Hàng
    public function cancelOrder(Request $request, $id)
    {
        $order = Order::where('id', $id)
                      ->where('id_user', session('user_id'))   // đảm bảo là đơn của chính user
                      ->firstOrFail();

        if ($order->statusorder !== 'Chờ Xác Nhận') {
            return response()->json([
                'success' => false,
                'message' => 'Không thể hủy đơn ở trạng thái này.'
            ], 400);
        }

        $order->statusorder = 'Đã Hủy';  // hoặc 'Hủy' tuỳ bạn đặt
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Đơn hàng đã được hủy.'
        ]);
    }


    public function rateOrder(Request $request)
    {
        // Validate input
        $data = $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'review'   => 'required|string|max:1000',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'food_id'  => 'nullable|integer|exists:foods,id',
            'blog_id'  => 'nullable|integer|exists:blogs,id',
            // nếu cần validate hình ảnh thì thêm rule 'images.*' => 'image|max:2048'
        ]);

        // Tạo record mới
        $rate = new Rate();
        $rate->user_id  = session('user_id') ;         
        $rate->food_id  = $data['food_id']  ?? null;
        $rate->blog_id  = null;
        $rate->rate     = $data['rating'];
        $rate->content  = $data['review'];
        $rate->time     = now();
        $rate->save();

        return response()->json([
            'success' => true,
            'message' => 'Cảm ơn bạn đã gửi đánh giá!',
        ]);
    }


    public function updateProfile(Request $request)
    {
        // 0. Lấy ID từ session, nếu chưa login thì chuyển về login hoặc báo lỗi
        $userId = session('user_id');
        if (empty($userId)) {
            return redirect()->route('login')
                ->with('error', 'Vui lòng đăng nhập để thực hiện chức năng này!');
        }

        // 1. Khai báo validator với thông báo tiếng Việt
        $validator = Validator::make(
            $request->all(),
            [
                'fullname' => 'required|string|max:255',
                'email' => "required|email|unique:users,email,{$userId}",
                'sdt' => 'required|string|max:20',
                'house_number' => 'required|string|max:100',
                'ward' => 'required|string|max:100',
                'district' => 'required|string|max:100',
                'city' => 'required|string|max:100',
            ],
            [
                'fullname.required' => 'Vui lòng nhập họ và tên.',
                'fullname.max' => 'Họ và tên không được vượt quá 255 ký tự.',
                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Email không đúng định dạng.',
                'email.unique' => 'Email này đã được sử dụng.',
                'sdt.required' => 'Vui lòng nhập số điện thoại.',
                'sdt.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
                'house_number.required' => 'Vui lòng nhập số nhà.',
                'ward.required' => 'Vui lòng nhập phường/xã.',
                'district.required' => 'Vui lòng nhập quận/huyện.',
                'city.required' => 'Vui lòng nhập thành phố.',
            ]
        );

        // 2. Nếu validation thất bại, chuyển lỗi vào $errors để Blade @error() hiển thị
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        // 3. Thực hiện cập nhật trong try…catch
        try {
            $data = $validator->validated();

            // 3.1. Cập nhật bảng users
            $user = User::findOrFail($userId);
            $user->fullname = $data['fullname'];
            $user->email = $data['email'];
            $user->sdt = $data['sdt'];
            $user->save();

            // 3.2. Cập nhật hoặc tạo mới bản ghi addresses
            Address::updateOrCreate(
                ['user_id' => $userId],
                [
                    'house_number' => $data['house_number'],
                    'ward' => $data['ward'],
                    'district' => $data['district'],
                    'city' => $data['city'],
                ]
            );

            // 3.3. Cập nhật lại session để hiển thị ở layout/form
            session([
                'fullname' => $user->fullname,
                'email' => $user->email,
                'sdt' => $user->sdt,
                // bạn có thể lưu thêm địa chỉ nếu muốn
            ]);

            return redirect()->back()
                ->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Cập nhật không thành công! ' . $e->getMessage());
        }
    }

    public function addAddress(Request $request)
    {
        $userId = session('user_id');
        if (empty($userId)) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sdt' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
            'default' => 'required|in:0,1',
        ], [
            'name.required' => 'Vui lòng nhập tên người nhận.',
            'sdt.required' => 'Vui lòng nhập số điện thoại.',
            'house_number.required' => 'Vui lòng nhập số nhà.',
            'ward.required' => 'Vui lòng nhập phường/xã.',
            'district.required' => 'Vui lòng nhập quận/huyện.',
            'city.required' => 'Vui lòng nhập tỉnh/thành phố.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $data = $validator->validated();

            // Nếu default = 1 thì cập nhật tất cả address của user khác thành 0
            if ($data['default'] == 1) {
                \App\Models\Address::where('user_id', $userId)->update(['default' => 0]);
            }

            // Thêm địa chỉ mới
            \App\Models\Address::create([
                'user_id' => $userId,
                'name' => $data['name'],
                'sdt' => $data['sdt'],
                'house_number' => $data['house_number'],
                'ward' => $data['ward'],
                'district' => $data['district'],
                'city' => $data['city'],
                'note' => $data['note'] ?? null,
                'default' => $data['default'],
            ]);

            return back()->with('success', 'Thêm địa chỉ thành công!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Lưu không thành công! ' . $e->getMessage());
        }
    }

    public function deleteAddress($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        // Quay về trang trước với thông báo
        return redirect()->back()->with('success', 'Đã xóa địa chỉ thành công!');
    }

    public function editAddress(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:addresses,id',
            'name' => 'required|string|max:255',
            'sdt' => 'required|string|max:20',
            'house_number' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
            'default' => 'required|in:0,1',
        ]);

        $address = Address::findOrFail($request->id);
        $address->name = $request->name;
        $address->sdt = $request->sdt;
        $address->house_number = $request->house_number;
        $address->ward = $request->ward;
        $address->district = $request->district;
        $address->city = $request->city;
        $address->note = $request->note;
        $address->default = $request->default;
        $address->save();

        return redirect()->back()->with('success', 'Cập nhật địa chỉ thành công!');
    }

    //Đổi Mật Khẩu
    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => [
                    'required',
                    'string',
                    'min:6',
                    'confirmed',
                    'regex:/[!@#$%^&*(),.?":{}|<>]/'
                ]
            ], [
                'new_password.confirmed' => 'Nhập lại mật khẩu không khớp!',
                'new_password.min' => 'Mật khẩu mới phải từ 6 ký tự!',
                'new_password.regex' => 'Mật khẩu mới phải có ký tự đặc biệt (!@#$%^&*(),.?":{}|<>])!'
            ]);

            if ($validator->fails()) {
                // Trả về lỗi cho từng trường
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = \App\Models\User::find(session('user_id'));
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy người dùng!']);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['success' => false, 'message' => 'Mật khẩu hiện tại không đúng!']);
            }

            if (Hash::check($request->new_password, $user->password)) {
                return response()->json(['success' => false, 'message' => 'Mật khẩu mới không được trùng mật khẩu hiện tại!']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json(['success' => true, 'message' => 'Đổi mật khẩu thành công!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Đã có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    //Chức Năng Giỏ Hàng
    public function cart()
    {
        $carts = Cart::join('foods', 'carts.food_id', '=', 'foods.id')
            ->join('menus', 'foods.type', '=', 'menus.id')
            ->where('carts.user_id', '=', session('user_id'))
            ->where('carts.type', '=', 'Giỏ Hàng')
            ->select('carts.*', 'foods.*', 'menus.name as type_menu', 'carts.id as id_cart')
            ->get();

        $addressUsers = Address::where('user_id', '=', session('user_id'))->get();
        $now = now();
        $vouchers = Voucher::where('time_start', '<=', $now)
            ->where('time_end', '>=', $now)
            ->where('quantity', '>', 0)
            ->where('status', 'Còn')
            ->get();
        //dd($vouchers);
        $initialCartTotal = $carts->sum(fn($item) => $item->quantity * $item->food->price);
        return view('cart', compact('carts', 'initialCartTotal', 'addressUsers', 'vouchers'));
    }


    public function storeCart(Request $request)
    {
        $data = $request->validate([
            'food_id' => 'required|exists:foods,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if (empty(session('user_id'))) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để thực hiện chức năng này!'
                ], 401);
            }
            return back()->with('error', 'Vui lòng đăng nhập để thực hiện chức năng này!');
        }

        $userId = session('user_id');
        $type = 'Giỏ Hàng';

        $cart = Cart::firstWhere([
            'user_id' => $userId,
            'food_id' => $data['food_id'],
            'type' => $type,
        ]);

        if ($cart) {
            $cart->increment('quantity', $data['quantity']);
        } else {
            Cart::create([
                'user_id' => $userId,
                'food_id' => $data['food_id'],
                'quantity' => $data['quantity'],
                'type' => $type,
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã thêm vào giỏ hàng!'
            ]);
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function storeOrder(Request $request)
    {
        // 1. Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'address_id' => 'required|integer|exists:addresses,id',
            'totalprice' => 'required|integer|min:1',
            'voucher_id' => 'nullable|integer|exists:vouchers,id',
            'totalbill' => 'required|integer|min:1',
            'typepayment' => 'required|in:1,2',
            'note' => 'nullable|string|max:500',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|integer',
            'products.*.quantity' => 'required|integer|min:1',
        ], [
            'address_id.required' => 'Bạn phải chọn địa chỉ.',
            'address_id.exists' => 'Địa chỉ không tồn tại.',
            'totalprice.required' => 'Thiếu tổng tiền món.',
            'totalprice.min' => 'Tổng tiền phải lớn hơn 0.',
            'totalbill.required' => 'Thiếu tổng tiền thanh toán.',
            'totalbill.min' => 'Tổng tiền thanh toán phải lớn hơn 0.',
            'typepayment.required' => 'Bạn phải chọn phương thức thanh toán.',
            'typepayment.in' => 'Phương thức thanh toán không hợp lệ.',
            'products.required' => 'Bạn phải chọn ít nhất một sản phẩm.',
            'products.*.id.required' => 'Thiếu ID sản phẩm.',
            'products.*.quantity.min' => 'Số lượng sản phẩm phải ít nhất là 1.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Trường hợp thanh toán qua VNPAY (typepayment = 2)
        if ((int) $request->typepayment === 2) {
            session([
                'pending_order' => [
                    'address_id' => $request->address_id,
                    'totalprice' => $request->totalprice,
                    'voucher_id' => $request->voucher_id,
                    'totalbill' => $request->totalbill,
                    'note' => $request->note,
                    'products' => $request->products,
                ]
            ]);
            // --- Build URL VNPAY ---
            $vnp_TmnCode = "U8U9C1HI";
            $vnp_HashSecret = "NJGOGY2HL4CARZZ7BB0JO24BH0U2WUIU";
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('vnpay.return');

            // Mã tham chiếu
            $vnp_TxnRef = 'NMT' . strtoupper(Str::random(8));

            // Prepare data
            $inputData = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $request->totalbill * 100,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $request->ip(),
                "vnp_Locale" => "vn",
                "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
                "vnp_OrderType" => "other",
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                //"vnp_ExpireDate" => date('YmdHis', strtotime('+15 minutes')),
            ];

            ksort($inputData);
            $query = '';
            $hashdata = '';
            $i = 0;
            foreach ($inputData as $key => $value) {
                $hashdata .= ($i++ ? '&' : '') . "{$key}=" . urlencode($value);
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= "?" . $query . "vnp_SecureHash={$vnpSecureHash}";

            // Trả về JSON để frontend redirect
            return response()->json([
                'success' => true,
                'redirect' => $vnp_Url,
            ]);
        }

        // Trường hợp thanh toán Tiền mặt (typepayment = 1)
        try {
            DB::transaction(function () use ($request) {
                // Tạo code Order không trùng
                do {
                    $code = 'NMT' . strtoupper(Str::random(8));
                } while (Order::where('code', $code)->exists());

                // Lưu Order
                $order = Order::create([
                    'code' => $code,
                    'table_id' => null,
                    'id_user' => session('user_id'),
                    'address' => $request->address_id,
                    'id_staff' => null,
                    'totalprice' => $request->totalprice,
                    'voucher' => $request->voucher_id,
                    'totalbill' => $request->totalbill,
                    'statusorder' => 'Chờ Xác Nhận',
                    'typepayment' => 1,
                    'note' => $request->note,
                    'type' => 1,
                ]);

                // Lưu OrderDetail
                foreach ($request->products as $item) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'status' => 'Chờ xử lý',
                    ]);
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Đặt hàng thành công (Tiền mặt)!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function vnpayReturn(Request $request)
    {
        // 1. Đọc và loại bỏ SecureHash trước khi build
        $data = $request->all();
        $vnp_SecureHash = $data['vnp_SecureHash'] ?? '';
        unset($data['vnp_SecureHash'], $data['vnp_SecureHashType']);

        // 2. Sắp xếp và build hashData
        ksort($data);
        $hashData = '';
        foreach ($data as $key => $value) {
            if ($hashData !== '') {
                $hashData .= '&';
            }
            $hashData .= urlencode($key) . '=' . urlencode($value);
        }

        $computed = hash_hmac('sha512', $hashData, env('VNPAY_HASH_SECRET'));



        if ($computed !== $vnp_SecureHash) {
            return redirect()->route('views.cart')
                ->with('error', "Xác thực VNPAY thất bại!");
        }


        // 4. Kiểm tra giao dịch thành công
        if ($request->get('vnp_ResponseCode') !== '00') {
            return redirect()->route('views.cart')
                ->with('error', 'Thanh toán VNPAY không thành công: '
                    . $request->get('vnp_ResponseCode'));
        }

        // 5. Lấy dữ liệu pending từ session
        $pending = session('pending_order');
        if (!$pending) {
            return redirect()->route('views.cart')
                ->with('error', 'Không tìm thấy dữ liệu đơn hàng sau khi thanh toán!');
        }

        // 6. Lưu Order & OrderDetail
        DB::transaction(function () use ($pending, $request) {
            $txRef = $request->get('vnp_TxnRef');
            $order = Order::create([
                'code' => $txRef,
                'table_id' => null,
                'id_user' => session('user_id'),
                'address' => $pending['address_id'],
                'id_staff' => null,
                'totalprice' => $pending['totalprice'],
                'voucher' => $pending['voucher_id'],
                'totalbill' => $pending['totalbill'],
                'statusorder' => 'Chờ Xác Nhận',
                'typepayment' => 2,
                'note' => $pending['note'],
                'type' => 1,
            ]);
            foreach ($pending['products'] as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'status' => 'Chờ xử lý',
                ]);
            }
        });

        // 7. Xóa session và thông báo
        session()->forget('pending_order');
        return redirect()->route('views.cart')
            ->with('success', 'Thanh toán VNPAY thành công!');
    }



    public function toggleFavorite(Request $request)
    {
        $data = $request->validate([
            'food_id' => 'required|exists:foods,id',
        ]);

        $userId = session('user_id');
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để sử dụng chức năng này!'
            ], 401);
        }

        $type = 'Yêu Thích';

        // Kiểm tra đã yêu thích chưa
        $fav = Cart::where('user_id', $userId)
            ->where('food_id', $data['food_id'])
            ->where('type', $type)
            ->first();

        if ($fav) {
            // đã có → xoá
            $fav->delete();
            return response()->json([
                'success' => true,
                'favorited' => false,
                'message' => 'Đã xoá khỏi danh sách yêu thích'
            ]);
        } else {
            // chưa có → tạo mới
            Cart::create([
                'user_id' => $userId,
                'food_id' => $data['food_id'],
                'quantity' => 1,
                'type' => $type,
            ]);
            return response()->json([
                'success' => true,
                'favorited' => true,
                'message' => 'Đã thêm vào danh sách yêu thích'
            ]);
        }
    }

    public function updateQuantityCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        // action: 'increment' hoặc 'decrement'
        $action = $request->input('action');
        if ($action === 'increment') {
            $cart->increment('quantity', 1);
        } elseif ($action === 'decrement') {
            if ($cart->quantity > 1) {
                $cart->decrement('quantity', 1);
            } else {
                // nếu xuống 0 thì xóa
                $cart->delete();
                return response()->json([
                    'success' => true,
                    'removed' => true,
                    'id' => $id,
                    'cartTotal' => $this->recalcCartTotal(),
                ]);
            }
        }

        // tính lại tổng tiền item này và tổng tiền giỏ hàng
        $itemTotal = $cart->quantity * $cart->food->price;
        return response()->json([
            'success' => true,
            'removed' => false,
            'id' => $id,
            'quantity' => $cart->quantity,
            'itemTotal' => $itemTotal,
            'cartTotal' => $this->recalcCartTotal(),
        ]);
    }

    // DELETE /cart/{id}
    public function destroyCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json([
            'success' => true,
            'removedId' => $id,
            'cartTotal' => $this->recalcCartTotal(),
        ]);
    }

    protected function recalcCartTotal()
    {
        $userId = session('user_id');
        return Cart::where('user_id', $userId)
            ->where('type', 'Giỏ Hàng')
            ->get()
            ->sum(fn($c) => $c->quantity * $c->food->price);
    }

    public function deskmanage()
    {
        return view('deskmanage');
    }




    public function login(Request $request)
    {

        if (session()->has('staff_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        if (session()->has('user_logged_in')) {
            return redirect()->route('views.index');
        }
        // Nếu là GET thì chỉ show form đăng nhập, không validate gì cả
        if ($request->isMethod('get')) {
            // Đảm bảo có flash 'form' để JS mở đúng form nếu bạn dùng toggleForms()
            $request->session()->flash('form', 'login');
            return view('login');
        }

        // Nếu là POST (submit login) thì xử lý như sau
        $request->session()->flash('form', 'login');

        // Validation cơ bản
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Vui lòng nhập tài khoản.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $inputUser = $request->username;
        $inputPass = $request->password;

        // 1) Thử đăng nhập bằng Staff (ma_nv / CCCD)
        $staff = Staff::where('code_nv', $inputUser)
            ->where('CCCD', $inputPass)
            ->first();

        if ($staff) {
            session([
                'staff_logged_in' => true,
                'staff_id' => $staff->id,
                'staff_name' => $staff->fullname,
                'staff_email' => $staff->email,
                'staff_role' => $staff->role,
            ]);
            return redirect()->route('admin.dashboard')
                ->with('success', 'Đăng nhập Admin thành công!');
        }

        // 2) Thử đăng nhập bằng User (user / hashed password)
        $user = User::where('user', $inputUser)->first();
        if ($user && Hash::check($inputPass, $user->password)) {
            session([
                'user_logged_in' => true,
                'user_id' => $user->id,
                'user_name' => $user->fullname,
                'user_sdt' => $user->sdt,
                'user_email' => $user->email,
                'user_birthday' => $user->birthday,
                'user_gender' => $user->gender,
                'user_avatar' => $user->avatar,
            ]);
            return redirect()->route('views.index')
                ->with('success', 'Đăng nhập thành công!');
        }

        // Nếu cả 2 đều không khớp
        return redirect()->back()
            ->withErrors(['failed' => 'Tài khoản hoặc mật khẩu không chính xác'])
            ->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        // Xóa tất cả session liên quan đến đăng nhập
        $request->session()->flush();
        return redirect('/login')->with('success', 'Đăng xuất thành công');
    }

    /**
     * Xử lý ĐĂNG KÝ (Register)
     */
    public function register(Request $request)
    {
        // đánh dấu form đang submit register để JS bật đúng block
        $request->session()->flash('form', 'register');

        // Validation 5 trường: fullname, sdt, user, password_plain, password_plain_confirmation, email
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'sdt' => 'required|string|max:20|unique:users,sdt',
            'user' => 'required|string|max:50|unique:users,user',
            'password_plain' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/[!@#$%^&*(),.?":{}|<>]/'
            ],
            'email' => 'required|email|unique:users,email',
        ], [
            'fullname.required' => 'Bạn cần nhập Họ và tên.',
            'sdt.required' => 'Bạn cần nhập Số điện thoại.',
            'sdt.unique' => 'SDT đã tồn tại.',
            'user.required' => 'Bạn cần nhập Username.',
            'user.unique' => 'Username đã tồn tại.',
            'password_plain.required' => 'Bạn cần nhập Password.',
            'password_plain.min' => 'Password phải ít nhất 6 ký tự.',
            'password_plain.confirmed' => 'Xác nhận Password không khớp.',
            'password_plain.regex' => 'Password phải chứa ít nhất một ký tự đặc biệt (ví dụ: !@#$%^&*).',
            'email.required' => 'Bạn cần nhập Email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('form', 'register')
                ->with('show_register', true);
        }

        // Tạo token xác nhận
        $token = Str::random(40);
        $now = Carbon::now();

        // Lưu user mới
        $user = new User();
        $user->fullname = $request->fullname;
        $user->sdt = $request->sdt;
        $user->user = $request->user;
        $user->password = Hash::make($request->password_plain);
        $user->email = $request->email;
        $user->email_verify_token = $token;
        $user->token_created_at = $now;
        $user->role = 0;
        $user->save();

        // Gửi email xác nhận
        $this->sendVerificationEmail($user);

        return redirect()->back()
            ->with('success_register', 'Đăng ký thành công! Vui lòng kiểm tra email để xác nhận.')
            ->with('form', 'register')
            ->with('show_register', true);
    }



    /**
     * Gửi Email xác nhận
     */
    protected function sendVerificationEmail(User $user)
    {
        $verifyUrl = route('verify.email', ['token' => $user->email_verify_token]);
        $minutes = 60; // token hiệu lực 60 giây (mặc định)

        $data = [
            'name' => $user->fullname,
            'verifyUrl' => $verifyUrl,
            'minutes' => $minutes,
        ];

        Mail::send('emails.verify-email', $data, function ($message) use ($user) {
            $message->to($user->email, $user->fullname)
                ->subject('Xác nhận Email Đăng ký');
        });
    }

    /**
     * Xử lý Verify Email khi user click link
     */
    public function verifyEmail($token)
    {
        $user = User::where('email_verify_token', $token)->first();

        if (!$user) {
            // Link sai
            return view('auth-verify-result', [
                'status' => 'invalid',
                'message' => 'Link xác nhận không hợp lệ.'
            ]);
        }

        // Kiểm tra thời gian token (tối đa 60 giây)
        $tokenAge = Carbon::now()->diffInSeconds($user->token_created_at);
        if ($tokenAge > 60) {
            // Token hết hạn
            return view('auth-verify-result', [
                'status' => 'expired',
                'message' => 'Link xác nhận đã hết hạn (hơn 60 giây).'
            ]);
        }

        // Nếu chưa xác thực
        if (!$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
            $user->email_verify_token = null;
            $user->token_created_at = null;
            $user->save();
        }

        return view('auth-verify-result', [
            'status' => 'success',
            'message' => 'Email đã được xác nhận thành công! Bạn có thể đăng nhập ngay.'
        ]);
    }


}
