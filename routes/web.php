<?php

use Illuminate\Support\Facades\Route;




Route ::get('/' , function () {
    echo "Ini Halaman Utama";
});

Route ::get('/products' , function () {
    echo "Ini Halaman Produk";
});

Route ::get('/cart' , function () {
    echo "Ini Halaman Keranjang";
});

Route ::get('/checkout' , function () {
    echo "Ini Halaman Checkout";
});