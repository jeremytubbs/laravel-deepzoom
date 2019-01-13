<?php

namespace Jeremytubbs\LaravelDeepzoom\Commands;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Jeremytubbs\Deepzoom\DeepzoomFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MakeTiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $image;
    protected $filename;
    protected $folder;
    protected $config;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($image, $filename = null, $folder = null, $config = null)
    {
        $this->image = $image;
        $this->filename = $filename;
        $this->folder = $folder;
        $this->setDeepzoom($config);
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

    public function setDeepzoom($config)
    {
        $this->deepzoom = DeepzoomFactory::create([
            'path'   => isset($config['destination_path']) ? $config['destination_path'] : config('deepzoom.destination_path'),
            'driver' => isset($config['driver']) ? $config['driver'] : config('deepzoom.driver'),
            'format' => isset($config['tile_format']) ? $config['tile_format'] : config('deepzoom.tile_format'),
        ]);
    }
}
