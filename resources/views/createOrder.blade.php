@php
use Illuminate\Support\Facades\Request;
@endphp


<x-admin-layout>
    <div class="main-wrapper">
        <div class="page-wrapper pagehead">
            <div class="content">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Blank Page</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ul>
                        </div>
                    </div>
                </div>
                @php
                $currentUrl = Request::url();
                @endphp

                <div class="row">
                    <div class="col-sm-12">
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-6 col-sm-12 tabs_wrapper">
                                    <div class="row ">
                                        @foreach($allProduct as $item)
                                        <?php
                                        $productDetail = App\Models\Product::find($item->product_id);
                                        ?>
                                        <div class="col-lg-4 col-sm-6 d-flex ">
                                            <div class="productset flex-fill active">
                                                <div class="productsetimg">
                                                    <img src="{{url('photos/'.$productDetail->thumbnail)}}" alt="img" style="height:150px;width:200px;">
                                                    <h6>Qty: {{$item->available_qty}}</h6>
                                                    <div class="check-product">
                                                        <!-- Button to open the modal -->
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#example-{{$item->barcode}}">
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="productsetcontent">

                                                    <h4>Name: {{$productDetail->name}}</h4>
                                                    <h6>Token number:{{$productDetail->sku}}</h6>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="example-{{$item->barcode}}" tabindex="-1" aria-labelledby="example-{{$item->barcode}}-label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal header -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="example-{{$item->barcode}}-label">Add product Price </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">close</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    @if(strpos($currentUrl, 'diamond') !== false)
                                                    <form action="{{route('addToCartDiamond')}}" method="POST">
                                                        @elseif(strpos($currentUrl, 'diamond') == false)
                                                        <form action="{{route('addToCart')}}" method="POST">
                                                            @endif
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="hidden" name="product_barcode" id="product_barcode" value="{{$item->barcode}}">
                                                                <input type="text" name="price" id="price" value="{{$item->selling_price}}">
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>





                                </div>


                                <div class="col-lg-6 col-sm-12 customer_div">
                                    <div class="row cart-detail-row">
                                        @if(Session::get('cart'))
                                        <div class="card-body pt-0 ">
                                            <div class="totalitem">
                                                <h4>Total items : {{count(Session::get('cart'))}} </h4>
                                                <a href="javascript:void(0);">Clear all</a>
                                            </div>
                                            <div class="product-table">

                                                @foreach( Session::get('cart') as $product)
                                                <?php
                                                $purchaseRow = App\Models\Purchase::where('barcode', $product->barcode)->get();
                                                $productId = $purchaseRow[0]->product_id;
                                                $productInfo =  App\Models\Product::where('id', $productId)->get();
                                                ?>

                                                <ul class="product-lists">
                                                    <li>
                                                        <div class="productimg">
                                                            <div class="productimgs">
                                                                <img src="{{url('photos/' . $productInfo[0]->thumbnail)}}" alt="img">
                                                            </div>
                                                            <div class="productcontet">
                                                                <h4>{{$productInfo[0]->name}}
                                                                    <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><img src="assets/img/icons/edit-5.svg" alt="img"></a>
                                                                </h4>
                                                                <div class="productlinkset">
                                                                    <h5>{{$productInfo[0]->sku}}</h5>
                                                                </div>
                                                                <div class="increment-decrement">
                                                                    <div class="input-groups pro-quantity">
                                                                        <form action="#" class="display-flex">
                                                                            <input type="hidden" value="{{$product->barcode}}" id="barcode" name="barcode">
                                                                            <input type="button" value="-" class="button-minus dec button button-qty">
                                                                            <input type="text" id="qty" name="child" value="{{$product->qty}}" class="quantity-field">

                                                                            <input type="button" value="+" class="button-plus inc button button-qty">

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>{{$product->price}} </li>
                                                    <li>
                                                        @if(strpos($currentUrl, 'diamond') !== false)
                                                        <form action="{{route('removeCartProductDiamond')}}" method="POST" enctype="multipart/form-data">
                                                            @elseif(strpos($currentUrl, 'diamond') == false)
                                                            <form action="{{route('removeCartProduct')}}" method="POST" enctype="multipart/form-data">
                                                                @endif
                                                                @csrf
                                                                <input type="hidden" name="barcode" value="{{$product->barcode}}">
                                                                <button type="submit" class="remove"><img src="{{asset('assets/img/icons/delete-2.svg')}}" alt="img"></button>
                                                            </form>
                                                    </li>
                                                </ul>

                                                @endforeach


                                            </div>
                                        </div>
                                        @endif


                                    </div>

                                    <div class="setvalue">
                                        <ul>

                                            <li>
                                                <h5>Subtotal </h5>
                                                <h6 id="subtotal">{{$subTotal}}</h6>
                                            </li>


                                        </ul>
                                    </div>

                                    @if(strpos($currentUrl, 'diamond') !== false)
                                    <form method="POST" action="{{route('checkoutDiamond')}}" class="d-flex" enctype="multipart/form-data">
                                        @elseif(strpos($currentUrl, 'diamond') == false)
                                        <form method="POST" action="{{route('checkout')}}" class="d-flex" enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="card card-order ">

                                                <div class="split-card p-3">
                                                    <div class="form-group">
                                                        <label for="">Customer Name</label>
                                                        <input class="form-control" type="text" id="customer_name" name="customer_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Customer Mobile</label>
                                                        <input class="form-control" type="text" name="customer_phone" id="customer_phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Customer Address</label>
                                                        <input class="form-control" type="text" id="customer_address" name="customer_address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Memo Number</label>
                                                        <input class="form-control" type="text" id="chalan_no" name="chalan_no">
                                                    </div>

                                                </div>



                                                <div class="card-body pt-0 pb-2">

                                                    <div class="btn-totallabel">
                                                        <button type="submit">Checkout</button>
                                                    </div>

                                                </div>


                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>







    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>



    <script type="text/Javascript">

        $(".button-qty").click(function(e){
        e.preventDefault();

var $button = $(this);
var oldQuantity = $button.parent().find("input#qty").val();
var productBarcode = $button.parent().find("input#barcode").val();

console.log(oldQuantity,productBarcode);
var newQuantity;
$button.blur();
if ($button.hasClass("inc")) {
    newQuantity = parseFloat(oldQuantity) + 1;
} 
else {
if (oldQuantity > 1) {
    newQuantity = parseFloat(oldQuantity) - 1;
} else {
    newQuantity = 1;
}
}

var currentUrl = <?php echo json_encode($currentUrl); ?>;
console.log(currentUrl);
var url = currentUrl.includes("diamond") ? "{{ route('updateShoppingCartDiamond') }}" : "{{ route('updateShoppingCart') }}" ;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    type:'POST',
    url: url,
    data:{barcode:productBarcode, newQuantity:newQuantity},
    success:function(data){
        var productPrice = $button.parents(".pro-quantity").prev().text();
        $button.parent().find("input#qty").val(newQuantity);
        $button.parents(".pro-quantity").next().text(newQuantity * productPrice);

        var cart = JSON.parse(data.cart);
       
        var subTotal = cart.reduce(function(accumulator,currentItem){
        return accumulator + (currentItem.qty * currentItem.price);
        },0);
     
        // //console.log(grandTotal);
        $button.parents(".cart-detail-row").next().find("#subtotal").text(subTotal);
        
        //$button.parents(".cart-detail-row").next().find("td.grand-total").text(grandTotal);
        
    }
});


});
</script>

</x-admin-layout>