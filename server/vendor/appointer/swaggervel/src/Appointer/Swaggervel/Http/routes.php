<?php

Route::any(config('swaggervel.doc-route') . '/{page?}', [
    'as' => 'swaggervel.definitions',
    'uses' => 'SwaggervelController@definitions',
]);

Route::get(config('swaggervel.api-docs-route'), [
    'as' => 'swaggervel.ui',
    'uses' => 'SwaggervelController@ui',
]);
