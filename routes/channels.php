<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.Customer.{id}', function (Customer $customer, $id) {
    return (int) $customer->id === (int) $id;
}, ['guards' => ['customer']]);
