<?php

namespace Jeremytubbs\LaravelDeepzoom\Commands;

use App\Jobs\Job;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jeremytubbs\Deepzoom\DeepzoomFactory;

class MakeTiles extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue;

    protected $image;
    protected $filename;
    protected $folder;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($image, $filename = null, $folder = null)
    {
        $this->image = config('deepzoom.source_path') . '/' . $image;
        $this->filename = $filename;
        $this->folder = $folder;
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
    	$this->deepzoom->makeTiles($this->image, $this->filename, $this->folder);
    }
}