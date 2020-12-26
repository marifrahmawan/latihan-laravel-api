<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get(){
        $data = Product::all();

        // return $data;
        return response()->json(
            [
                "message" => "GET Product Success",
                "data" => $data
            ]
        );
    }

    public function getById($id){
        $data = Product::findOrFail($id);
        return response()->json(
            [
                "message" => "GET By ID Product Success",
                "data" => $data
            ]
        );
    }

    public function post(Request $request){
        $product = new Product;
        $data = $request->all();

        $product->create($data);

        return response()->json(
            [
                "message" => "POST product Success",
                "data" => $data
            ]
        );
    }
    
    public function put(Request $request, $id){
        $product = Product::where('id', $id)->first();
        $data = $request->all();

        if($product){
            $product->update($data); // Update the Data

            return response()->json(
                [
                    "message" => "PUT Method Success ".$id,
                    "data" => $product
                ]
            );
        }
        else{
            return response()->json(
                [
                    "message" => "Product ".$id." Not Found",
                ], 400
            );
        }
    }

    public function delete($id){
        $product = Product::where('id', $id)->first();
        if ($product){
            $product->delete();
            
            return response()->json(
                [
                    "message" => "Product ".$id." Has Been Deleted"
                ]
            );
        }
        else{
            return response()->json(
                [
                    "message" => "Product ".$id." Not Found"
                ], 400
            );
        }        
    }

    public function search($name){
        $product = Product::where('name', 'like', '%'.$name.'%')->get();

        if(count($product) > 0){
            return response()->json(
                [
                    "message" => "Products with name ".$name." found",
                    "data" => $product
                ]
            );
        }
        else{
            return response()->json(
                [
                    "message" => "Products with name ".$name." not found",
                ]
            );
        }
    }
}