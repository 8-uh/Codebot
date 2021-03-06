<?php

// System configuration
@define('CODEBOT_DEBUG_MODE',                   true);
@define('CODEBOT_DEV_MODE',                   	false); // ***WARNING*** If this directive is true in production, your server/users might be at risk!
@define('CODEBOT_DEV_SIMULATE_SLOW',            false); // Set it to true to force frontend calls to wait before responding (simulation of slow connection)
@define('CODEBOT_DEV_SLOW_AMOUNT',            	2); // Time, in seconds, to wait before responding frontend calls. It's only effective if both CODEBOT_DEV_MODE and CODEBOT_DEV_SIMULATE_SLOW are true.
@define('CODEBOT_LOG_ENABLED',                  true);
@define('CODEBOT_LOG_FILE',                     '/home/user/logs/app.log');

// Database info
@define('CODEBOT_DB_DSN',                       'mysql:host=localhost;dbname=codebot');
@define('CODEBOT_DB_USER',                      'root');
@define('CODEBOT_DB_PASSWORD',                  '');

// Session info
@define('CODEBOT_SID',                          'codebotsid');

// OAuth stuff
@define('CODEBOT_OAUTH_PATH',                   '/plugins/ide-web/login/index.php/');
@define('CODEBOT_OAUTH_CALLBACK_PATH',          '/plugins/ide-web/login/oauth_return.php');
@define('CODEBOT_OAUTH_SECURITY_SALT',          'LDFmiilYf8Fyw5W10rx4W1KsVrieQCnpBzzpTBWA5vJidQKDx8pMJbmw28R1C4m');
@define('CODEBOT_GITHUB_APP_ID',                '');
@define('CODEBOT_GITHUB_APP_SECRET',            '');

// Project templates
@define('CODEBOT_PROJECT_TEMPLATES_FOLDER',		'/home/user/templates/');

// Disk
@define('CODEBOT_DISK_WORK_POOL',               '/tmp/');

// Flash
@define('CODEBOT_FLASH_API_ENPOINT',      		 'flash');
@define('CODEBOT_FLASH_API_CLASS_FILE',      	 '/plugins/flash-tools/backend/FlashTools.class.php');
@define('CODEBOT_FLASH_API_CLASS_NAME',      	 'FlashTools');
//@define('CODEBOT_FLASH_PROJECT_FACTORY',    	 '{"type": "flash", "name": "Flash/AS3", "templates": {"flash-empty": {"name": "Empty", "icon": "test.png"}}}');
@define('CODEBOT_FLASH_PUBLIC_TESTING_URL',      '/testing/');
@define('CODEBOT_FLASH_TESTING_POOL',            '/var/www/testing/');
@define('CODEBOT_FLASH_OUTPUT_REPIPE',           '2>&1');
@define('CODEBOT_FLASH_FLEX_SDK',                'C:/Users/Dovyski/AppData/Local/FlashDevelop/Apps/flexairsdk/4.6.0+15.0.0/bin/');

// Javascript
@define('CODEBOT_JAVASCRIPT_API_ENPOINT',      	 'javascript');
@define('CODEBOT_JAVASCRIPT_API_CLASS_FILE',     '/plugins/javascript-tools/backend/JavascriptTools.class.php');
@define('CODEBOT_JAVASCRIPT_API_CLASS_NAME',     'JavascriptTools');
@define('CODEBOT_JAVASCRIPT_PROJECT_FACTORY',    '{"type": "js", "name": "HTML5/Javascript", "icon": "plugins/javascript-tools/img/js-empty.png", "templates": {"js-empty": {"name": "Empty", "icon": "plugins/javascript-tools/img/js-empty.png"}}}');
@define('CODEBOT_JAVASCRIPT_PUBLIC_TESTING_URL', '/testing/');
@define('CODEBOT_JAVASCRIPT_TESTING_POOL',       '/var/www/html/testing/');

// Assets finder
@define('CODEBOT_ASSET_FINDER_API_ENPOINT',      'assets');
@define('CODEBOT_ASSET_FINDER_API_CLASS_FILE',   '/plugins/asset-finder/backend/AssetFinder.class.php');
@define('CODEBOT_ASSET_FINDER_API_CLASS_NAME',   'AssetFinder');
@define('CODEBOT_ASSET_FINDER_MIRROR_FOLDER',	 '/var/www/assets/');
@define('CODEBOT_ASSET_FINDER_MIRROR_URL',	 	 'http://cdn.domain.com/assets/');

?>
