<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\QuotationPostRequest;
use App\Models\Quotation;

class QuotationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(QuotationPostRequest $request)
    {
        $quotation = new Quotation(
            $request['age'],
            $request['currency_id'],
            $request['start_date'],
            $request['end_date']
        );

        return response()->json([
            'total' => number_format($quotation->calculateTotal(), 2),
            'currency_id' => $quotation->currency,
            'quotation_id' => $quotation->getQuotationId(),
        ]);
    }
}
