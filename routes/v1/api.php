<?php

use App\Actions\Categories\FetchCategoriesAction;
use App\Actions\Products\FetchProductsByCategory;
use Illuminate\Support\Facades\Route;
use App\Actions\Categories\FetchCategoriesByParentSlugAction;
use App\Actions\Products\CreateProductAction;
use App\Actions\Products\FindProductBySlugAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Products\AssignProductParametersAction;
use App\Actions\Products\FetchProductsAction;
use App\Actions\Categories\FetchCategoriesTreeAction;
use App\Actions\Categories\FetchParentCategoriesAction;
use App\Actions\Categories\FindCategoryByIdAction;
use App\Actions\Categories\UpdateCategoryParametersAction;
use App\Actions\Products\FindProductByIdAction;
use App\Actions\Parameters\FetchParametersByCategoryIds;
use App\Actions\Products\SetProductMainImageAction;
use App\Actions\Parameters\FetchAllParametersAction;
use App\Actions\Categories\UpdateCategoryAction;

Route::post('/auth/login', LoginAction::class);

Route::get('/categories', FetchCategoriesAction::class);
Route::get('/categories/recursive', FetchCategoriesTreeAction::class);
Route::get('/categories/parent', FetchParentCategoriesAction::class);
Route::get('/categories/by-parent-slug', FetchCategoriesByParentSlugAction::class);
Route::get('/categories/{categorySlug}/products', FetchProductsByCategory::class);
Route::post('/categories/{categoryId}/update-parameters', UpdateCategoryParametersAction::class);
Route::get('/categories/{categoryId}', FindCategoryByIdAction::class);
Route::put('/categories/{categoryId}', UpdateCategoryAction::class);

Route::get('/products', FetchProductsAction::class);
Route::post('/products', CreateProductAction::class);
Route::post('/products/{productId}/assign-parameters', AssignProductParametersAction::class);
Route::post('/products/{productId}/set-main-image', SetProductMainImageAction::class);
Route::get('/products/by-slug', FindProductBySlugAction::class);
Route::get('/products/{productId}', FindProductByIdAction::class);

Route::get('/parameters', FetchAllParametersAction::class);
Route::get('/parameters/by-category-ids', FetchParametersByCategoryIds::class);
