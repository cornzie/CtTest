<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveProductRequest;

class ProductController extends Controller
{
    //
    public function index()
    {
        // 
        return view('form')->with('products', collect(json_decode(Storage::get('products.json')))->sortByDesc('createdAt'));
    }

    public function storeProduct(SaveProductRequest $request)
    {
        $request->validated();

        try {

            $products = Storage::exists('products.json') ? collect(json_decode(Storage::get('products.json'))) : collect([]);
            
            $product = [
                'id' => Str::uuid(),
                'name' => $request->productName,
                'quantity' => $request->productQuantity,
                'price' => $request->productPrice,
                'totalValue' => ($request->productQuantity*$request->productPrice),
                'createdAt' => date(DATE_ATOM),
            ];

            $products->push($product);

            Storage::put('products.json', $products->toJson());

            return $request->wantsJson() ? response()->json($product) : back()->with('success', 'Produtc created');

        } catch (\Throwable $th) {
            //throw $th;
            Log::debug('StoreProductFailed', [
                'exception' => $th
            ]);

            return $request->wantsJson() ? response()->json(['error' => 'Something went wrong!'], 500) : back()->with('success', 'Product created');
        }





    }
}
