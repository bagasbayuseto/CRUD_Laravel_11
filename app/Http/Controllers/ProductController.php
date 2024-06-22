<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //fungsi atau metode untuk menampilkan 
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();

        return view('products.list', [
            'products' => $products
        ]);
    }

    //fungsi atau metode untuk menampilkan page 
    public function create()
    {
        return view('products.create');
    }
    //fungsi atau metode untuk mengarah ke database 
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        //validasi jika kosong
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        //tambah data ke database
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            // upload gambar
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //nama berdasarkan waktu

            // url simpan gambar
            $image->move(public_path('uploads/products'), $imageName);

            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Sucsess Create');
    }

    //fungsi atau metode untuk menampilkan edit 
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    //fungsi atau metode untuk memproses update 
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        //validasi jika kosong
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        //update data ke database
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            //hapus gambar
            File::delete(public_path('uploads/products/' . $product->image));

            // upload gambar
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //nama berdasarkan waktu

            // url simpan gambar
            $image->move(public_path('uploads/products'), $imageName);

            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Sucsess Update');
    }

    //fungsi atau metode untuk menghapus 
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Pindahkan file gambar yang terkait ke direktori backup
        if (File::exists(public_path('uploads/products/' . $product->image))) {
            File::move(public_path('uploads/products/' . $product->image), public_path('uploads/backup/' . $product->image));
        }

        // Hapus data produk
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sucsess Delete');
    }
}
