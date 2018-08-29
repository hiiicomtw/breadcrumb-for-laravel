# breadcrumb-for-laravel
A simple breadcrumb for laravel.
## Installation
    composer require hiiicomtw/breadcrumb-for-laravel:dev-master
## Configuration

### config/app.php
providers:

```php
Hiiicomtw\Breadcrumb\BreadcrumbServiceProvider::class
```

aliases:

```php
'Breadcrumb' => Hiiicomtw\Breadcrumb\BreadcrumbFacade::class
```

### config/breadcrumb.php
You can change the **"default-template"** key by value **'breadcrumb::template'** 、 **'breadcrumb::sample'** or **'breadcrumb::backend'**

    php artisan vendor:publish

```php
return [
    'breadcrumb-file-path' => app_path('Http/breadcrumb.php'),
    'default-template' => 'breadcrumb::template',
    'ignore-undefined-breadcrumb' => false
];
```

### views/vendor/breadcrumb
You can edit the views where in **"resources/views/vendor"**

## Base Usage
1. Create the breadcrumb file in the **"breadcrumb-file-path"**.

2. Define breadcrumbs in the breadcrumb file.

    Without parameters:

    ```php
    // Home
    Breadcrumb::define('home', function ($breadcrumb) {
        $breadcrumb->add('Home', action('HomeController@index'));
    });
    ```
    With a parameter:

    ```php
    // Home > $category->title
    Breadcrumb::define('category', function ($breadcrumb, $category) {
        $breadcrumb->add('Home', action('HomeController@index'));
        $breadcrumb->add($category->title, $category->url);
    });
    ```
    With parameters:

    ```php
    // Home > $category['title'] > $content->title
    Breadcrumb::define('content', function ($breadcrumb, $category, $content) {
        $breadcrumb->add('Home', action('HomeController@index'));
        $breadcrumb->add($category['title'], $category['id']);
        $breadcrumb->add($content->title, $content->url);
    });
    ```

3. Render breadcrumbs.

    Without parameters:

    ```php
    {!! Breadcrumbs::render('home') !!}
    ```
    With a parameter:

    ```php
    {!! Breadcrumbs::render('home', $category) !!}
    ```
    With parameters:

    ```php
    {!! Breadcrumbs::render('home', $category, $content) !!}
    ```

## Advanced Usage

1. The breadcrumb use the special template.blade.php in resources/views.

    ```php
    {!! Breadcrumbs::setTemplate('path/to/view')->render('home') !!}
    ```