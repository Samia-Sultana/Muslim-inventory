<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'role:manager')->group(function(){
    Route::get('/dashboard', function(){
        return view('manager.dashboard');
    })->name('dashboard');
});

Route::middleware('auth','role:admin')->group(function () {
    Route::get('/shop', function(){
        return view('admin.selectShop');
    })->name('shop');

    Route::get('/dashboard', function(){
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('diamond/dashboard', function(){
        return view('admin.dashboard');
    })->name('dashboard');

    /* supplier CRUD */
    Route::get('/supplier',[SupplierController::class,'index'])->name('addSupplierPage');
    Route::post('/supplier',[SupplierController::class,'store'])->name('addSupplier');
    Route::get('/supplier/list',[SupplierController::class,'show'])->name('supplierList');
    Route::post('/update/supplier',[SupplierController::class,'update'])->name('updateSupplier');
    Route::post('/delete/supplier',[SupplierController::class,'destroy'])->name('deleteSupplier');
    /* supplier CRUD end */

     /* supplier CRUD diamond*/
     Route::get('/diamond/supplier',[SupplierController::class,'index'])->name('addSupplierPageDiamond');
     Route::post('/diamond/supplier',[SupplierController::class,'store'])->name('addSupplierDiamond');
     Route::get('/diamond/supplier/list',[SupplierController::class,'show'])->name('supplierListDiamond');
     Route::post('/diamond/update/supplier',[SupplierController::class,'update'])->name('updateSupplierDiamond');
     Route::post('/diamond/delete/supplier',[SupplierController::class,'destroy'])->name('deleteSupplierDiamond');
     /* supplier CRUD end */

    /* product CRUD */
    Route::get('/product',[ProductController::class,'index'])->name('addProductPage');
    Route::post('/add/product',[ProductController::class,'store'])->name('addProduct');
    Route::get('/product/list',[ProductController::class,'show'])->name('productList');
    Route::post('/update/product',[ProductController::class,'update'])->name('updateProduct');
    Route::post('/delete/product',[ProductController::class,'destroy'])->name('deleteProduct');
    /* product CRUD end */

     /* product CRUD for diamond */
     Route::get('/diamond/product',[ProductController::class,'index'])->name('addProductPageDiamond');
     Route::post('/diamond/add/product',[ProductController::class,'store'])->name('addProductDiamond');
     Route::get('/diamond/product/list',[ProductController::class,'show'])->name('productListDiamond');
     Route::post('/diamond/update/product',[ProductController::class,'update'])->name('updateProductDiamond');
     Route::post('/diamond/delete/product',[ProductController::class,'destroy'])->name('deleteProductDiamond');
     /* product CRUD end */


    /* purchase CRUD */
    Route::get('/purchase',[PurchaseController::class,'index'])->name('addPurchasePage');
    Route::post('/add/purchase',[PurchaseController::class,'store'])->name('addPurchase');
    Route::get('/purchase/list',[PurchaseController::class,'show'])->name('purchaseList');
    Route::post('/update/purchase',[PurchaseController::class,'update'])->name('updatePurchase');
    Route::post('/delete/purchase',[PurchaseController::class,'destroy'])->name('deletePurchase');
    Route::post('/barcode',[PurchaseController::class,'generateBarcode'])->name('generateBarcode');
    /* purchase CRUD end */


    /* purchase CRUD diamond */
    Route::get('/diamond/purchase',[PurchaseController::class,'index'])->name('addPurchasePageDiamond');
    Route::post('/diamond/add/purchase',[PurchaseController::class,'store'])->name('addPurchaseDiamond');
    Route::get('/diamond/purchase/list',[PurchaseController::class,'show'])->name('purchaseListDiamond');
    Route::post('/diamond/update/purchase',[PurchaseController::class,'update'])->name('updatePurchaseDiamond');
    Route::post('/diamond/delete/purchase',[PurchaseController::class,'destroy'])->name('deletePurchaseDiamond');
    Route::post('/diamond/barcode',[PurchaseController::class,'generateBarcode'])->name('generateBarcodeDiamond');
    /* purchase CRUD end */

    /* orders CRUD */
    Route::get('/order',[OrderController::class,'index'])->name('addOrderPage');
    Route::post('/search/product', [OrderController::class,'searchProduct'])->name('searchProduct');
    Route::post('/search/customer', [OrderController::class,'searchCustomer'])->name('searchCustomer');
    Route::post('/order',[CartController::class,'addToCart'])->name('addToCart');
    Route::get('/order/list',[OrderController::class,'show'])->name('orderList');
    Route::post('/update-cart',[CartController::class,'updateCart'])->name('updateShoppingCart');
    Route::post('/remove/cart/product', [CartController::class, 'removeCartProduct'])->name('removeCartProduct');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/add/order',[OrderController::class,'store'])->name('addOrder');



     /* orders CRUD diamond*/
     Route::get('/diamond/order',[OrderController::class,'index'])->name('addOrderPageDiamond');
     Route::post('/diamond/search/product', [OrderController::class,'searchProduct'])->name('searchProductDiamond');
     Route::post('/diamond/search/customer', [OrderController::class,'searchCustomer'])->name('searchCustomerDiamond');
     Route::post('/diamond/order',[CartController::class,'addToCart'])->name('addToCartDiamond');
     Route::get('/diamond/order/list',[OrderController::class,'show'])->name('orderListDiamond');
     Route::post('/diamond/update-cart',[CartController::class,'updateCart'])->name('updateShoppingCartDiamond');
     Route::post('/diamond/remove/cart/product', [CartController::class, 'removeCartProduct'])->name('removeCartProductDiamond');
     Route::post('/diamond/checkout', [CartController::class, 'checkout'])->name('checkoutDiamond');
     Route::post('/diamond/add/order',[OrderController::class,'store'])->name('addOrderDiamond');
    
    //order list view
    Route::get('/order/list',[OrderController::class,'show'])->name('orderList');
    Route::post('/orderStatus',[OrderController::class,'statusUpdate'])->name('orderStatus');
    Route::post('/delete/order',[OrderController::class,'destroy'])->name('deleteOrder');




// order list diamond
    Route::get('/diamond/order/list',[OrderController::class,'show'])->name('orderListDiamond');
    Route::post('/diamond/orderStatus',[OrderController::class,'statusUpdate'])->name('orderStatusDiamond');
    Route::post('/diamond/delete/order',[OrderController::class,'destroy'])->name('deleteOrderDiamond');
   
    /* orders CRUD end */

    /*customer CRUD */
    Route::post('/add/customer',[CustomerController::class,'store'])->name('addCustomer');

    /*customer CRUD */


    /* generate report */
    Route::get('/sale/report',[ReportController::class,'sale'])->name('saleReport');
    Route::get('/puchase/report',[ReportController::class,'purchase'])->name('purchaseReport');
    Route::get('/inventory/report',[ReportController::class,'inventory'])->name('inventoryReport');
    Route::get('/range/report',[ReportController::class,'range'])->name('rangeReport');
    Route::post('/range/report/output',[ReportController::class,'rangeOutput'])->name('rangeSearchOutput');
    Route::get('/expense',[ExpenseController::class,'index'])->name('addExpensePage');
    Route::post('/add/expense',[ExpenseController::class,'store'])->name('addExpense');
    Route::get('/expense/list',[ExpenseController::class,'show'])->name('expenseList');
    Route::post('/update/expense',[ExpenseController::class,'update'])->name('updateExpense');
    Route::post('/delete/expense',[ExpenseController::class,'destroy'])->name('deleteExpense');



    /* generate report diamond */
    Route::get('/diamond/sale/report',[ReportController::class,'sale'])->name('saleReportDiamond');
    Route::get('/diamond/puchase/report',[ReportController::class,'purchase'])->name('purchaseReportDiamond');
    Route::get('/diamond/inventory/report',[ReportController::class,'inventory'])->name('inventoryReportDiamond');
    Route::get('/diamond/range/report',[ReportController::class,'range'])->name('rangeReportDiamond');
    Route::post('/diamond/range/report/output',[ReportController::class,'rangeOutput'])->name('rangeSearchOutputDiamond');
    Route::get('/diamond/expense',[ExpenseController::class,'index'])->name('addExpensePageDiamond');
    Route::post('/diamond/add/expense',[ExpenseController::class,'store'])->name('addExpenseDiamond');
    Route::get('/diamond/expense/list',[ExpenseController::class,'show'])->name('expenseListDiamond');
    Route::post('/diamond/update/expense',[ExpenseController::class,'update'])->name('updateExpenseDiamond');
    Route::post('/diamond/delete/expense',[ExpenseController::class,'destroy'])->name('deleteExpenseDiamond');





    /* generate report end*/

    /*generate barcode */

Route::get('/barcode',[PurchaseController::class,'barcode'])->name('barcode');
Route::post('/barcode/generate',[PurchaseController::class,'generateBarcode'])->name('generateBarcode');
    /*end generate barcode */

    /*Employee */
    Route::get('/employee',[EmployeeController::class,'index'])->name('addEmployeePage');
    Route::post('/add/employee',[EmployeeController::class,'create'])->name('addEmployee');
    Route::get('/role',[EmployeeController::class,'role'])->name('addRolePage');
    Route::post('/add/role',[EmployeeController::class,'store'])->name('addRole');
    /*end employee */


    /*Employee */
    Route::get('/diamond/employee',[EmployeeController::class,'index'])->name('addEmployeePageDiamond');
    Route::post('/diamond/add/employee',[EmployeeController::class,'create'])->name('addEmployeeDiamond');
    Route::get('/diamond/role',[EmployeeController::class,'role'])->name('addRolePageDiamond');
    Route::post('/diamond/add/role',[EmployeeController::class,'store'])->name('addRoleDiamond');
   

    /*end employee */

});

require __DIR__.'/auth.php';
