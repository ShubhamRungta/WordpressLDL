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
define('DB_NAME', 'test');

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
define('AUTH_KEY',         'ss8E7Fo8dE&.,mce=87tS!/_Wx~4:L0Nyzmw__G|,KM-T3%vJYVa+oaHbUNc(Be:');
define('SECURE_AUTH_KEY',  ' 4q6ky4>lnX3rHTu%]%Ub=WQ1M7[E#q4XTL89ZVHW$.MJ7Cd<;%BKET8-[fJqTM$');
define('LOGGED_IN_KEY',    '],owyJqn1jz}=w?CSX)o?cj8W|hRHp%~J}AA6fC8hby ztSWggT;Pgf:~BAc>ih6');
define('NONCE_KEY',        'r4.%J%4+_ayRJy 4T0c^qa62m}=6(iQ%$52v3ypy~f~d]Jag,GBb7M.X(|@Ljw]p');
define('AUTH_SALT',        '?*W-ra%VrhP%kX.b:$/%hkoYrJ$)6k<wSr$b5H K~bgO9Oym3yONk T-n5/]|BTB');
define('SECURE_AUTH_SALT', 'TJay41AXW[edslRGB9?Vj:6Q^h|~;V0$=i_jOdZqQ}Fg0>7-K|,j^5)YJKTuzjh9');
define('LOGGED_IN_SALT',   'E_%th_iM1m)TcZNuEAKTMFrm7~~M6za-WWZGt21T`p$bEdBHjs/y@KQ,AIzT8Z)z');
define('NONCE_SALT',       'Va;;&`_q|p(GGHkQ!0&w:j}@^N]P8rhT?7ew>mf7(D(L6!OTH>j/E66U#(7HGh$6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_ldl';

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
