<?php

namespace App\Domain\Products\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Domain\Products\Models\Product;
use App\Domain\Products\Repositories\ProductRepository;
use Illuminate\Contracts\Events\Dispatcher;

class CreateProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    /**
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return void
     */
    public function handle(ProductRepository $products, Dispatcher $events)
    {
        $product = Product::new($this->data);

        $products->save($product);
        $events->dispatchAll($product->events());
    }
}
