<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ProductTrait;
    public function index()
    {
        return $this->successfulResponse(200, 'success', ProductResource::collection(Product::all()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create a new resource
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Carbon::now()->format('YmdHis') . '.' . $extension;
            $file->storeAs('/public/images', $filename);
            $data['image'] = $filename;
        }

        $product = Product::create($data);
        return $this->successfulResponse(200, 'Product Created successfully!', new ProductResource($product));

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::find($product->id);
        if ($product) {
            return $this->successfulResponse(200, 'success', new ProductResource($product));
        } else {
            return $this->failedResponse(404, 'Product not found!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product = Product::find($product->id);

        $data = $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {

            Storage::delete('/public/images/' . $product->image);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Carbon::now()->format('YmdHis') . '.' . $extension;
            $file->storeAs('/public/images', $filename);
            $data['image'] = $filename;

        }


        $product->update($data);
        return $this->successfulResponse(200, 'Product Updated successfully!', new ProductResource($product));

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::find($product->id);
        try {
            $product->delete();
            return $this->successfulResponse(200, 'Product Deleted successfully!');
        } catch (\Exception $e) {
            return $this->failedResponse(500, $e->getMessage());
        }
    }
}