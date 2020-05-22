<?php
    /*require_once('core/DatabaseConfiguration.php');
    require_once('core/DatabaseConnection.php');
    require_once('models/UserModel.php');*/
    
    require_once 'Configuration.php';
    require_once 'vendor/autoload.php';

    use App\Controllers\MainController;
    use App\Core\DatabaseConfiguration;
    use App\Core\DatabaseConnection;
    use App\Models\UserModel;
    use App\Models\EventModel;
    use App\Core\Router;

    $databaseConfiguration = new DatabaseConfiguration(
        Configuration::DATABASE_HOST,
        Configuration::DATABASE_USER,
        Configuration::DATABASE_PASS,
        Configuration::DATABASE_NAME        
    );

    $databaseConnection = new DatabaseConnection($databaseConfiguration);

    $url = strval(filter_input(INPUT_GET, 'URL'));
    $httpMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    
    $router = new Router();
    $routes = require_once 'Routes.php';
    foreach ($routes as $route) {
        $router->add($route);
    }

    $route = $router->find($httpMethod, $url);
    $arguments = $route->extractArgument($url);

    $fullControllerName = '\\App\\Controllers\\' . $route->getControllerName() . 'Controller';
    $controller = new $fullControllerName($databaseConnection);

    $fingerprintProviderFactoryClass  = Configuration::FINGERPRINT_PROVIDER_FACTORY;
	$fingerprintProviderFactoryMethod = Configuration::FINGERPRINT_PROVIDER_METHOD;
	$fingerprintProviderFactoryArgs   = Configuration::FINGERPRINT_PROVIDER_ARGS;
	$fingerprintProviderFactory = new $fingerprintProviderFactoryClass;
	$fingerprintProvider = $fingerprintProviderFactory->$fingerprintProviderFactoryMethod(...$fingerprintProviderFactoryArgs);

    $sessionStorageClassName = Configuration::SESSION_STORAGE;
    $sessionStorageConstructorArguments = Configuration::SESSION_STORAGE_DATA;
    $sessionStorage = new $sessionStorageClassName(...$sessionStorageConstructorArguments);

    $session = new \App\Core\Session\Session($sessionStorage, Configuration::SESSION_LIFETIME);
    $session->setFingerprintProvider($fingerprintProvider);

    $controller->setSession($session);
    $controller->getSession()->reload();
    $controller->__pre();
    call_user_func_array([$controller, $route->getMethodName()], $arguments);
    $controller->getSession()->save();
    
    $data = $controller->getData();
    
    #foreach($data as $name => $value) {
    #    $$name = $value;
    #}
    #require_once 'views/Main/home.php';
    #require_once 'views/' . $route->getControllerName() . '/' . $route->getMethodName() . '.php';

    $loader = new \Twig\Loader\FilesystemLoader('./views');
    $twig = new \Twig\Environment($loader, [
        'cache' => './twig-cache',
        'auto_reload' => true
    ]);

    #$data['BASE'] = Configuration::BASE;

    echo $twig->render($route->getControllerName() . '/' . $route->getMethodName() . '.html', $data);



    