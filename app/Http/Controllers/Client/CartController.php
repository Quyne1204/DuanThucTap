<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    protected $cart;
    protected $book;
    protected $user;
    protected $order;
    public function __construct(Book $book, Cart $cart, User $user, Order $order)
    {
        $this->book = $book;
        $this->cart = $cart;
        $this->user = $user;
        $this->order = $order;
    }
    /**
     * Display a listing of the resource.
     */
    public function thank()
    {
        $cates = Category::all();
        $books = Book::all();
        $carts = null;
        if (Auth::check()) {
            $carts = DB::table('carts')
                ->select('carts.quantity', 'carts.money', 'books.title_book', 'books.image', 'carts.id', 'carts.book_id')
                ->join('books', 'books.id', '=', 'carts.book_id')
                ->where('carts.user_id', '=',  Auth::user()->id)
                ->get();
        }
        return  view('client.carts.thanks', compact('cates', 'books', 'carts'));
    }
    public function index()
    {
        $cates = Category::all();
        $books = Book::all();
        $carts = DB::table('carts')
            ->select('carts.quantity', 'carts.money', 'books.title_book', 'books.image', 'carts.id', 'carts.book_id')
            ->join('books', 'books.id', '=', 'carts.book_id')
            ->where('carts.user_id', '=',  Auth::user()->id)
            ->get();

        return view('client.carts.index', compact('cates', 'books', 'carts'));
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $book = $this->book->findOrFail($request->book_id);

        $cartBook = $this->cart->getBy1($book->id);
        if ($cartBook) {
            if ($request->quantity) {
                $quantity = $cartBook->quantity;
                $cartBook->update(['quantity' => ($quantity + $request->qty)]);
            } else {
                $quantity = $cartBook->quantity;
                $cartBook->update(['quantity' => ($quantity + 1)]);
            }
        } else {
            $dataCreate['user_id'] = $user->id;
            $dataCreate['book_id'] = $request->book_id;
            $dataCreate['quantity'] = $request->qty ?? 1;
            $dataCreate['money'] = $book->price;
            $this->cart->create($dataCreate);
        };

        return redirect()->back()->with(['message' => 'Thêm Vào Giỏ Hàng Thành Công']);
    }

    public function updateCart(Request $request, $id)
    {
        $quantity = $request->input('quantity');
        $cart = DB::table('carts')->where('id', $id)->update(['quantity' => $quantity]);
        return redirect()->back()->with(['message' => '']);
    }

    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with(['message' => '']);
    }
    public function deleteCartAll()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with(['message' => '']);
    }
    public function checkout()
    {
        $cates = Category::all();
        $books = Book::all();
        $user = $this->user->findOrFail(Auth::user()->id);
        $carts = null;
        if (Auth::check()) {
            $carts = DB::table('carts')
                ->select('carts.quantity', 'carts.money', 'books.title_book', 'books.image', 'carts.id', 'carts.book_id')
                ->join('books', 'books.id', '=', 'carts.book_id')
                ->where('carts.user_id', '=',  Auth::user()->id)
                ->get();
        }

        return view('client.carts.checkout', compact('cates', 'books', 'carts', 'user'));
    }

    public function processCheckout(CheckoutRequest $request)
    {
        if (isset($_POST['pay'])) {


            $dataCreate1['name'] = $request->customer_name;
            $dataCreate1['phone'] = $request->customer_phone;
            $dataCreate1['address'] = $request->customer_address;
            $dataCreate1['status'] = 1;
            $dataCreate1['email'] = $request->email;
            $dataCreate1['note'] = $request->note;
            $dataCreate1['ship'] = $request->ship;
            $dataCreate1['total'] = $request->total;
            $dataCreate1['id_customer'] = Auth::user()->id;
            $dataCreate1['payment'] = "Nhận Hàng Thanh Toán";
            $dataCreate1['date'] = new DateTime('now');
            $this->order->create($dataCreate1);
            Cart::where('user_id', Auth::id())->delete();

            return redirect()->route('thank')->with('success', 'Đặt hàng thành công! Cảm ơn bạn đã mua hàng của shop ♥');
        }
    }

    public function vnpay_payment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/thank";
        $vnp_TmnCode = "1HLTLAQK"; //Mã website tại VNPAY
        $vnp_HashSecret = "FSUGEUIUTGKUQNUSUFTTBCAPCHCQSDGH"; //Chuỗi bí mật

        $vnp_TxnRef = rand(00, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Noi dung thanh toan';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 200000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
