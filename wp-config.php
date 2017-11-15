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
define('DB_NAME', 'esdb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'mysql');

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
define('AUTH_KEY',         'GW7dn& X>jR3^sDR_[RfScn=vL]dM.f1W`Upbk[WW^bu N1$tAtCap2da.QGNyn5');
define('SECURE_AUTH_KEY',  'Qf)^;B.zji=t0`6psucg}J6:EwzRRX&A:eSVwEj24pOsRF}w[[&&`?Lt=T6l~7QY');
define('LOGGED_IN_KEY',    'dF9S%$<6<$XxKvL.;5`0^$l0#V:_UJs`j6U7u3taDsy&VQQ/c+9pc_F]Fk+B4}s-');
define('NONCE_KEY',        's5w~d#>oyp&lMq9(*6m2b*/<P+5Dn(ql(Q^1vEp&`[/hGcTpE65>A$:IJ5aL]@kf');
define('AUTH_SALT',        '8=vbuGeoG;7_Uda4En+>Zu{V @)K!!I*B3IiJ}c^|wLYxYHo0$nnU2id-{v?:[ S');
define('SECURE_AUTH_SALT', ']Yx}T*Q-<i1u2>*2]5dGs qs G=bk@hsw+{|)wsl%zJy2x~l(iDyn[> yzhbaa#d');
define('LOGGED_IN_SALT',   '+]QPB.y>W>4I1Ab5/~B=ZCFmSB:#mB=RZ!&)zK dU8 s<x-j$TkEP1k83W>SLVRC');
define('NONCE_SALT',       '=}I2a#9*D*R[SKHfj]e5e&$Bz4X02R]G-d0UM<[;jwEa,fkFK8/M|[a+H)ZgBr3y');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
