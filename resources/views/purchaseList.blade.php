@php
use Illuminate\Support\Facades\Request;
@endphp

<x-admin-layout>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>PURCHASE LIST</h4>
                    <h6>Manage your purchases</h6>
                </div>
                @php
                $currentUrl = Request::url();
                @endphp

                <div class="page-btn">
                    @if(strpos($currentUrl, 'diamond') !== false)
                    <a href="{{route('addPurchasePageDiamond')}}" class="btn btn-added">
                        <img src="{{asset('assets/img/icons/plus.svg')}}" alt="img">Add New Purchases
                    </a>
                    @elseif(strpos($currentUrl, 'diamond') == false)
                    <a href="{{route('addPurchasePage')}}" class="btn btn-added">
                        <img src="{{asset('assets/img/icons/plus.svg')}}" alt="img">Add New Purchases
                    </a>
                    @endif

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{asset('assets/img/icons/filter.svg')}}" alt="img">
                                    <span><img src="{{asset('assets/img/icons/closes.svg')}}" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{asset('assets/img/icons/search-white.svg')}}" alt="img"></a>
                            </div>
                        </div>

                    </div>



                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Product Name</th>
                                    <th>Token Number</th>
                                    <th>Supplier Name</th>
                                    <th>Purchase Date</th>

                                    <th>Buying Price</th>

                                    <th>Total qty</th>
                                    <th>Batch No</th>


                                    <th>Barcode</th>
                                    <!-- <th>Payment Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($purchases)
                                @foreach($purchases as $purchase)
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>

                                    <td class="text-bolds">
                                        <?php
                                        try {
                                            $product = App\Models\Product::findOrFail($purchase->product_id);
                                        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                                            $product = new stdClass();
                                            $product->name = null;
                                            $product->sku = null;
                                        }


                                        ?>
                                        {{$product->name}}
                                    </td>
                                    <td class="text-bolds">

                                        {{$product->sku}}
                                    </td>
                                    <td class="text-bolds">
                                        <?php
                                        try {
                                            $supplier = App\Models\Supplier::findOrFail($purchase->supplier_id);
                                        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                                            $supplier = new stdClass();
                                            $supplier->name = null;
                                        }

                                        ?>
                                        {{$supplier->name}}
                                    </td>
                                    <td>{{$purchase->purchase_date}}</td>

                                    <td>{{$purchase->buying_price}}</td>

                                    <td>{{$purchase->total_qty}}</td>
                                    <td>{{$purchase->batch_no}}</td>


                                    <td>{{$purchase->barcode}}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#update_purchase_'.$purchase->id}}">
                                            <img src="{{asset('assets/img/icons/edit.svg')}}" alt="img">
                                        </button>
                                        <div class="modal fade" id="{{'update_purchase_' . $purchase->id}}" tabindex="-1" role="dialog" aria-labelledby="update_product_lebel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="update_purchase_lebel">Update purchase</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if(strpos($currentUrl, 'diamond') !== false)
                                                        <form method="POST" action="{{route('updatePurchaseDiamond')}}" class="d-flex">
                                                            @elseif(strpos($currentUrl, 'diamond') == false)
                                                            <form method="POST" action="{{route('updatePurchase')}}" class="d-flex">
                                                                @endif 
                                                                @csrf
                                                                <div class="p-1">
                                                                    <select name="product" id="product">
                                                                        <?php
                                                                        try {
                                                                            $productDetail = App\Models\Product::findOrFail($purchase->product_id);
                                                                        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                                                                            $productDetail = new stdClass();
                                                                            $productDetail->name = null;
                                                                            $productDetail->sku = null;
                                                                        }


                                                                        ?>
                                                                        <option value="{{$purchase->product_id}}">{{$productDetail->name}}{{$productDetail->sku}}</option>
                                                                        @if($products)
                                                                        @foreach($products as $product)
                                                                        <option value="{{$product->id}}">{{$product->name}}{{$product->sku}}</option>
                                                                        @endforeach
                                                                        @endif

                                                                    </select>
                                                                    <select name="supplier" id="supplier">
                                                                        <?php
                                                                        try {
                                                                            $supplierDetail = App\Models\Supplier::findOrFail($purchase->supplier_id);
                                                                        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                                                                            $supplierDetail = new stdClass();
                                                                            $supplierDetail->name = null;
                                                                        }

                                                                        ?>
                                                                        <option value="{{$purchase->supplier_id}}">{{$supplierDetail->name}}</option>
                                                                        @if($suppliers)
                                                                        @foreach($suppliers as $supplier)
                                                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                                        @endforeach
                                                                        @endif

                                                                    </select>
                                                                    <input type="hidden" id="purchaseId" name="purchaseId" value="{{$purchase->id}}"></br></br>
                                                                    <input type="text" id="buyingPrice" name="buyingPrice" value="{{$purchase->buying_price}}"></br></br>

                                                                    <input type="date" id="purchaseDate" name="purchaseDate" value="{{$purchase->purchase_date}}"></br></br>

                                                                    <input type="text" id="batchNo" name="batchNo" value="{{$purchase->batch_no}}"></br></br>

                                                                    <input type="text" id="totalQty" name="totalQty" value="{{$purchase->total_qty}}"></br></br>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary btn-update-supplier">Save changes</button>
                                                                </div>

                                                            </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        @if(strpos($currentUrl, 'diamond') !== false)
                                        <form action="{{route('deletePurchaseDiamond')}}" method="post">
                                            @elseif(strpos($currentUrl, 'diamond') == false)
                                            <form action="{{route('deletePurchase')}}" method="post">
                                                @endif 
                                                @csrf
                                                <input type="hidden" value="{{$purchase->id}}" name="purchase_id">
                                                <button type="submit" class="btn btn-danger btn-delete-supplier">
                                                    <img src="{{asset('assets/img/icons/delete.svg')}}" alt="img">
                                                </button>
                                            </form>


                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>





    <!-------modal cdn -------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-------modal cdn end-------------->
    <!-------toaster cdn -------------->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"> </script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif
    </script>
    <!-------end toaster cdn -------------->



</x-admin-layout>