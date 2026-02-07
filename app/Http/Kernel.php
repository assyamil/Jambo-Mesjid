protected $middlewareGroups = [
    'web' => [
        // middleware lain
        \App\Http\Middleware\TrackVisitsMiddleware::class,
    ],
];
