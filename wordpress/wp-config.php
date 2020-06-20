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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wordpress' );

/** MySQL hostname */
define( 'DB_HOST', 'mariadb' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ',J9R=q7fj9Rg.W%|ej[A[Iovw8C1qfs-c2v{P,sG>p[>s~6z:KcdHG@/>`+UD~H)' );
define( 'SECURE_AUTH_KEY',  'SgoIlz~}<Pe`lM0( ?nYFRH@nVxR/ Je=9KJTeuaCVpMQ3^(T1[DBJI8l hM0$wK' );
define( 'LOGGED_IN_KEY',    '3KY0K`@B]HE6Y=@:bY_0xD}DSsw%F ??wOZj7.]&F-X3Hd)thG9djQnTiRZ:b)tZ' );
define( 'NONCE_KEY',        '.*<f{N<X;hlRT<da6m4xg]bqaut9%#F[g)Q9IHdJ%7&Rkd>Ejl=Db]1Xy-!bp/6O' );
define( 'AUTH_SALT',        'S:EkdjPQ<a6Oeouxgl`5Saf>,B-wL6a.[i*8a1x.V+A^>Bd7HC{0*r~i-,AA{jzf' );
define( 'SECURE_AUTH_SALT', 'K`*N9D#H1td&MEHNW&R@eX8mZIBCgJ#onbi#J)=AZgD A?mr,}B@fP+#jD<eH=5#' );
define( 'LOGGED_IN_SALT',   '2uL{c/1Z0!j.J ;0)P*-A x;iM:FCs|oJSZR8>cg4^)0O-:M!kW?yEi`[A?{8bYR' );
define( 'NONCE_SALT',       'E<7w9X+/@ 49[{aS:V,Y7cj-@e[17QP*X`0I8$D;VA!+x?ZzLZu:Wg09(^/Z{E67' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

