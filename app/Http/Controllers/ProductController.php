<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('is_login') != 1) {
            return redirect('/login');
        }
        $content = DB::table('product')->get();
        return view('welcome', compact('content'));
    }
    public function edit($id)
    {
        $content = DB::table('product')->where('id', $id)->first();
        return view('edit', compact('content'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'product_name' => 'required',
                'price' => 'required|numeric',
                'description' => 'required'
            ],
            [
                'product_name.required' => 'Product Name wajib diisi',
                'price.required' => 'Harga wajib diisi',
                'price.numeric' => 'Harga harus berupa angka',
            ]
        );

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $image) {
                $file = $image->getCLientOriginalName();
                $image->move(public_path() . '/img', $file);
                $dataImage[] = $file;
            }
        }

        if (count($dataImage) > 5) {
            return redirect()->back()->with('success', 'Oops maksimal upload 5 foto');
        }


        $data = [
            'id' => 'PR' . date('YmdHis'),
            'product_name' => $request->product_name,
            'price' => $request->price,
            'picture' => json_encode($dataImage),
            'created_at' => date('Y-m-d H:i:s'),
            'description' => $request->description
        ];


        $save = DB::table('product')->insert($data);
        if ($save) {
            return redirect('/')->with('success', 'Product berhasil ditambahkan');
        } else {
            return redirect('/')->with('warning', 'Oops terjadi suatu kesalahan');
        }
    }

    public function delete($id)
    {
        $content = DB::table('product')->where('id', $id)->delete();
        if ($content) {
            return redirect('/')->with('success', 'Berhasil menghapus data');
        } else {
            return redirect('/')->with('success', 'Ooops terjadi kesalaha dalam input product');
        }
    }
}
