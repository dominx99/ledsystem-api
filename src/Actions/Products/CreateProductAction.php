<?php declare(strict_types=1);

namespace App\Actions\Products;

use Illuminate\Contracts\Bus\Dispatcher;
use App\Domain\Products\Jobs\CreateProductJob;
use App\Domain\Products\Requests\CreateProductRequest;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;
use App\Domain\Products\Jobs\SaveProductImages;
use Illuminate\Support\Facades\DB;

final class CreateProductAction
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function __invoke(CreateProductRequest $request): JsonResponse
    {
        $productId = (string) Uuid::uuid4();

        try {
            DB::beginTransaction();

            SaveProductImages::dispatch($productId, $request->file("images"));

            $params = $request->validated();
            unset($params['images']);
            CreateProductJob::dispatch(array_merge($params, ['id' => $productId]));

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();

            throw $t;
        }

        return new JsonResponse(["status" => "success"]);
    }
}
