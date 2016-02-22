# loggable


Loggable is a Laravel 5 package which helps users to keep simple log of their model CRUD operations. .

## Install

Via Composer

``` bash
$ composer require themightysapien/loggable
```
Add the service provider to the providers array in app.php
``` bash
Themighty\Loggable\LoggableServiceProvider

//THen do vendor:publish from the artisan command to copy the migration file migrate it
php artisan vendor:publish
php artisan migrate
```

## Usage

``` php
//use LoggableModelTrait in any of your models whose CRUD logs you want to keep
class DemoModel extends \Eloquent {
    use Themighty\Mediamanager\Traits\LoggableModelTrait
}
```
Then you need to define a **getLogData()** function as
``` php
public function getLogData()
    {
        return array(
            'routeName' => 'admin.inventories',
            'title' => 'name',
            'modelName' => 'Inventory Item',
            'user' => \Auth::id()
        );
    }
```
**routeName** : leave it empty if you dont want the log data to be a link, or you can keep name of the resource route.

**title** : this is the DB table column whose data will be shown in the log.

**modelname** : Readable model name for the log.

**user** : the id of the user who performed the actions in the model.

THen you can display the logs as follows

``` php
//for all logs loop through \Themightysapien\Loggable\Logs::all() or filter it however you like

//for model specific logs you can call $model->logs to get model specific logs

//then inside the loop you can access the user with ->user property

foreach($model->logs as $log){
    echo $log->getModelName().' || '.$log->getLogEntry().' ||'.$log->getAction();
    echo '<br>';
    echo 'By :'.$log->user->name.' at '.$log->created_at;
}
```
The above code will produce the result like

**Inventory Item** || **Milk** || **added**

By **themightysapien** at 2015-12-12 00:00:00



## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email themightysapien@gmail.com instead of using the issue tracker.

## Credits

- [themightysapien](https://github.com/themightysapien)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
