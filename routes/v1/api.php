<?php

use App\Actions\Categories\FetchCategoriesAction;
use App\Actions\Products\FetchProductsByCategory;
use Illuminate\Support\Facades\Route;
use App\Actions\Categories\FetchCategoriesByParentSlugAction;
use App\Actions\Products\CreateProductAction;
use App\Actions\Products\FindProductBySlugAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Products\FetchProductsAction;

Route::post('/auth/login', LoginAction::class);

Route::get('/categories', FetchCategoriesAction::class);
Route::get('/categories/parent', FetchCategoriesAction::class);
Route::get('/categories/by-parent-slug', FetchCategoriesByParentSlugAction::class);
Route::get('/categories/{categorySlug}/products', FetchProductsByCategory::class);

Route::get('/products', FetchProductsAction::class);
Route::post('/products', CreateProductAction::class);
Route::get('/products/by-slug', FindProductBySlugAction::class);
