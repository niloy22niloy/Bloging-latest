<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function category_insert_form(){
        return view('admin.category_insert_form');
    }
    function category_insert(Request $request){
        
        if($request->category_image){
            $imageName = $request->category_name.'.'.$request->category_image->extension();

        // Public Folder
        $request->category_image->move(public_path('category_images'), $imageName);
            CategoryModel::create([
                'category_name'=>$request->category_name,
                'category_image'=>$imageName,
            ]);
            return redirect('/category/show')->with('success','Category Inserted Successfully');
        }
        else{
            CategoryModel::create([
                'category_name'=>$request->category_name,
                
            ]);
            return redirect('/category/show')->with('success','Category Inserted Successfully');
        }
    }
    function category_show(){
        $categories = CategoryModel::all();
        return view('admin.category_show',[
            'categories'=>$categories,
        ]);

    }
    function category_delete($id){
        $imagePath = CategoryModel::select('category_image')->where('id', $id)->first();

         $filePath = $imagePath->image;

                   if (file_exists($filePath)) {

                   unlink($filePath);

                   CategoryModel::where('id', $id)->delete();
                   

        }else{

            CategoryModel::where('id', $id)->delete();
        }
        return back()->with('success',"Category Deleted Successfully");

    }
    function category_edit($id){
        $category = CategoryModel::find($id);
        return view('admin.category_edit_page',[
            'category'=>$category,
        ]);

    }
    function category_edit_confirm(Request $request,$id){
        
        if($request->category_image){
            $imageName = $request->category_name.'.'.$request->category_image->extension();

            // Public Folder
            $request->category_image->move(public_path('category_images'), $imageName);
            CategoryModel::where('id',$id)->update([
              'category_name'=>$request->category_name,
              'category_image'=> $imageName,
            ]);
           

        }
        else{
            CategoryModel::where('id',$id)->update([
                'category_name'=>$request->category_name,
                
              ]);
             
        }
        return redirect('/category/show')->with('success','Category Updated Successfully');
    }
}
