<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'app:parse-command', description: 'Command description')]
class ParseCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::query()->get()->map(function (Product $product) {
            $product->discount = $product->price / 100 * 10;
            $product->image = rand(1, 2) . '.jpg';
            $product->save();
        });

        $this->info('Команда успешно отработала. ' . $products->count() . ' записей обновлено!');
    }
}
