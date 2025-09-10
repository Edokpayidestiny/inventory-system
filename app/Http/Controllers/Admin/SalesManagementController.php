<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SalesManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'tile' => 'Sale Management',
            'products' => Product::with('category')->get(),
            'categories' => Category::all(),
        ];

        return view('admin.sales.index', $data);
    }


    public function history()
    {
        $data = [
            'tile' => 'Sales History',
            'sales' => Sale::with(['user', 'saleItems'])->get(),
        ];

        return view('admin.sales.sales-history', $data);
    }

    public function printAll()
    {
        $data = [
            'tile' => 'Print Sales',
            'sales' => Sale::with(['user', 'saleItems'])->get(),
        ];

        return view('admin.sales.print', $data);
    }
    public function print(Sale $sale)
    {
        $data = [
            'tile' => 'Print Sales',
            'sale' => $sale->load(['user', 'saleItems']),
        ];

        return view('admin.sales.printUniquely', $data);
    }

    public function show(Sale $sale)
    {
        $data = [
            'tile' => 'Sale Details',
            'sale' => $sale->load(['user', 'saleItems']),
        ];

        return view('admin.sales.show', $data);
    }

    public function pdf(Sale $sale)
    {
        $data = [
            'tile' => 'Sale PDF',
            'sale' => $sale->load(['user', 'saleItems']),
        ];

        // Logic to generate PDF can be added here
        $pdf = Pdf::loadView('admin.sales.pdf', $data);
        return $pdf->download('sale_' . $sale->id . '.pdf');
    }


    public function filter(Request $request)
    {
        // Validate the input dates
        $validator = Validator::make($request->all(), [
            'date_from' => 'required|date_format:Y-m-d',
            'date_to' => 'required|date_format:Y-m-d|after_or_equal:date_from',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $query = Sale::with(['user', 'saleItems']);

        if ($request->has('date_from') && $request->has('date_to')) {
            try {
                // Parse dates using Carbon in YYYY-MM-DD format
                $dateFrom = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->startOfDay();
                $dateTo = Carbon::createFromFormat('Y-m-d', $request->input('date_to'))->endOfDay();

                $query->whereBetween('created_at', [$dateFrom, $dateTo]);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['date_error' => 'Invalid date format. Please use YYYY-MM-DD.'])->withInput();
            }
        }

        $sales = $query->get();

        return view('admin.sales.sales-history', [
            'title' => 'Filtered Sales History',
            'sales' => $sales,
        ]);
    }

    public function summary()
    {
        $data = [
            'tile' => 'Sales Summary',
            'sales' => Sale::with(['user', 'saleItems'])->get(),
        ];

        return view('admin.sales.sales-summary', $data);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
