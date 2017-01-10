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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wordpress' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '](@U%2pv&?Yf+3H`Apt$e>f24TK:w36V`^HEZeWr.Pj-kvmr=$3%+E+-GyI{4E%p');
define('SECURE_AUTH_KEY',  '.H;;3L4HDXGV]S0(}N-A].Nk<No4WbE3VH7M!FLQ>id(^RW{rn.qMfqJ`ZlM?VoV');
define('LOGGED_IN_KEY',    ':Pl@uf]cz=td (Mom*5+V31eK[4J;1x~_:h(]JHpS-6[p@o$]hS@/q?aDYO+nu2C');
define('NONCE_KEY',        '[k$BK6 qshlkMJXj#K>[OjCJd^)pTqG3xYGa--H92:3pux^rdB[Mtv:-n$2Mc}zC');
define('AUTH_SALT',        '?|J017}MyGO(AoGR=23;%Wi4KEugk>mX?h:_tx@7<e/VVI%L@uU%a,)jj?[cw5; ');
define('SECURE_AUTH_SALT', '-VPp|cceL.I9jWV:DFdaO~M@vS0%.dhx]lSh}W 5]mTvwDBbOQclL;WE*J6ByCYE');
define('LOGGED_IN_SALT',   'v s|d--,|<34S[o Q%%#22*sjB%ZA!|g8e@l_#4u@0GU1{7)pD:UyK}OPx66~17c');
define('NONCE_SALT',       'AAy+&u$a~`RDs`% d-)dl3BYWTGfKdx-=3c[1H5Ps58RQ%]U-(2-#BEh/37+#.G.');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define( 'JETPACK_DEV_DEBUG', True );
define( 'WP_DEBUG', True );
define( 'FORCE_SSL_ADMIN', False );
define( 'SAVEQUERIES', False );

// Addtional PHP code in the wp-config.php
// These lines are inserted by VCCW.
// You can place addtional PHP code here!


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
