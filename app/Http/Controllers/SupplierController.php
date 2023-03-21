<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
        
    public function index()

    {
        return view('createSupplier');
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
        $input = $request->all();
        Supplier::create([
            'name' => $input['name'],
            'address' => $input['address'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'company_name' => $input['company_name']
        ]);


        $notification = array(
            'message' => 'New supplier added!',
            'alert-type' => 'success'
        );

        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('addSupplierPageDiamond')->with($notification);

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('addSupplierPage')->with($notification);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        
        $suppliers = Supplier::all();
        return view('supplierList', compact('suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $id = $request->update_supplierId;
        $input = $request->all();

       $supplier =  Supplier::find($id);
       $supplier->update([
            'name' => $input['update_name'],
            'address' => $input['update_address'],
            'email' => $input['update_email'],
            'phone' => $input['update_phone'],
            'company_name' => $input['update_company']
        ]);

        
        $notification = array(
            'message' => 'Supplier updated!',
            'alert-type' => 'success'
        );

        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('addSupplierPageDiamond')->with($notification);

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('addSupplierPage')->with($notification);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Supplier $supplier)
    {
        $id = $request->supplier_id;
        Supplier::find($id)->delete();
        
        $notification = array(
            'message' => 'Supplier Deleted!',
            'alert-type' => 'success'
        );

        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('addSupplierPageDiamond')->with($notification);

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('addSupplierPage')->with($notification);

        }
        
    }
}
