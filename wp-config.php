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
define( 'DB_NAME', 'wuxt' );

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
define( 'AUTH_KEY',         'c:<;kl6seU]eJ(c616`a!!3^k/y+JRPxBFwoh7Er9e8k<}3Q&A4KrTaqJx Z1{|[' );
define( 'SECURE_AUTH_KEY',  'a5Ru7X@,k|=,>qPk|=0Y%pCd;4[-X.90m5DW gM`]$h|U]ceD`mi+X*qc|JJ_G*S' );
define( 'LOGGED_IN_KEY',    'rxYWuyf(<2VCp7MqB8*.`x1&>{Uq I2vwYz^|/AS1R&Y7&3#;msE1?#h-Vdd2iL8' );
define( 'NONCE_KEY',        '_>wSo&J|t$Y:t}1;,5n8Wt8Q;}gWFk!e;=it]u=Hza=r4Di,hivc4V=vCx6|Op#?' );
define( 'AUTH_SALT',        'b.}94=E3sdx**M[xm6F}VezmN_db+6*Wp$XciXp2*(}Y,H!Ac?c^XW|FDx=cn3cb' );
define( 'SECURE_AUTH_SALT', 'sA<L&=-`U>v T/orD*:IsUVWtYl(yXw3m5qr#}`7fGbyI$};b(&8}|9+Xm4Gh{#m' );
define( 'LOGGED_IN_SALT',   '=lZUVZ5k`9O?ggndA@U:dNZ*dW%])d<IHH|H6BbZ~8xvh6o^>`AIpn:%9ti#lQm4' );
define( 'NONCE_SALT',       'IJ[l$/#}OcJyiy@:dTEt:{nN=VmQZX[mMQfJ=~:+/%VVO?>i(AC7U5Dd*(<98F f' );

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
