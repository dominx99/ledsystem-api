<?php declare(strict_types = 1);

namespace App\Domain\Products\Listeners;

use App\Domain\Products\Events\ProductCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttachProductToCategories implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ProductCreated $event): void
    {
        $data = $event->data();

        // TODO: Check if each category exists

        $params = array_map(fn ($category) => [
            'product_id'  => $data['id'],
            'category_id' => $category,
            'created_at'  => Carbon::now(),
        ], $data['categories']);

        DB::table('category_product')->insert($params);
    }
}
