<?php

namespace Jeremytubbs\LaravelDeepzoom\Listeners;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Jeremytubbs\Deepzoom\DeepzoomFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MakeTiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $image_path;
    protected $filename;
    protected $folder;
    protected $config;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(object $data)
    {
        $this->image_path = $data->image_path;
        $this->filename = $data->filename;
        $this->folder = $data->folder;
    }


    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $deepzoom = DeepzoomFactory::create([
            'path'   => config('deepzoom.destination_path'),
            'driver' => config('deepzoom.driver'),
            'format' => config('deepzoom.tile_format'),
        ]);
        $deepzoom->makeTiles($this->image_path, $this->filename, $this->folder);
    }
}
