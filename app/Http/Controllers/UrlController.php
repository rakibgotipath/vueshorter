<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    // redirect to original url
    public function index(Request $request, $code)
    {
        $url = Url::where('code', $code)->firstOrFail();
        $url->increment('views');
        return redirect($url->url);
    }

    // shorten url
    public function shorten(Request $request)
    {
        $request->validate([
            'url' => ['required', 'url']
        ]);

        try {

            $url = new Url();
            $url->user_id = $request->user()->id;
            $url->url = $request->url;
            $url->code = $this->generateRandomString();
            $url->save();

        } catch (\Throwable $th) {
            return back()->withError([
                'message' => 'Something went wrong, please try again later!'
            ]);
        }
        
        return back()->withSuccess([
            'message' => 'Shortened URL created successfully! ' . route('url', $url->code),
        ]);
    }

    // generate ransom unique 6 digit number from 0-9 and a-z
    private function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
