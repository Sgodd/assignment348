<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (Role::hasPermission($user->role->permissions_flag, "READ")) {
            $posts = Post::orderBy('created_at', 'DESC')->where("reply_id", NULL)->paginate(15);
            return view('home', ['posts' => $posts]);
        } else {
            return $user;
            // return view('forbidden', ['posts' => null]);
        }

        // return $posts;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $user = auth()->user();

        $post = Post::create([
            'user_id' =>$user->id,
            'text' => $request->body,
        ]);

        if ($request->file('image') != null) {
            $path = $request->file('image')->store('images');
            $image = Image::create([
                'path' => $path,
                'imageable_type' => Post::class,
                'imageable_id' => $post->id
            ]);
    
            $post->image_id = $image->id;
            $image->save();
        }

       

        $post->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::user();
        $post = Post::find($id);
        $replies = $post->replies;

        return view('posts.post', ['post' => $post, 'replies' => $replies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
