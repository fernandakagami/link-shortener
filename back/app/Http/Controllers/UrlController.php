<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    public function index(Request $request)
    {
        return Url::where('users_id', $request->user()->id)->get();
    }

    public function store(Request $request)
    {                      
        $request->validate([            
            'original_url' => 'required|string|max:255|url',
        ]);
        $data = $request->all();
        $data['users_id'] = 1;        
        $data['original_url'] = $request->original_url;
        $data['shortener_url'] = Str::random(15);
        Url::create($data);
        return $data;
    }
}