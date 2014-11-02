<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hairpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'b7-y$*LHj?hX}H7d3au}7$!+} `-d+{k-ID/}+rKUGbPZsHVg-NAb3jO#a*rTs=3');
define('SECURE_AUTH_KEY',  ')br$ub^,Hd-8`wGF$0}M1=|4i)q*)?8qZx/D)k)/|SbhZ`)x#Yv?I{O.eU2Q[*6V');
define('LOGGED_IN_KEY',    's#<o+GaQBCArK*_j>/*Vq=NYIg_8 JNKIU+w+ntK,y=)z~:)w_-#MK1b$ %,Hu%O');
define('NONCE_KEY',        '].5(2kQ5@!gfxL%/w{gDGSnz0WPUvmDYU$$6.5R1@@hs4:uWy2S,59<MQAtBq-!1');
define('AUTH_SALT',        'lX:/aJ)OM$Nk dfcJQneV2g8^|+mi|Ws/hc^w0w[jObg8q/: p:SWG-lu3Z1]pS ');
define('SECURE_AUTH_SALT', 'FY>-?Op+n><v/lY>Z8!-~Vx64B-hf`!fZ(FvKT]|p#;tYuG)T}sYEnBE0%`>JO/m');
define('LOGGED_IN_SALT',   '}C37n/XE2_-U&Ozn*3twm[/0m wDURjf5{2ki+xfs:F|:<}C=]DXD9H^{5~d-VLy');
define('NONCE_SALT',       'I5Ib(=JA-k(=ZGzDn+`tsYth!l*A6xr0Ys@yvkd+VeFNgL2S`o:@<5hR>$h(JT&a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
