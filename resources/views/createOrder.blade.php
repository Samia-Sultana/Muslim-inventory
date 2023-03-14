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





                <div class="row">
                    <div class="col-sm-12">
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-6 col-sm-12 tabs_wrapper">


                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <form id="productSearch" onClick={ productSearch }>
                                                    <label for="">Search Product</label>
                                                    <input class="form-control" type="search" name="productSearch" id="productSearch">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-sm-6 d-flex ">
                                            <div class="productset flex-fill active">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if(Session::get('cart'))
                                        <div class="card-body pt-0 cart-detail-row">
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
                                                        <form action="{{route('removeCartProduct')}}" method="POST" enctype="multipart/form-data">
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

                                        <div class="setvalue">
                                            <ul>

                                                <li>
                                                    <h5>Subtotal </h5>
                                                    <h6 id="subtotal">{{$subTotal}}</h6>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-lg-6 col-sm-12 customer_div">
                                    <div class="form-group">
                                        <form id="customerSearch" onClick={ customerSearch }>

                                            <label for="">Search Customer</label>
                                            <input class="form-control" type="search" name="customerSearch" id="customerSearch">
                                        </form>

                                    </div>

                                    <div>
                                        <div class="customerset flex-fill active">

                                        </div>

                                    </div>
                                    <form method="POST" action="{{route('checkout')}}" class="d-flex" enctype="multipart/form-data">
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
                                                <label for="">Chalan Number</label>
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
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product Price</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('addToCart')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group" id="productPriceInputSection">


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2" type="submit">Submit</button>
                            <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                        </div>
                    </form>
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
    <script>
        $("#productSearch").submit(function(event) {
            event.preventDefault();
            var $formSubmitEvent = $(this);
            var productTokenNumber = $formSubmitEvent.find("input#productSearch").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                type: 'POST',
                url: "{{ route('searchProduct') }}",
                data: {
                    productTokenNumber: productTokenNumber
                },
                success: function(data) {
                    var productInfo = data.product;
                    $('.productset').empty();
                    var productDiv = $('<div class="productsetimg"></div>');
                    productDiv.append('<img src="photos/' + productInfo.thumbnail + '">');
                    productDiv.append('<h6>' + 'QTY:' + productInfo.available_qty + '</h6>');


                    var priceAndButtonDiv = $('<div class="productsetcontent"></div>');
                    priceAndButtonDiv.append('<h4>' + productInfo.name + '</h4>');
                    priceAndButtonDiv.append('<a herf="javascript:void(0);" class="btn btn-adds" data-bs-toggle="modal" data-bs-target="#create"><i class="fa fa-plus me-2"></i> Add to Cart </a>');
                    productDiv.append(priceAndButtonDiv);

                    $('.productset').append(productDiv);

                    $('#productPriceInputSection').empty();
                    $('#productPriceInputSection').append('<input type="hidden" name="product_barcode" id="product_barcode" value="' + productInfo.barcode + '">');
                    $('#productPriceInputSection').append('<label>Enter Product Price</label>');
                    $('#productPriceInputSection').append('<input type="text" name="price" id="price">');




                }
            });

            // Your code to handle the form submission here
        });


        $("#customerSearch").submit(function(event) {
            event.preventDefault();
            var $formSubmitEvent = $(this);
            var customerNumber = $formSubmitEvent.find("input#customerSearch").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                type: 'POST',
                url: "{{ route('searchCustomer') }}",
                data: {
                    customerNumber: customerNumber
                },
                success: function(data) {
                    var customerInfo = data.customer;
                    $('.customerset').empty();
                    if (customerInfo.length > 0) {
                        $formSubmitEvent.parents('.customer_div').find('input#customer_name').val(customerInfo[0].name);
                        $formSubmitEvent.parents('.customer_div').find('input#customer_address').val(customerInfo[0].address);
                        $formSubmitEvent.parents('.customer_div').find('input#customer_phone').val(customerInfo[0].phone);
                    } else {
                        $formSubmitEvent.parents('.customer_div').find('input#customer_name').val(null);
                        $formSubmitEvent.parents('.customer_div').find('input#customer_address').val(null);
                        $formSubmitEvent.parents('.customer_div').find('input#customer_phone').val(null);
                        $('.customerset').append('<h2 style="color:red;">Not a Customer yet</h2>');
                    }

                }
            });

            // Your code to handle the form submission here
        });
    </script>


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


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    type:'POST',
    url:"{{ route('updateShoppingCart') }}",
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