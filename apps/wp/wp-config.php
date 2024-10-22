<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

define('HOST_NAME', trim($_SERVER["HTTP_HOST"]));
define('IS_LOCAL', substr(HOST_NAME, -6, 6) === '.local' ? true : false);
define('REQUEST_SCHEME', __get_request_scheme());
define('FORCE_SSL_ADMIN', IS_LOCAL ? false : true);

define('WP_SITEURL', __get_custom_site_url());
define('WP_HOME', WP_SITEURL);
define('WP_CONTENT_URL', WP_SITEURL . '/wp-content');

define('FS_METHOD', 'direct');
define('WP_AUTO_UPDATE_CORE', false);
define('WP_MEMORY_LIMIT', '256M');
define('DISABLE_WP_CRON', true);

if (IS_LOCAL) {
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ERROR);

	define('WP_DEBUG_LOG', true);
	define('WP_DEBUG', false);
	define('WP_ENVIRONMENT_TYPE', 'local');
	$_SERVER['HTTPS'] = 'off';
} else {
	ini_set('display_errors', 0);
	define('WP_DEBUG', false);
	$_SERVER['HTTPS'] = 'on'; // fixed = on để function is_ssl() trả về true vì cloudflare call đến server bằng http nên mặc định function is_ssl sẽ trả về false
}

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

if (IS_LOCAL) {
	/** The name of the database for WordPress */
	define('DB_NAME', '3g_dh3g');

	/** Database username */
	define('DB_USER', 'root');

	/** Database password */
	define('DB_PASSWORD', '');

	/** Database hostname */
	define('DB_HOST', 'ad-power-mysql');
} else {

	/** The name of the database for WordPress */
	define('DB_NAME', '3g_dh3g');

	/** Database username */
	define('DB_USER', '3g_adm');

	/** Database password */
	define('DB_PASSWORD', 'uk#d4*N^5AvC+oz0');

	/** Database hostname */
	define('DB_HOST', 'localhost');
}

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*2+#s+tVM!tl1,eK1H&<q!our4gTa92}aLlsd]_OYm=a%x <V#|>z?h>@k;]c$^P');
define('SECURE_AUTH_KEY',  'p8P:`S`eJL5,%[xjns]mwsR`g:>_8c{6_cKhe#68=}d7M6zQG FCw5{0/bzXAVMy');
define('LOGGED_IN_KEY',    'o)Y(A,qXIc[z/#`G^0?q[e^&eSiu.!u35ro4EX.G0@ 4e3l3h8R_cp*#v9x[;e45');
define('NONCE_KEY',        'k%?fcljr[T02nE5cY-+&ev)f%e@glPLgD7vF]<?>w!?0X0Kms{S;} %;VB0<LQKk');
define('AUTH_SALT',        '9./vB01*;eh2X6I_vK*bp~G8++EC~O|mE*!NPR$;DO)?nI+hR@`i70s>R_V`S(Ei');
define('SECURE_AUTH_SALT', 'yQ4f+@On>Wg)CqS8BJC^T3Z}#D mc7irWUC_2mr[OTD1l_.GehLL)q:)7*!a^uc$');
define('LOGGED_IN_SALT',   '8DD!M%Zk>P<(*9BQy]oUo_ka+;ibU!6/*~z84gM;qwtblwEH0fUonH@Eb*IgmC&n');
define('NONCE_SALT',       ' SJo[oX[_$yW1@dS!c8.nvY04qN*O1iK|Pp9}A({(Phn~?]GS_wUeIk R`CKsT1:');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '3g_';

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


function __get_custom_site_url()
{
	return trim(__get_request_scheme() . "://" . $_SERVER["HTTP_HOST"]);
}

function __get_request_scheme()
{
	$schema = $_SERVER["REQUEST_SCHEME"];
	if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"]) {
		$schema = $_SERVER["HTTP_X_FORWARDED_PROTO"];
	}
	if (isset($_SERVER["HTTP_CF_VISITOR"]) && isset($_SERVER["HTTP_CF_VISITOR"]["scheme"]) && $_SERVER["HTTP_CF_VISITOR"]["scheme"]) {
		$schema = $_SERVER["HTTP_CF_VISITOR"]["scheme"];
	}

	return $schema;
}
