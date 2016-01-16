Deepzoom
==
Laravel Tile Generator for use with OpenSeadragon: https://openseadragon.github.io

This package utilizes my deepzoom package: https://github.com/jeremytubbs/deepzoom

### Usage
Artisan command to queue image tiling:
```sh
php artisan deepzoom:tile
```

The artisan command accepts an image argument, as well as; filename and folder options. If no image argument is provided you will recieve a prompt to enter an image name. The image path is based off the `source_path' defined in the `deepzoom.php` config file.

```sh
php artisan deepzoom:tile KISS.jpg --filename=kiss --folder=keep-it-simple-stupid
```

The artisan command is queued and will use the `default` queue driver set in the `queue.php` config file.

If you would like to use the `makeTiles` command inside a controller add the trait and dispatch the command:

```php
use Jeremytubbs\LaravelDeepzoom\Commands\MakeTiles;

class MyController extends Controller
{
	use \Illuminate\Foundation\Bus\DispatchesCommands;

	public function makeTiles($image, $filename = null, $folder = null) {
		$command = new MakeTiles($image, $filename, $folder);
		$this->dispatch($command);
	}
}
```

### Setup
Add service provider to `app/config`:

```php
Jeremytubbs\LaravelDeepzoom\DeepzoomServiceProvider::class,
````

Publish the `deepzoom.php` config file:
```sh
php artisan vendor:publish
```
