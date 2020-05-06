<?php

namespace App\Http\Controllers;
use App\Categorias;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_category(Request $request){
		
        $this->validate($request,[
            'nombre'=>'required|min:2|max:100',
            'descripcion'=>'required|min:2|max:300'
          
        ]);
       $category = New Categorias();
       $category->cat_nombre = $request->nombre;
       $category->cat_descripcion = $request->descripcion;
       $category->save();
       return ['message'=>'OK'];
    }
    public function all_category(){
        $categories = Categorias::all();
        return response()->json([
            'categories'=>$categories
        ],200);
    }

    public function delete_category($id){
        $category = Categorias::find($id);
        $category->delete();
    }
    public function edit_category($id){
        $category = Categorias::find($id);
        return response()->json([
            'category'=>$category
        ],200);
    }
    public function update_category(Request $request,$id){
        $this->validate($request,[
            'cat_nombre'=>'required|min:2|max:100',
            'cat_descripcion'=>'required|min:2|max:300'
        ]);
        $category = Categorias::find($id);
        $category->cat_nombre = $request->cat_nombre;
        $category->cat_descripcion = $request->cat_descripcion;
        $category->save();
    }
    
}
