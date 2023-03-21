<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        
        return view('createProduct');
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
     * 
     * 
     */

     public function compressImage($file)
     {
         $image = Image::make($file);
         $image->resize(null, 400, function ($constraint) {
             $constraint->aspectRatio();
         });
        
         $image->encode('jpg', 80);
     
         while (strlen($image) > 80000) {
             $image->resize(floor($image->width() * 0.9), floor($image->height() * 0.9), function ($constraint) {
                 $constraint->aspectRatio();
             });
             $image->encode('jpg', 80);
         }
     
         $thumbnailImageName = 'compressed_' . time() . '.jpg';
         $image->save('photos/' . $thumbnailImageName);
         return $thumbnailImageName;
     }
    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->file('thumbnail')) {
            $image = $request->file('thumbnail');
            $compressedImage = $this->compressImage($image);
              
        }
        Product::create([
            'name' => $input['name'],
            'sku' => $input['sku'],
            'thumbnail' => $compressedImage,
            'description' => $input['description'],
            'diamond_piece' => $request->diamond_piece,
            'gold_weight' => $request->gold_weight,
            'diamond_weight' => $request->diamond_weight
           
        ]);


        $notification = array(
            'message' => 'New Product added!',
            'alert-type' => 'success'
        );

        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('addProductPageDiamond')->with($notification);

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('addProductPage')->with($notification);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product)
    {
        $products = Product::all();
        return view('productList', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $Product)
    {
        $id = $request->update_productId;
        $input = $request->all();

       $product =  Product::find($id);

       if ($request->file('update_thumbnail')) {
        $thumbnailImage = $request->file('update_thumbnail');
        $thumbnailImageName = date('YmdHi') . $thumbnailImage->getClientOriginalName();
        Image::make($thumbnailImage)->save('photos/'.$thumbnailImageName);
        $save_url = 'photos/'.$thumbnailImageName;

        $product->update([
            'name' => $input['update_name'],
            'sku' => $input['update_sku'],
            'thumbnail' => $thumbnailImageName,
            'gold_weight' => $input['update_gold_weight'],
            'diamond_weight' => $input['update_diamond_weight'],
            'diamond_piece' => $input['update_diamond_piece'],
            
        ]);


    }
    else{
        $product->update([
            'name' => $input['update_name'],
            'sku' => $input['update_sku'],
            'gold_weight' => $input['update_gold_weight'],
            'diamond_weight' => $input['update_diamond_weight'],
            'diamond_piece' => $input['update_diamond_piece'],
            
        
        ]);

    }
       
        $notification = array(
            'message' => 'Product updated!',
            'alert-type' => 'success'
        );
        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('addProductPageDiamond')->with($notification);

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('addProductPage')->with($notification);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $Product)
    {
        $id = $request->product_id;
        Product::find($id)->delete();
        
        
        $notification = array(
            'message' => 'Product Deleted!',
            'alert-type' => 'success'
        );
        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('addProductPageDiamond')->with($notification);

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('addProductPage')->with($notification);

        }        
    }
}
