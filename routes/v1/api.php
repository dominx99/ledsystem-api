<?php

use App\Actions\Categories\FetchCategoriesAction;
use App\Actions\Products\FetchProductsByCategory;
use Illuminate\Support\Facades\Route;
use App\Actions\Categories\FetchCategoriesByParentSlugAction;
use App\Actions\Products\CreateProductAction;

Route::get('/categories', FetchCategoriesAction::class);
Route::get('/categories/by-parent-slug', FetchCategoriesByParentSlugAction::class);
Route::get('/categories/{categorySlug}/products', FetchProductsByCategory::class);

Route::post('/products', CreateProductAction::class);
