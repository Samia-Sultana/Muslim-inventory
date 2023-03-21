@php
use Illuminate\Support\Facades\Request;
@endphp

<x-admin-layout>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Add Supplier</h4>
                </div>
            </div>
            @php
            $currentUrl = Request::url();
            @endphp
            @if(strpos($currentUrl, 'diamond') !== false)
            <form enctype="multipart/form-data" method="POST" action="{{ route('addSupplierDiamond') }}" class="d-flex">
            @elseif(strpos($currentUrl, 'diamond') == false)
            <form enctype="multipart/form-data" method="POST" action="{{ route('addSupplier') }}" class="d-flex">
            @endif
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Supplier Name*</label>
                                    <input type="text" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Phone*</label>
                                    <input type="text" name="phone" id="phone" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label>Address*</label>
                                    <input type="text" name="address" id="address" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label>Company</label>
                                    <input type="text" name="company_name" id="company_name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>


   
    <!-------end toaster cdn -------------->

</x-admin-layout>