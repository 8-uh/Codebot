<?php
/**
 * Authenticates the user through Github oAuth API.
 *
 */

// Include all internal files
include_once dirname(__FILE__).'/inc/globals.php';

// Check if opAuth should be invoked.
$aHaveParams = strpos($_SERVER['REQUEST_URI'], 'index.php/') !== false;

if($aHaveParams) {
	// Instantiate Opauth with the loaded config
	$aOpauth = new Opauth( $config );

} else {
	echo '<html>';
	echo '<head>';
		echo '<meta charset="utf-8">';
		echo '<title>Codebot - gamedev IDE on the cloud</title>';
		echo '<link rel="stylesheet" type="text/css" href="css/zocial.css" />';
		echo '
			<style type="text/css">
				body {
					background: url(\'./img/hero.jpg\') center top #2D2D2D;
					color: #efefef;
					font-family: Arial;
				}
				.panel {
					width: 300px;
					height: 60%;
					padding: 10px;
					margin: 70px auto;
					text-align: center;
				}

				.panel img {
					width: 169px;
					height: 169px;
				}

				h2 {
					margin: 2px 0 -10px 0;
				}

				.panel a {
					margin-top: 50px;
				}

				.error-panel {
					margin: 50px 0 0 0;
					border: 1px solid #FF594F;
					color: #FF594F;
					padding: 10px;
				}

				.warning {
					width: 50%;
					margin: 0 auto;
					border: 1px solid #FF594F;
					background: #3D3D3D;
					color: #FF594F;
					padding: 20px;
				}

				.warning a:link, .warning a:hover, .warning a:visited, .warning a:active {
					color: #DDDDDD;
				}

				footer a:active,
				footer a:hover,
				footer a:visited,
				footer a:link,
				footer {
					color: #5d5d5d;
				}

				footer {
					width: 98%;
					position: absolute;
					bottom: 10px;
					font-size: 0.8em;
					text-align: center;
				}
			</style>';
	echo '</head>';

	echo '<body>';
		echo '<a href="https://github.com/Dovyski/Codebot" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/52760788cde945287fbb584134c4cbc2bc36f904/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f77686974655f6666666666662e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_white_ffffff.png"></a>';
		echo '<div class="panel">';
			echo '<img src="img/codebot-logo.png" title="Codebot"/>';
			echo '<h2>Codebot</h2>';
			echo '<p>Gamedev IDE on the cloud</p>';
			echo '<a href="./index.php/github" class="zocial github">Login with Github</a>';

			if(isset($_GET['error'])) {
				echo '<div class="error-panel">' . htmlspecialchars($_GET['error']) . '</div>';
			}
		echo '</div>';
		echo '<div class="warning">Codebot is in <strong>closed alpha</strong>. In order to participate, you need an invite. If you want one, just ping <a href="https://twitter.com/As3GameGears" target="_blank">@As3GameGears</a> on twitter.</div>';
		echo '<footer>Developed by <a href="http://twitter.com/As3GameGears" target="_blank">@As3GameGears</a><br />Icon made by <a href="http://www.simpleicon.com" title="SimpleIcon">SimpleIcon</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed under <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a></footer>';
	echo '</body>';
	echo '</html>';
}
