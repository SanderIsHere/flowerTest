<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        // Validasi bahasa yang diizinkan
        if (in_array($lang, ['en', 'id'])) {
            // Simpan pilihan bahasa ke session
            Session::put('locale', $lang);
        }

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back();
    }
}
