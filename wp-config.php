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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         'D-Ii>9 ~}@;,:V`1v(5;9s9!tf7HR)nY?I1]}nkt|ziHuo<^O9(h7I&*px*?J(r{');
define('SECURE_AUTH_KEY',  '|kXwvO?[U;5+%2v0>&UD3;b-e?04REAb-W1IR~JKD.h@I`D>+:kI$35PfA={i4v{');
define('LOGGED_IN_KEY',    '&W}_A%/u8{E^8fjbe (z34)US#0!,0K_|7Un`kyFti+BC%TZ)/p)r{bd>=CeKFy+');
define('NONCE_KEY',        'k8}VfoGnT2B5buFeKYQB]jKQJZJS}yTn5VO`yXm;%-MQ,V/2FGWv:{bZ;Al;Qpv-');
define('AUTH_SALT',        'j*4ayN1Q2r]o?&!$L~b}!UioLW}q7+*jEo2~h@k?3q/uUy)-YMx,O7IStJhE FWE');
define('SECURE_AUTH_SALT', 'Fu2M^yL-/Ri00-Qb2!XW]l*4{ p9NoH_+jV=ldIZmv2W3TNVb3.n/wby0onz9waD');
define('LOGGED_IN_SALT',   '^bNG,[DD L|3;h8[DKU6D<61ZWo%N/hd]_xKJ1r9MEc58TM5/iwf]6g_anN<wrJU');
define('NONCE_SALT',       '8[X+C&w)/z*B&aQTuN@rqXNL;2diMjmyPP1$l|EWskb*E{HS}k=p`[I/Cr[~F)iP');

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
define('FS_METHOD','direct');
