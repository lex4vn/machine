<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cokhi');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '.}Oy.+B!lM~uTiB:[!V+/obIC1-c`oO: rw7yUlTpmWjY1,/iGrIn}sk#>e~33`Q');
define('SECURE_AUTH_KEY',  'WuA 7h-w_c6PTcZ28TQ2_VXL}RA_gO!+AA0K(6=hRDkW&s*_3Rz|WRTL{mCLZqWs');
define('LOGGED_IN_KEY',    'cm`Hm#de2o*w{TCF*gj};zBd(/$m!7-1(~s`z~|x[6@w)o5}.=r`@@j),4+PsZC{');
define('NONCE_KEY',        'Nd G;e31){.vS[gWA&1XNay|?W+:@u6Qj1$lzBntp866,;,H!s@?7$ja3%U5UhAn');
define('AUTH_SALT',        '%1_U-?cpmdYMhu<_&hN/!#QEI-f8t+U7<#&6nF5jKQR?v=dX,zbgU8UA-X&Z{w.;');
define('SECURE_AUTH_SALT', '5r~;Nq}QL<c9!u>~3=<qFdinO=6lPkZQ$rc[vF^K_$!dW!aiP7L/hM!GwIap1d[E');
define('LOGGED_IN_SALT',   'e3OrR4Yn`dMl.u=6vl6Jn,a+#gjLRnyUJ*n#EB|3_+kk[hWwe.*x<hZ*PEX!PPdV');
define('NONCE_SALT',       '?4+iRSdD%Q01T2NSImnxMGq^0khYX+3/NN9E%d5>d2JUmdp^|tr[&!*]m;`#Wy[9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ck_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
