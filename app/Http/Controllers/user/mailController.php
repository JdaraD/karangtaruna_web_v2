<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\mail;
use Illuminate\Http\Request;

class mailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari user
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'no_telp' => 'required|string|max:20',
            'keperluan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'detail_keperluan' => 'required|string',
            'file_pdf' => 'nullable|mimes:pdf|max:5120', // Hanya PDF, maks 5MB
        ]);

        // 2. Proses upload file PDF jika ada
        $filePath = null;
        if ($request->hasFile('file_pdf')) {
            $filePath = $request->file('file_pdf')->store('lampiran_email', 'public');
        }

        try {
            mail::create([
                'nama' => $validatedData['nama'],
                'alamat' => $validatedData['alamat'],
                'email' => $validatedData['email'],
                'no_telp' => $validatedData['no_telp'],
                'keperluan' => $validatedData['keperluan'],
                'tanggal' => $validatedData['tanggal'],
                'detail_keperluan' => $validatedData['detail_keperluan'],
                'file_pdf' => $filePath,
            ]);
    
            // 4. Kembali ke halaman sebelumnya dengan pesan sukses
            return back()->with('success', 'Pesan dan dokumen Anda berhasil dikirim!');
            } catch (\Throwable $th) {
            return back()->with('gagal', 'Pesan dan dokumen Anda gagal dikirim!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
