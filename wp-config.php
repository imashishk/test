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
define( 'DB_NAME', 'test' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'H0a)eUyuJF;fhj*]IUxpv_/4e55BU#bt]Z3j*+< S)7ye0 hS!<;_c8+6r=&U$*j' );
define( 'SECURE_AUTH_KEY',  'K|QU92g3.&>e&ap|&:UMt@c$.Ay>%ig,<NC1N6it(4%g|o4{I7ia-*Pn6^8=:DZ`' );
define( 'LOGGED_IN_KEY',    '|CNO(C%<*fx? xCX<Xc6|q:;X`%1u;+3v;+{ZN~m}=ei`Glr.kqqc17x@Dr5f&#x' );
define( 'NONCE_KEY',        '~+iJ*e_aJuSNL3MQhdad$&@)P%t-yP9#S/$1/{!]{><Sv[#&]^{q8JJ7tC^O!I)t' );
define( 'AUTH_SALT',        'y$-KO!UCaVQ4lnda,ew]m`*SP0d8]gq$9W@]qZ:$KW~zhbGTV)~_B)wp2Sd9>@z4' );
define( 'SECURE_AUTH_SALT', '8a:YGo0tD~MRu=yj,RGFiK9f}]iW1!L5ds+HS?I|<Y?b<KesL5lNy]N,V[ls9M9K' );
define( 'LOGGED_IN_SALT',   '}3,:4wcDds.CGF4=D9u$[9XY?oV+HFw;MBQ:m$ ;vaT:P`1,j=>NKE:7q_}<YOG6' );
define( 'NONCE_SALT',       '5k%Q$)[^<kcb 6N!8P,`MCZ{7u-Dmk;JoVk~|ap^cn@cbj%m+;2jJ=$vw[P#6 aL' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
