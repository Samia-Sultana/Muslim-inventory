<?php



namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Response;
use JetBrains\PhpStorm\Pure;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Image;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $purchases = Purchase::all();
        return view('createPurchase', compact('products', 'suppliers', 'purchases'));
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
        $names = $request->input('name');
        $skus = $request->input('token');
        $weights = $request->input('weight');
        $bangla_weights = $request->input('bangla_weight');
        $carats = $request->input('carat');
        $buying_prices = $request->input('buying_price');
        $total_qtys = $request->input('total_qty');
        $thumbnails = $request->file('thumbnail');
        $buying_prices = $request->input('buying_price');
       

        foreach($names as $key => $name) {
            $product = new Product;
            $product->name = $name;
            $product->sku = $skus[$key];
            $product->carat = $carats[$key];
            $product->weight = $weights[$key];
            $product->bangla_weight = $bangla_weights[$key];
    
            if ($thumbnails[$key]) {
                $image = $thumbnails[$key];
                
                $compressedImage = $this->compressImage($image);
                $product->thumbnail = $compressedImage;
                
            }
            
            $product->save();

            $purchase = Purchase::create([
                'product_id' => $product['id'],
                'supplier_id' => $request->supplier,
                'buying_price' => $buying_prices[$key],
               
                'purchase_date' => $request->purchase_date,
               
                'batch_no' => $request->batch_no,
                
                'total_qty' => $total_qtys[$key],
                'available_qty' => $total_qtys[$key],
                'barcode' => $skus[$key] ,
    
    
            ]);
            $purchase->save();
    
        }

        
        
        

        $notification = array(
            'message' => 'Purchase information added!',
            'alert-type' => 'success'
        );
        return redirect()->route('addPurchasePage')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $purchases = Purchase::all();
        return view('purchaseList', compact('products', 'suppliers', 'purchases'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {

        $purchase = Purchase::find($request->purchaseId);
        $product = Product::find($request->product);
        $purchase->update([
            'product_id' => $request->product,
            'supplier_id' => $request->supplier,
            'buying_price' => $request->buyingPrice,
           
            'purchase_date' => $request->purchaseDate,
            
            'total_qty' => $request->totalQty,
            'available_qty' => $request->totalQty,
            'barcode' => $product['sku'] ,
        ]);

        $notification = array(
            'message' => 'Purchase information updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('addPurchasePage')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Purchase $purchase)
    {
        $id = $request->purchase_id;
        Purchase::find($id)->delete();
        $notification = array(
            'message' => 'Purchase Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('addPurchasePage')->with($notification);
    }

    public function generateBarcode(Request $request)
    {
        $barcode = $request->barcode;
        $generator = new BarcodeGeneratorJPG();
        file_put_contents('photos/'. $barcode .'.jpg', $generator->getBarcode($barcode, $generator::TYPE_CODE_128));
        $filepath = public_path('photos/'). $barcode .".jpg";
        return Response::download($filepath);
        
    }



    public function barcode()
    {
        return view('barcodeGenerator');
    }
}
