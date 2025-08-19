<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdjustmentHistory;

class AdjustmentHistoryController extends Controller
{
    public function index()
    {
        $data = [
            'tile' => 'Adjustment History',
            'adjustmentHistories' => AdjustmentHistory::with(['product', 'user'])->get(),
        ];
        return view('admin.inventory.history', $data);
    }
}
