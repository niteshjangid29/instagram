<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (Auth::user()) ? Auth::user()->following->contains($user->id) : false;
        // dd($user);
        // $user = User::findOrFail($user);
        // return view('profiles.index', [
        //     'user' => $user
        // ]);
        return view('profiles.index', compact('user', 'follows'));
    }

    public function edit(User $user){
        $this->authorize('update', $user->profile);
        
        return view('profiles.edit', compact('user'));
    }
    
    public function update(User $user){

        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        
        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        Auth::user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        // dd($data);
        return redirect("/profile/{$user->id}");
    }

}
