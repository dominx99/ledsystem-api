<?php declare(strict_types=1);

namespace App\Actions\Products;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Domain\Products\Jobs\SetProductMainImageJob;

final class SetProductMainImageAction
{
    public function __invoke(Request $request, string $productId): JsonResponse
    {
        $request->validate(['image_id' => 'required']);

        SetProductMainImageJob::dispatch(
            $productId,
            $request->input('image_id'),
        );

        return new JsonResponse(['status' => 'success']);
    }
}
