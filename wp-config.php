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
define( 'DB_NAME', 'molla' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'Qgcwp?a/*~4/xRos!Q3Ym=rR=c8dmfoI:!:aVMkEO^jRzjJ3jlb%vUN|lB-8.pFt' );
define( 'SECURE_AUTH_KEY',  'jA$k94M`_Dh;in;h^S$m%|aH&TH=D5Idto?k`^E-(#W,lJAOJhj%s|=e|/!47SCi' );
define( 'LOGGED_IN_KEY',    'cLC_o?t.n?T8y:.h.lISh~S!_S*|1G139o,$Z_hP%Q.`+uMl_b`4e?WdzguGb!l,' );
define( 'NONCE_KEY',        'J%rNb`,<vmPh:YHJ52u=_E4w{d2@EvK4RD6qRb4Yt=^=piwFq9BR+=VrGl+2=K}2' );
define( 'AUTH_SALT',        '7(aT4rl4Dx>DXbE.ofyx~V]sy69EQD[Jd(j**z1/3`Y+&%=p%]69*uLNPUZa/mpr' );
define( 'SECURE_AUTH_SALT', '6(D?]%Gj)&{ * q?;:((X|/[Q>DWy$dk>;D|#(|H&uJl630nX=)lP=o6Rf8[ouwf' );
define( 'LOGGED_IN_SALT',   '6f5M w;QBUz;P|UOGK3K%>QC[^]@a]=uVsIj9nDV:wfBNf]96d;,N,[BYY#U:-_-' );
define( 'NONCE_SALT',       '$m?MVT<3!!^YPUC-UQ^C4(qDe[0a/T{vY,0PK<`l6aU_GF|h-Vw#xT_%$S9cm Xp' );

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
