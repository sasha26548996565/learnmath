<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index(): bool
    {
        $cart = \Cart::session(session()->get('cartId'));
        $materials = $cart->getContent();
        $totalPrice = $cart->getSubTotal();

        dump($cart, $materials, $totalPrice);
        return true;
    }

    public function add(Material $material, Request $request): RedirectResponse
    {
        if (is_null(session('cartId')))
            session(['cartId' => uniqid()]);

        \Cart::session(session()->get('cartId'))->add([
            'id' => $material->id,
            'name' => $material->name,
            'price' => 4,
            'quantity' => $request->quantity,
            'attributes' => [
                'slug' => $material->slug,
            ],
            'associatedModel' => $material,
        ]);
        return to_route('cart.index');
    }

    public function update(Material $material, Request $request): RedirectResponse
    {
        $quantity = $request->quantity;
        $cart = \Cart::session(session()->get('cartId'));
        $cart->update($material->id, ['quantity' => ['relative' => false, 'value' => $quantity]]);

        return to_route('cart.index');
    }

    public function remove(Material $material): RedirectResponse
    {
        $cart = \Cart::session(session()->get('cartId'));
        $cart->remove($material->id);
        return to_route('cart.index');
    }
}
