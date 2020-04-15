<?php declare(strict_types = 1);

namespace App\Domain\Products\Listeners;

use App\Domain\Products\Events\ProductCreated;
use App\Domain\Products\Models\ProductUnit;
use App\Domain\Products\Repositories\ProductUnitRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateProductUnit implements ShouldQueue
{
    use InteractsWithQueue;

    private ProductUnitRepository $productUnits;

    public function __construct(ProductUnitRepository $productUnits)
    {
        $this->productUnits = $productUnits;
    }

    public function handle(ProductCreated $event): void
    {
        $data = $event->data();

        $productUnit = ProductUnit::new(array_merge($data, [
            'id' => $data['product_unit_id'],
        ]));

        $this->productUnits->save($productUnit);
    }
}
