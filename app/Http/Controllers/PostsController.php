<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Storage;

class PostsController extends Controller
{
  
  public function add()
  {
      return view('post.create');
  }

  
  public function create(Request $request)
  {
      $post = new Post;
      
      $form = $request->all();
      
        //s3アップロード開始
        $image = $request->file('image');
        // バケットの`gazou1011`フォルダへアップロード
        $path = Storage::disk('s3')->putFile('gazou1011', $image, 'public');
        // アップロードした画像のフルパスを取得
        $post->image_path = Storage::disk('s3')->url($path);
      
        $post->save();
      
        return view('post.index',['post' => $post]);
       }
       
 public function index(Request $request)
       {
       $posts = Post::all();

       return view('posts.index', ['posts' => $posts]);
       }
       }