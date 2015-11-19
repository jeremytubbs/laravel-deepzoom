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
        $filename = $this->option('filename') == 'null' ? null : $this->option('filename');
        $folder = $this->option('folder') == 'null' ? null : $this->option('folder');
        $image_path = $this->argument('image') ? config('deepzoom.source_path') . '/' . $this->argument('image') : null;

        // check if path is valid
        if (\File::exists($image_path)) {
            $image = $this->argument('image');
        } else {
            $this->error('Image not found!');
            $this->error($image_path);
            $image_path = null;
        }

        // loop until path is valid
        while (! $image_path) {
            $temp_image = $this->ask('Enter an image name?');
            $temp_path = config('deepzoom.source_path') . '/' . $temp_image;
            if (! \File::exists($temp_path)) {
                $this->error('Image not found!');
                $this->error($temp_path);
            } else {
                $image = $temp_image;
                $image_path = $temp_path;
            }
        }

        $command = new MakeTiles($image, $filename, $folder);
        $this->dispatch($command);
    }
}
