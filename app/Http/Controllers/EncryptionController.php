<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\SensitiveData;

class EncryptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $data = auth()->check() ? SensitiveData::all() : collect();
        return view('encryption.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sensitive_data' => 'required|string',
            'mode' => 'required|in:secure,insecure',
        ]);

        $sensitiveData = $request->input('sensitive_data');
        $mode = $request->input('mode');

        if ($mode === 'secure') {
            $encryptedData = Crypt::encryptString($sensitiveData);
        } else {
            $encryptedData = $this->insecureEncrypt($sensitiveData);
        }

        SensitiveData::create([
            'encrypted_data' => $encryptedData,
            'mode' => $mode,
        ]);

        return redirect()->route('encryption.index')->with('success', 'Data encrypted and stored successfully.');
    }

    public function decrypt($id)
    {
        $sensitiveData = SensitiveData::findOrFail($id);
        
        if ($sensitiveData->mode === 'secure') {
            $decryptedData = Crypt::decryptString($sensitiveData->encrypted_data);
        } else {
            $decryptedData = $this->insecureDecrypt($sensitiveData->encrypted_data);
        }

        return response()->json(['decrypted_data' => $decryptedData]);
    }

    private function insecureEncrypt($data)
    {
        // This is a very weak encryption method for demonstration purposes only
        return base64_encode(strrev($data));
    }

    private function insecureDecrypt($data)
    {
        // This is a very weak decryption method for demonstration purposes only
        return strrev(base64_decode($data));
    }
}