<?php

namespace Jeremytubbs\LaravelDeepzoom\Console\Commands;

use Illuminate\Console\Command;
use Jeremytubbs\LaravelDeepzoom\Commands\MakeTiles;

class MakeTilesCommand extends Command
{
    use \Illuminate\Foundation\Bus\DispatchesCommands;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deepzoom:tile
        {image? : Image that will be tiled.}
        {--filename=null : Optional filename for output.}
        {--folder=null : Optional folder name for output}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Image Tiles.';

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
     * @return mixed
     */
    public function handle()
    {
        $image = $this->argument('image') ? config('deepzoom.source_path') . '/' . $this->argument('image') : null;
        $filename = $this->option('filename');
        $folder = $this->option('folder');

        while (! $image) {
            $temp = $this->ask('Enter an image name?');
            $temp = config('deepzoom.source_path') . '/' . $temp;
            if (! \File::exists($temp)) {
                $this->error('Image not found!');
                $this->error($temp);
            } else {
                $image = $temp;
            }
        }
        $command = new MakeTiles($image);
        $this->dispatch($command);
    }
}
