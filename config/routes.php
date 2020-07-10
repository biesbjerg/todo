<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */
/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

const ID_PATTERN = '[0-9]+';
const SLUG_PATTERN = '[a-z0-9-]+';

$routes->redirect('/', ['controller' => 'SmartTodoLists', 'action' => 'view', 'smart_list_id' => 'my-day']);

$routes->scope('/', function (RouteBuilder $builder) {
    $builder
        ->connect(
            '/lists/{smart_list_id}',
            ['controller' => 'SmartTodoLists', 'action' => 'view'],
            ['_name' => 'view_smart_todo_list']
        )
        ->setPass(['smart_list_id'])
        ->setPatterns([
            'smart_list_id' => 'my-day|planned'
        ]);

    $builder->connect(
        '/lists/add',
        ['controller' => 'TodoLists', 'action' => 'add'],
        ['_name' => 'add_todo_list']
    );

    $builder->scope('/lists/{list_id}-{slug}', function (RouteBuilder $builder) {
        $builder
            ->connect('/', ['controller' => 'TodoLists', 'action' => 'view'], [
                '_name' => 'view_todo_list',
                'persist' => ['list_id', 'slug']
            ])
            ->setPass(['list_id', 'slug'])
            ->setPatterns([
                'list_id' => ID_PATTERN,
                'slug' => SLUG_PATTERN
            ]);

        $builder
            ->connect('/edit', ['controller' => 'TodoLists', 'action' => 'edit'], [
                '_name' => 'edit_todo_list',
                'persist' => ['list_id', 'slug']
            ])
            ->setPass(['list_id'])
            ->setPatterns([
                'list_id' => ID_PATTERN,
                'slug' => SLUG_PATTERN
            ]);

        // Items
        $builder
            ->connect('/items/add', ['controller' => 'TodoItems', 'action' => 'add'], [
                '_name' => 'add_todo_item',
                'persist' => ['list_id', 'slug']
            ])
            ->setPass(['list_id'])
            ->setPatterns([
                'list_id' => ID_PATTERN,
                'slug' => SLUG_PATTERN
            ]);

        $builder
            ->connect('/items/{item_id}/edit', ['controller' => 'TodoItems', 'action' => 'edit'], [
                '_name' => 'edit_todo_item',
                'persist' => ['list_id', 'slug']
            ])
            ->setPass(['list_id', 'item_id'])
            ->setPatterns([
                'list_id' => ID_PATTERN,
                'slug' => SLUG_PATTERN,
                'item_id' => ID_PATTERN
            ]);
    });

    /*
     * Connect catchall routes for all controllers.
     *
     * The `fallbacks` method is a shortcut for
     *
     * ```
     * $builder->connect('/:controller', ['action' => 'index']);
     * $builder->connect('/:controller/:action/*', []);
     * ```
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $builder->fallbacks();
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
