<x-admin-layout>


    <form enctype="multipart/form-data" method="POST" action="{{ route('addExpense') }}">
        @csrf
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Expense Add</h4>
                        <h6>Add/Update Expense</h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                          
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Expense Date </label>
                                    <div class="input-groupicon ">
                                        <input type="date" placeholder="DD-MM-YYYY" id="expenseDate" name="expenseDate">
                                        <!--<div class="addonset">-->
                                        <!--    <img src="assets/img/icons/calendars.svg" alt="img">-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Total Amount</label>
                                    <input type="text" id="amount" name="amount">
                                </div>
                            </div>
                            

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                <label>Description</label>
                                    <textarea id="description" name="description"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2" type="submit">Submit</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        





    </form>














    <!-------modal cdn -------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-------modal cdn end-------------->
    <!-------toaster cdn -------------->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"> </script>

    <script>
         function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(input).parents(".thumbnail-section").siblings().find('.preview-image').attr('src', e.target.result);;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        $(document).ready(function() {

           

            $('#add-more-button').click(function() {

                var productInformation = $('#product-information-container .product-information:first').clone();
                console.log(productInformation);
                $(productInformation).find('input').val('');
                $(productInformation).find('.preview-image').attr('src', '');
                $('#product-information-container').append(productInformation);
            });
        });
    </script>



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