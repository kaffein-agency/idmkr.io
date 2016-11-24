<?phperror_reporting(E_ALL);ini_set("display_errors", 1);/************************************* DEFINE AND IMPORT ******************************************************/define('APP_DIR',dirname(__FILE__));require APP_DIR.'/vendor/autoload.php';/************************************* MOBILE  ******************************************************/$detect = new Mobile_Detect();$isMobile = $detect->isMobile();/******************************************* VIEWS *******************************************************/$view = new \philipsharp\Slim\View\Plates();$view->templatesPath = $_SERVER["DOCUMENT_ROOT"]."/templates".($isMobile?'/mobile':'');$view->getInstance()->loadExtension(new League\Plates\Extension\Asset('./', true));/******************************************* INSTANTIATE *******************************************************/$app = new \Slim\Slim([    'mode' => 'development',    'view' => $view]);/*************************************** EXTRA SERVICES *******************************************************/// pre-application hook, performs stuff before real action happens @see http://docs.slimframework.com/#Hooks$app->hook('slim.before', function () use ($app) {});/******************************************* CONFIG *******************************************************/$app->configureMode('development', function () use ($app) {    //$app->add(new \Slim\Middleware\DebugBar());});$app->configureMode('production', function () use ($app) {});/************************************ THE ROUTES / CONTROLLERS *************************************************/require(APP_DIR."/routes.php");return $app;