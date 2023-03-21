@php
use Illuminate\Support\Facades\Request;
@endphp

<x-admin-layout>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Expense LIST</h4>
                    <h6>Manage your Expenses</h6>
                </div>
                <div class="page-btn">
                    @php
                    $currentUrl = Request::url();
                    @endphp
                    @if(strpos($currentUrl, 'diamond') !== false)
                    <a href="{{route('addExpensePageDiamond')}}" class="btn btn-added">
                        <img src="{{asset('assets/img/icons/plus.svg')}}" alt="img">Add New Expense
                    </a>
                    @elseif(strpos($currentUrl, 'diamond') == false)
                    <a href="{{route('addExpensePage')}}" class="btn btn-added">
                        <img src="{{asset('assets/img/icons/plus.svg')}}" alt="img">Add New Expense
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
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Description</th>

                                    <!-- <th>Payment Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($expenses)
                                @foreach($expenses as $expense)
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>


                                    <td class="text-bolds">

                                        {{$expense->date}}
                                    </td>
                                    <td class="text-bolds">
                                        {{$expense->amount}}
                                    </td>
                                    <td>{{$expense->description}}</td>


                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#update_purchase_'.$expense->id}}">
                                            <img src="{{asset('assets/img/icons/edit.svg')}}" alt="img">
                                        </button>
                                        <div class="modal fade" id="{{'update_purchase_' . $expense->id}}" tabindex="-1" role="dialog" aria-labelledby="update_product_lebel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="update_purchase_lebel">Update Expense</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        @if(strpos($currentUrl, 'diamond') !== false)
                                                        <form method="POST" action="{{route('updateExpenseDiamond')}}" class="d-flex">
                                                            @elseif(strpos($currentUrl, 'diamond') == false)
                                                            <form method="POST" action="{{route('updateExpense')}}" class="d-flex">
                                                                @endif
                                                                @csrf
                                                                <div class="p-1">

                                                                    <input type="hidden" id="expenseId" name="expenseId" value="{{$expense->id}}"></br></br>

                                                                    <input type="date" id="expenseDate" name="expenseDate" value="{{$expense->date}}"></br></br>

                                                                    <input type="text" id="amount" name="amount" value="{{$expense->amount}}"></br></br>

                                                                    <textarea name="description" id="description" cols="25" rows="8">{{$expense->description}}</textarea>
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
                                        <form action="{{route('deleteExpenseDiamond')}}" method="post">
                                            @elseif(strpos($currentUrl, 'diamond') == false)
                                            <form action="{{route('deleteExpense')}}" method="post">
                                                @endif
                                                @csrf
                                                <input type="hidden" value="{{$expense->id}}" name="expense_id">
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