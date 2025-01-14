<?php

function siteSetting(){
    $site = App\Models\SiteSetting::first();
    return $site ?? 'Site Title';
}
function shippingCharge(){
    return App\Models\ShippingCharge::query();
}
function shippingChargeInside(){
    return shippingCharge()->first();
}
function shippingChargeOutside(){
    return shippingCharge()->latest()->first();
}

