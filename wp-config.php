<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pwvr3db036');

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
define('AUTH_KEY',         'PZ.]a5e_`NAL_K.G&8?3F_uv`0H+,$WiO`iO(/=)t5qA)Rt:@;+V<eG2]Rbz,F^-');
define('SECURE_AUTH_KEY',  '-s:U~*39_[1(|uPFc^+eVn`p43V?rp<?`!wzI77M[snLm)yLjq+yHR5-*PQF.t9)');
define('LOGGED_IN_KEY',    'hhZOvr~EIyVW#0I-{b<F(8Yy3b[.sKdh0;#]B;>b!|4s69maRaU]}Pr{[w([le8y');
define('NONCE_KEY',        '9tRK0Mt+!4~A2`^p#-~Y5A>KGjn|dwX^91C6CZHf|. _=n@k/+<ahU0mO$=4X&DL');
define('AUTH_SALT',        'Ysx#u NB:a@IzH2BdNyTz@#pK$$gkfx=>/-xZP3o%5P~SN};9/p|X)Pyx`zu9$l6');
define('SECURE_AUTH_SALT', 'D2|%;-xWL0M2g<F/,;|!nAg7vYi:-NJ:rnR-|;xlwg~2N!V4/<}DtjwPlHpqDq{/');
define('LOGGED_IN_SALT',   'qcbW:+T%SEVt>k7sbZ{D<j6}pYx}a*k] `pc+H+bb:HGzu|V_K>1ni259$wQgF~C');
define('NONCE_SALT',       'cKwY#>sJ_z<^0C6>[Jx[%y+2B.m|#X3D7)UT8[]uYt.O?LC+nSl6-gapA}5=Fl;6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mysakhe_';

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
