<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class GlobalViewController extends Controller
{
    public function index()
    {
	    /*
	     * TODO: ver possibilidade de eliminar slices para ter um numero maximo de slices e nao por percentagem...
	     */

	    $chartOptions = [
		    'legend' => [
			    'position' => 'none'
		    ],
		    'sliceVisibilityThreshold' => 0.05,
		    'backgroundColor' => [
			    'fill' => 'transparent'
		    ],
	    ];

	    //handles the expenses chart
	    $expenseChart = \Lava::DataTable();

	    $expenseChart->addStringColumn('Categoria')
		    ->addNumberColumn('Despesa');

	    $expenses = Transaction::expenses()->with('category')->get()->groupBy('category.compound_name');

	    foreach($expenses as $category => $expense) {
		    $balances[] = [
			    $category,
			    $expense->sum('amount')
		    ];
	    }

	    $expenseChart->addRows($balances);

	    \Lava::DonutChart('expense', $expenseChart, $chartOptions);


	    //handles the revenues chart
	    $revenueChart = \Lava::DataTable();

	    $revenueChart->addStringColumn('Categoria')
		    ->addNumberColumn('Receita');

	    $revenues = Transaction::revenues()->with('category')->get()->groupBy('category.compound_name');

	    unset($balances);
	    foreach($revenues as $category => $revenue) {
		    $balances[] = [
			    $category,
			    $revenue->sum('amount')
		    ];
	    }

//	    dd($balances);

	    $revenueChart->addRows($balances);

	    \Lava::DonutChart('revenue', $revenueChart, $chartOptions);



		$today = Carbon::now();
	    $dates = [
		    $today->startOfMonth()->toDateString(),
		    $today->endOfMonth()->toDateString(),
	    ];

	    $current_month_financial = Transaction::selectRaw('is_expense, sum(amount) as sum')
		    ->whereBetween('transaction_date', $dates)
		    ->groupBy('is_expense')
		    ->lists('sum','is_expense');

	    //redefines today to accommodate the subtraction of one month
	    $today = Carbon::now()->startOfMonth()->subMonth();
	    $dates = [
		    $today->startOfMonth()->toDateString(),
		    $today->endOfMonth()->toDateString(),
	    ];

	    $previous_month_financial = Transaction::selectRaw('is_expense, sum(amount) as sum')
		    ->whereBetween('transaction_date', $dates)
		    ->groupBy('is_expense')
		    ->lists('sum','is_expense');

	    //makes sure there is always a value
	    if (!isset($previous_month_financial[0]))
		    $previous_month_financial[0] = 0;
	    if (!isset($previous_month_financial[1]))
		    $previous_month_financial[1] = 0;

	    if (!isset($current_month_financial[0]))
		    $current_month_financial[0] = 0;
	    if (!isset($current_month_financial[1]))
		    $current_month_financial[1] = 0;

	    $arrow[0] = $this->financial_position_arrow($previous_month_financial[0] > $current_month_financial[0]);
	    $arrow[1] = $this->financial_position_arrow($previous_month_financial[1] < $current_month_financial[1]);

	    return view('global', compact('arrow', 'current_month_financial', 'previous_month_financial'));
    }

	/**
	 * Returns the arrow class
	 * logical if true returns negative arrow
	 * @param $logical
	 * @return string
	 */
	private function financial_position_arrow($logical)
	{
		return $logical ? 'fa fa-caret-down red-text fa-fw' : 'fa fa-caret-up green-text fa-fw';
	}
}
