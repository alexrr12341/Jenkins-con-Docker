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
define( 'AUTH_KEY',         '@7`1?I6*Zmll|x|[BaT0+358[r&O[/iTIFl789A%LLl:R?m;Cmi:hG)0q{W6fwuw' );
define( 'SECURE_AUTH_KEY',  '1^o:EQX8X`w@S~*l40H-*J]3#fh<u@qYH$CL6;7,IFXw.{Z5{`8Ns(-Cn{$WP+ln' );
define( 'LOGGED_IN_KEY',    'O$4Zd}x{3Mh 6eJ#4i!fL9e#=)SR|Toto.xB*d/cC=N@J!p+MP(n,,7X^ae%3yZG' );
define( 'NONCE_KEY',        '2xHDn$q((#K1N:t|mVq*q #vFN~f@rBj(z&COaIN#%ZB}5qNe4Y&uO17e]x$<|(w' );
define( 'AUTH_SALT',        '|=Th$k#JPrTt8~a<K4/u-aQ5$HFBhe,sqk|~UHD&/f06bwz|d$<*edw[1)D/}|{K' );
define( 'SECURE_AUTH_SALT', 'f-$ru{4:Sf`lJNp}5KE@o~rtP.`h>=]y],pQy}`gBv{`Mk:kne~!v2y sJiFGBv1' );
define( 'LOGGED_IN_SALT',   'P*E[:D@|-z4ax*M]i{uNl;#%(M!}?K~Ri/(^;W03/V_Qb5(og0G}0WaKs(^*/N%:' );
define( 'NONCE_SALT',       'C_l+Wue6@&PSe*h:|EV-*M/(433P=m6aZ@Cp}mZ0U_yO!aGb;O1fiw$nK?W!hIt1' );

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

