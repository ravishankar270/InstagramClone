<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{

    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }
    public function edit(\App\User $user)
    {
        $this->authorize('update',$user->profile);
        return view('profiles/edit',['user'=>$user,]);
    }
    public function update(\App\User $user)
    {
        $this->authorize('update',$user->profile);
        $data=request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'',
        ]);
        
        if(request('image')){
            $imagepath = request( 'image' )->store('profile','public');
        // dd(public_path("storage/{$imagepath}"));
        $image=Image::make(public_path("storage/{$imagepath}"))->fit(1000,1000);
        $image->save();
        $imageArray = ['image' => $imagepath];
        }
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        )); 
        return redirect("/profile/{$user->id}");
    }
    
}

