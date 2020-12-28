<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\Role;
use Exception;
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
            $path = $request->file('image')->store('public/images');
            $path = substr($path, strlen('public/'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        $user = auth()->user();

        $post = Post::create([
            'user_id' =>$user->id,
            'reply_id' => $request->post_id,
            'text' => $request->reply,
        ]);

        $post->save();

        return view('posts.reply', ["replies"=>[], "reply"=>$post, "depth"=>0, "deleted"=>false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = auth()->user();
        
        $post = Post::find($request->post_id);

        $text = $request->text; 

        $flag = $user->role->permissions_flag;
        if ($user->id == $post->user_id or Role::hasPermission($flag, "EDIT_ALL")) {
            if (!ctype_space($text)) {
                $post->text = $text;
                $post->save();
            } else {
                return false;
            }
            return true;
        } else {
            return false;
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $user = auth()->user();
        $post = Post::find($request->post_id);

        $flag = $user->role->permissions_flag;

        if ($user->id == $post->user_id or Role::hasPermission($flag, "DELETE_ALL")) {
            $post->delete();
            $post->save();
        }

        return true;
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
        
    }
}
