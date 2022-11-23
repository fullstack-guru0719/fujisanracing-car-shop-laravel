<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Webkul\Product\Repositories\ProductRepository;

// Home
 Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
     $trail->push('Home', route('shop.home.index'));
 });

 Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
     $trail->parent('home');
     $trail->push('Login', route('customer.session.index'));
 });

 Breadcrumbs::for('signup', function (BreadcrumbTrail $trail) {
     $trail->parent('home');
     $trail->push('Signup', route('customer.session.create'));
 });

 Breadcrumbs::for('cart', function (BreadcrumbTrail $trail) {
     $trail->parent('home');
     $trail->push('Cart', route('shop.checkout.cart.index'));
 });


// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('home');

    $categories = [ $category ];

    while ($categories[0]->parent && $categories[0]->parent_id != 1) {
        array_unshift($categories, $categories[0]->parent);
    }

    foreach ($categories as $category) {
        $trail->push($category->name, url($category->translations[0]->url_path));
    }
});

Breadcrumbs::for('product', function (BreadcrumbTrail $trail, $product) {
    $repo = app(ProductRepository::class);
    
    $productInfo = $repo->find($product->id);

    $trail->parent('category', $productInfo->categories[0]);

    $trail->push($product->name, route('shop.productOrCategory.index', $product->url_key));
});