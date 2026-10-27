<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $storeName = "CineBook Library";
        $filter = $request->query('type', 'All');
        $search = $request->query('search');

        // Build query for database books
        $query = Book::query();

        if ($filter !== 'All') {
            $query->where('type', $filter);
        }

        // Fixed search query typo
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        // Fetch filtered results from database
        $displayProducts = $query->get();

        return view('index', [
            'storeName' => $storeName,
            'displayProducts' => $displayProducts,
            'filter' => $filter
        ]);
    }

    public function addToCart(Request $request)
    {
        $title = $request->input('title');
        $price = $request->input('price');

        $cart = $request->session()->get('cart', []);

        $found = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['title'] === $title) {
                $cartItem['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'title' => $title,
                'price' => $price,
                'quantity' => 1
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.view');     
    }

    public function viewCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        return view('cart', ['cart' => $cart]);
    }

    public function removeFromCart(Request $request)
    {
        $title = $request->input('title');
        $cart = $request->session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['title'] === $title) {
                unset($cart[$key]);
                break;
            }
        }

        $request->session()->put('cart', array_values($cart));

        return redirect()->route('cart.view')->with('success', 'Item removed from cart!');
    }

    public function clearCart(Request $request)
    {
        $request->session()->forget('cart');

        return redirect()->route('cart.view')->with('success', 'Cart cleared successfully!');
    }

    public function adminIndex()
    {
        $books = Book::all();
        return view('admin', ['books' => $books]);  
    }

    public function storeBook(Request $request) 
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'image' => 'required',
            'detailLabel' => 'required',
            'detailVal' => 'required',
            'price' => 'required',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.index')->with('success', 'New item added to catalog successfully!');
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.index')->with('success', 'Item deleted from catalog!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)  
    {
        // Fixed typo from 'vaidate' to 'validate'
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,  
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('catalog')->with('success', 'Account created successfully!');
    }

    // Added missing showLogin method
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('catalog')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('catalog')->with('success', 'Logged out successfully!');
    }

    public function chechout(Request $request)  
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error','Your cart is empty!');
        }

        //clear the cart session after successful checkout
        $request->session()->forget('cart');

        return redirect()->route('catalog')->with('success','Order placed successful! Thank you for shopping with CineBook Library.');
    }
}