<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Multicalendarmanagement' );

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
define( 'AUTH_KEY',         '0-j1.FQ6Tp;u.U<yT`En_O!sbfYTl>:[$)Q$7YkJ*~b~XPJ65AvCxWJSSzCW)dm~' );
define( 'SECURE_AUTH_KEY',  'i@`[R@jx(;^nG,AX[J)z=8=F8l<kYUiey1p;nNnkOSK[@Zf/,]3:[}SX+/C7981r' );
define( 'LOGGED_IN_KEY',    'a%si[i>L?M]3B<oc@8yfHCk(x`Cy2xqJ@$D&1Zpj+*h6(TOEAb<t]R}|(k-,XY@G' );
define( 'NONCE_KEY',        'kvg*4Z|*uB14z2r.k0|-xRh5P0XUUfD. m0O~EH$$q.j<IUQngn!pp4a/mQdPT(|' );
define( 'AUTH_SALT',        'eLu+#0YkKg# $0&#8W2+?g/g{NHr{(!Dj(^g2#Zp;ck5*(wj&=Z%C9Ex1@vf}=$@' );
define( 'SECURE_AUTH_SALT', '?Lk}*fAgd?{kl7>plJb[IojfQ.2[@dIDH*M!E$l<?U^F:QO#dfv]#eK#IPxLu:<2' );
define( 'LOGGED_IN_SALT',   'GMI|^.JlsST%rX}w_)ek}~7gQ<Z%)XLjwQK*vr,F$Z<tZludlnumN,U%zr9hw0Wt' );
define( 'NONCE_SALT',       '/iFoN>#DGZ^Wm>I@aZ% Ca-]mSyhS~L7nPHj8%V4>Ck,+p=LhCpIpd%i.rl|vpuq' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mcm_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
