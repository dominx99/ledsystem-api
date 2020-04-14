<?php

use App\Actions\Categories\FetchCategoriesAction;
use App\Actions\Products\FetchProductsByCategory;
use Illuminate\Support\Facades\Route;
use App\Actions\Categories\FetchCategoriesByParentSlugAction;

Route::get('/categories', FetchCategoriesAction::class);
Route::get('/categories/by-parent-slug', FetchCategoriesByParentSlugAction::class);
Route::get('/categories/{categorySlug}/products', FetchProductsByCategory::class);
