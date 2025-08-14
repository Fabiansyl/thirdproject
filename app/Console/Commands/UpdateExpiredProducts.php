<?php

namespace App\Console\Commands;

use App\Models\Product\Product;
use Illuminate\Console\Command;

class UpdateExpiredProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update is_expired column for products where exp_date has passed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Find products where exp_date is less than or equal to today's date
        $expiredProducts = Product::whereDate('exp_date', '<=', now())->get();

        foreach ($expiredProducts as $product) {
            $product->update(['is_expired' => true]);
            $this->info("Product '{$product->name}' (ID: {$product->id}) has been marked as expired.");
        }

        $this->info('Expired products have been updated.');
    }
}
