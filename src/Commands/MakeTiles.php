<?php

namespace Jeremytubbs\LaravelDeepzoom\Commands;

use App\Jobs\Job;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jeremytubbs\Deepzoom\DeepzoomFactory;

class HarvestImages extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue;

    protected $image;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($image)
    {
        $this->image = $image;
        $this->deepzoom = DeepzoomFactory::create([
            'path' => config('deepzoom.destination_path'),
            'driver' => config('deepzoom.driver'),
        ]);
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
    	$this->deepzoom->makeTiles($this->image);
    }
}