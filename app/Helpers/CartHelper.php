<?php

use Darryldecode\Cart\Facades\CartFacade as Cart;

function cart()
{
    return Cart::getFacadeRoot();
}
