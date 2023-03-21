<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('createExpense');
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
        Expense::create([
            'date' => $request->expenseDate,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('addExpensePageDiamond');

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('addExpensePage');

        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        $expenses = Expense::all();
        return view('expenseList', compact('expenses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $expense = Expense::find($request->expenseId);
        $expense->date = $request->expenseDate;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->save();

        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('expenseListDiamond');

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('expenseList');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Expense $expense)
    {
        $expense = Expense::find($request->expense_id);
        $expense->delete();
        
        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('expenseListDiamond');

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('expenseList');

        }    
    }
}
