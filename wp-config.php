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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cmd' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '&^P]O%`n|v>xq]YP@KJvCv[L`|&sb-QnY)|PtBs>pKV^C,G.n]~1ucYv|dh;^WNJ' );
define( 'SECURE_AUTH_KEY',  '&|!eV2,|C_TT1UYvR8Q#+99S6Qe/TX!&0`k|Pd:3[,%{bp1SmvAk#;7qRB?n9#iY' );
define( 'LOGGED_IN_KEY',    'T`K,w-`P6uH Z^iJTJt#2HhY m>$!~t/hgCI03~9X{0eNH>|6E4{t@4lP(=C`]L<' );
define( 'NONCE_KEY',        '@n>I0nd_P>k9ism5/}uv<=u$Uov:6Wkn7D|(2>Jcm{T@<IWujV;V.`e~^cmi1!-l' );
define( 'AUTH_SALT',        '^59R*eWmQ0om5JzJ@Y|>V<Rc1RYf6VuUwt OeK(pauE^1p4/Fe}`1SI6I?/GmTA?' );
define( 'SECURE_AUTH_SALT', 'E!m-RVSa|WebA3m`(4A[2ePG1Smgy(ML6!$-AVUG>+Q{Cy&x|f(RmE//fCUw)GxN' );
define( 'LOGGED_IN_SALT',   ',=Qo&Hp|ke+~fYSz)/s9zeu#GkW;$98C:Mu`B`m&OBdCD8N98srpN0:Ggc>X;q|#' );
define( 'NONCE_SALT',       '37W1B=Y(M)n|I.f8dp}vN+11aZRGeXT<Wg$B1b0};}IY<>P3M3a#u0`8~ZbS{Lyw' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
