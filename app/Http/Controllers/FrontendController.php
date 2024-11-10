<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::where('is_active', true)
            ->latest()
            ->take(6)
            ->get();
            
        $categories = Category::where('is_active', true)->get();
        
        return view('frontend.home', compact('featuredProducts', 'categories'));
    }

    public function products(Request $request)
    {
        $query = Product::where('is_active', true);
        
        if ($request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->latest()->paginate(12);
        $categories = Category::where('is_active', true)->get();
        
        return view('frontend.products', compact('products', 'categories'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();
            
        return view('frontend.product-detail', compact('product', 'relatedProducts'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function whatsapp(Request $request)
    {
        $product = null;
        $message = "Halo, saya tertarik untuk ";
        
        if ($request->product_id) {
            $product = Product::findOrFail($request->product_id);
            $message .= "membeli produk *{$product->name}* dengan harga *Rp " . number_format($product->price, 0, ',', '.') . "*";
        } else {
            $message .= "bertanya tentang produk Anda";
        }
        
        $whatsappNumber = "082210819939";
        $url = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);
        
        return redirect($url);
    }
}
