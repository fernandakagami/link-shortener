<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            return Url::where('users_id', $request->user()->id)->get();
        }  
        catch (\Exception $e)
        { 
            return response()->json([ 
                'message' => "Não foi possível encontrar links", 
                'error' => $e->getMessage(),
                'status' => 400 
            ]);
        }
    }

    public function store(Request $request)
    {            
        try
        {
            $request->validate([            
                'original_url' => 'required|string|max:255|url',
            ]);
            $data = $request->all();
            $data['users_id'] = $request->user()->id;        
            $data['original_url'] = $request->original_url;
            $data['shortener_url'] = Str::random(15);
            Url::create($data);
            return response($data, 200);
        }  
        catch (\Exception $e)
        { 
            return response()->json([ 
                'message' => "Não foi possível salvar", 
                'error' => $e->getMessage(),
                'status' => 400 
            ]);
        }          
      
    }
}