<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Services\Interfaces\PurchaseServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\PurchaseItem;
use App\Services\Interfaces\PurchaseItemServiceInterface;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    protected $purchaseService;
    protected $purchaseItemService;

    public function __construct(PurchaseServiceInterface $purchaseService, PurchaseItemServiceInterface $purchaseItemService)
    {
        $this->purchaseService = $purchaseService;
        $this->purchaseItemService = $purchaseItemService;
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $user = Auth::user();
        $purchases = $this->purchaseService->getPurchasesByUserId($user->id);
        return PurchaseResource::collection($purchases);
    }


    public function store(Request $request)
    {
        $cartItems = $request->input('cart');

        if (!$cartItems || !is_array($cartItems)) {
            return response()->json(['message' => 'Invalid cart data'], 400);
        }

        $user = Auth::user();
        $totalAmount = 0;

        DB::beginTransaction();

        try {
            $purchase = $this->purchaseService->createPurchase([
                'user_id' => $user->id,
                'total_amount' => 0,
                'purchase_date' => now(),
            ]);

            foreach ($cartItems as $item) {
                $product = Product::findOrFail($item['product_id']);
                $quantity = (int)$item['quantity'];

                if ($quantity <= 0) {
                    throw new \Exception("Invalid quantity for product ID: " . $product->id);
                }

                $totalAmount += $product->price * $quantity;

                $this->purchaseItemService->createPurchaseItem([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
            }

            $purchase->total_amount = $totalAmount;
            $purchase->save();

            DB::commit();

            return new PurchaseResource($purchase);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Purchase failed: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $purchase = $this->purchaseService->getPurchaseById($id);

        if (!$purchase) {
            return response()->json(['message' => 'Purchase not found'], 404);
        }

        if (Auth::id() !== $purchase->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return new PurchaseResource($purchase);
    }
}
