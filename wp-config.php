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
define( 'DB_NAME', '_curso02' );

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
define( 'AUTH_KEY',         '<O<p/;=]T6]*1T+VT%Xc~+J?3llGRsmjXY/|u5UQL7zdd>|9R@/yK_/z2v{sps%d' );
define( 'SECURE_AUTH_KEY',  'LBNil`ab67cH^|38oZPd*V#gEEe)tF]{+P*8:]%_g4>;D)%$bvT:GIVJh,6=;$QA' );
define( 'LOGGED_IN_KEY',    '4K!`]eeD*N(>3jbeV5H654&}2D%$;oCQmViS/L5e/~NC@p9sMLV1g?C#`[dA,j[T' );
define( 'NONCE_KEY',        '>j~C<<@WH)(t!aud7aDXBUbExlV~1>y]<T4X9Tf56 |;Bm.xt^+s$>:wibm]-Ddv' );
define( 'AUTH_SALT',        '!m.)0=.Xt!(,GTj8+Ma!1Tg**8Y x]#m;1r*zHL+x^JR-3mr/e#vTTAPpzPzDxHT' );
define( 'SECURE_AUTH_SALT', '|@rpzxPj@D114)!+icr.N*y7$h!3K:ASj$N.;k3tL>SSNDL&$GirR_p* {Qk7bJq' );
define( 'LOGGED_IN_SALT',   'DC<&25->67@LM}n.eO?W*Kk3Pr[paN-$LO<3 ]1u$|P+RK)i:yC4&x_8}PldwV3e' );
define( 'NONCE_SALT',       '69]$ji!<X*}{EvOdA(|]l0Ys.I(>$u(vx1tt$n%r}Kr.Zb#juY|dY5EJ~<P/3{2m' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'atr_';

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
define('WP_DEBUG_DISPLAY', true);
define('WP_DEBUG_LOG', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
