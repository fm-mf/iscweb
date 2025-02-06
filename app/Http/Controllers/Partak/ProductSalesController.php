<?php

namespace App\Http\Controllers\Partak;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partak\ProductSaleRequest;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProductSalesController extends Controller
{
    public function create(Request $request, Product $product)
    {
        $this->authorize('acl', 'productSales.add');

        $user = null;

        if ($request->query('id_user')) {
            $user = User::findOrFail($request->query('id_user'));
        }

        return view('partak.product-sales.create', ['product' => $product, 'user' => $user]);
    }

    public function store(ProductSaleRequest $request, Product $product)
    {
        $data = $request->validated();

        if (isset($data['id_user']) && isset($data['customer_name']) && isset($data['customer_email'])) {
            throw new BadRequestHttpException('user or customer details have to be defined');
        }

        if ($product->isSoldOut) {
            throw new BadRequestHttpException('Sold out product cannot be sold');
        }

        $receipt = Receipt::create([
            'subject' => $product->name,
            'amount' => $data['paid'],
            'created_by' => Auth::id(),
            'payment_method' => $data['payment_method'],
        ]);

        $sale = new ProductSale($data);
        $sale->id_receipt = $receipt->id_receipt;
        $sale->id_product = $product->id_product;
        $sale->save();

        return redirect()->route('partak.products.show', $product)->with([
            'receipt' => $receipt->id_receipt,
            'receiptType' => 'product'
        ]);
    }
}
