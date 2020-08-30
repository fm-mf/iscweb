<?php

namespace App\Http\Middleware;

use App\Helpers\Locale as LocaleHelper;
use App\Models\Receipt;
use Closure;
use Illuminate\Http\Request;
use JavaScript;
use Settings;

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
            $receipt = Receipt::find((int)$receiptId);

            if ($receipt) {
                view()->share('session_receipt', view('partak.receipt')->with([
                    'receipt' => $receipt,
                    'esn_card' => $receiptType === 'esn_card'
                ]));
            }
        }

        JavaScript::put('receipt_printer_url', Settings::get('receipt_printer_url'));

        return $next($request);
    }
}
