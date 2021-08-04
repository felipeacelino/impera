<?
define( 'PATH_ATUAL', dirname( __FILE__ ) );
define( 'APP_PATH', realpath(PATH_ATUAL . '/app'));
define( 'UP_PATH', realpath(PATH_ATUAL . '/uploads'));
define( 'IMG_PATH', realpath(UP_PATH . '/img') );
define( 'ARQ_PATH', realpath(UP_PATH . '/outros') );
define( 'CLASS_PATH', realpath(PATH_ATUAL . '/lib'));
define( 'BASE_PATH', realpath(PATH_ATUAL . '/base'));
define( 'CONF_PATH', realpath(PATH_ATUAL . '/conf'));
define( 'ERROS_PATH', realpath(PATH_ATUAL . '/logs/erros'));
define( 'ACESSOS_PATH', realpath(PATH_ATUAL . '/logs/acessos'));
define( 'ACOES_ADMIN_PATH', realpath(PATH_ATUAL . '/acoes/admin'));
define( 'ACOES_APP_PATH', realpath(PATH_ATUAL . '/acoes/app'));
define( 'ADMIN_PATH', realpath(PATH_ATUAL . '/admin'));
define( 'RSS_PATH', realpath(PATH_ATUAL . '/rss'));
define( 'CACHE_PATH', realpath(APP_PATH . '/cache'));
define( 'MAIL_PATH', realpath(PATH_ATUAL . '/mail'));
define( 'VENDOR_PATH', realpath(PATH_ATUAL . '/vendors'));
define( 'STATIC_PATH', realpath(PATH_ATUAL . '/static'));
?>
