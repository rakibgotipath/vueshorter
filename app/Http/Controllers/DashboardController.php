<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $urls = auth()->user()->urls()->latest()->paginate(10)->through(function ($url) {
            return [
                'id' => $url->id,
                'url' => Str::limit($url->url, 50, '...'),
                'code' => $url->code,
                'views' => $url->views,
                'click_url' => route('url', $url->code),
                'created_at' => $url->created_at->diffForHumans(),
            ];
        });

        $widget['total_urls'] = auth()->user()->urls()->count();
        $widget['total_views'] = auth()->user()->urls()->sum('views');

        return Inertia::render('Dashboard', [
            'pageTitle' => 'Dashboard',
            'urls' => $urls,
            'widget' => $widget,
        ]);
    }

    public function setting()
    {
        return Inertia::render('Setting', [
            'pageTitle' => 'Setting',
        ]);
    }

    public function settingUpdate(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.auth()->user()->id,
            'password' => 'nullable|string|min:6',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:1024',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->filled('password')){
            $user->password = bcrypt($request->password);
        }

        if($request->hasFile('image')){

            try {
                
                if($user->image){
                    //delete old image
                    Storage::disk('public')->delete($user->image);
                }
                
                $user->image = $request->file('image')->store('users', 'public');

            } catch (\Exception $e) {
                return redirect()->back()->withError(['message' => 'Something went wrong.']);
            }
        }

        $user->save();

        return redirect()->back()->withSuccess(['message' => 'Profile updated successfully.']);
    }
}
