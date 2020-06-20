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
define( 'AUTH_KEY',         'Ra(eIcAba}4ilO78j<b,@5%7(VUS{=O A4x[>zTQ*n:=!*-Un*sDVq;eHt-g,>51' );
define( 'SECURE_AUTH_KEY',  'g#kcpk8NouV!ZsrCnQRrT##ovfA$E3Me^hwJL,`&aw^}a2qEM*ON6,,#v+EM8%,_' );
define( 'LOGGED_IN_KEY',    '7i6pn_+XwV=0>8FRYRx#laBjzarW3B695r=d^jd`B<C2%yh)%a=S|RjRYPOuM^G2' );
define( 'NONCE_KEY',        '{tP)J*$=HDDaxan??Wgs>@&ZzH0X:sUYh.D,M$sTbgSNBka#BFXrx]Sc^Wlw`%0j' );
define( 'AUTH_SALT',        'xZO]%zy7}*3(A(+taP(/}_!;_fdz;^CI$MwZ.$U?kAJ){qtHuf@c_A&,_Cglen4z' );
define( 'SECURE_AUTH_SALT', '*/% 5p8)|q]s!=j:N^.QC5_D@(:7L ,,5V7.GXU-g 3Pki@HBNM3cmXfE?QHL%9u' );
define( 'LOGGED_IN_SALT',   '!G6P@3??,=tH^&vx,.rYpIN`UTlk3#7miUte,z@^&p^KqZkxUXpQAWe}(,-w&|#@' );
define( 'NONCE_SALT',       'nokQ8/?Fbr/qX-UQr_xmU0A7>tIh2o2tdp~<iT!AdeYj[^Y68]JJYnh7t.]y@9X$' );

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

