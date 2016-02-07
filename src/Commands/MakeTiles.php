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
    protected $config;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($image, $filename = null, $folder = null, $config = null)
    {
        $this->image = config('deepzoom.source_path') . '/' . $image;
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
            'path'   => isset($config['deepzoom_destination_path']) ? $config['deepzoom_destination_path'] : config('deepzoom.destination_path'),
            'driver' => isset($config['deepzoom_driver']) ? $config['deepzoom_driver'] : config('deepzoom.driver'),
            'format' => isset($config['deepzoom_tile_format']) ? $config['deepzoom_tile_format'] : config('deepzoom.tile_format'),
        ]);
    }
}