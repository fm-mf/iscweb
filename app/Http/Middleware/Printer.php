<?php

namespace App\Http\Middleware;

use App\Facades\Settings;
use App\Models\Receipt;
use Closure;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

/**
 * Adds printer-related stuff to views
 */
class Printer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $receiptId = session('receipt');
        $receiptType = session('receiptType', 'trip');

        if ($receiptId) {
            $receipt = Receipt::find((int) $receiptId);

            if ($receipt) {
                view()->composer(['partak.layout.main'], function (View $view) use ($receipt, $receiptType) {
                    $view->with([
                        'session_receipt' => view('partak.receipt')->with([
                            'receipt' => $receipt,
                            'esn_card' => $receiptType === 'esn_card'
                        ])
                    ]);
                });
            }
        }

        JavaScript::put('receiptPrinterUrl', Settings::get('receiptPrinterUrl'));

        return $next($request);
    }
}
