<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use Auth;
use Image;

class PostController extends Controller
{
    //
  /*  public function __construct()
    {
        $this->middleware('auth');
    }
*/
    public function all_post(){
    $posts = Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts'=>$posts
        ],200);

      /*  $post=Post::all();
        return $post;*/
     }
     public function save_post(Request $request){

      $this->validate($request,[
          'titulo'=>'required|min:2|max:50',
          'descripcion'=>'required|min:2|max:1000'
      ]);
     $strpos = strpos($request->foto,';');
      $sub = substr($request->foto,0,$strpos);
      $ex = explode('/',$sub)[1];
      $name = time().".".$ex;
      $img = Image::make($request->foto)->resize(200, 200);
      $upload_path = public_path()."/uploadimage/";
      $img->save($upload_path.$name);

      $post = new Post();
      $post->titulo = $request->titulo;
      $post->descripcion = $request->descripcion;
      $post->cat_id = $request->cat_id;
      $post->user_id = Auth::user()->id;
      $post->foto = $name;
      $post->save();
  }
  public function delete_post($id){
      $post = Post::find($id);
      $image_path = public_path()."/uploadimage/";
      $image = $image_path. $post->photo;
      if(file_exists($image)){
          @unlink($image);
      }
      $post->delete();
  }
  public function edit_post($id){
    $post = Post::find($id);
    return response()->json([
        'post'=>$post
    ],200);
  }
  public function update_post(Request $request, $id){
      $post = Post::find($id);
      $this->validate($request,[
          'titulo'=>'required|min:2|max:50',
          'descripcion'=>'required|min:2|max:1000'
      ]);


      if($request->foto!=$post->foto){
          $strpos = strpos($request->foto,';');
          $sub = substr($request->foto,0,$strpos);
          $ex = explode('/',$sub)[1];
          $name = time().".".$ex;
          $img = Image::make($request->foto)->resize(200, 200);
          $upload_path = public_path()."/uploadimage/";
          $image = $upload_path. $post->foto;
          $img->save($upload_path.$name);

          if(file_exists($image)){
              @unlink($image);
          }
      }else{
          $name = $post->foto;
      }

      $post->titulo = $request->titulo;
      $post->descripcion = $request->descripcion;
      $post->cat_id = $request->cat_id;
      $post->user_id = Auth::user()->id;
      $post->foto = $name;
      $post->save();
  }

}
