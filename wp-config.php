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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'burgerdb' );

/** MySQL database username */
define( 'DB_USER', 'burgers_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'workon2020' );

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
define( 'AUTH_KEY',         'lNo7isSUcJ{a_G86yN8b|H!vpDXc)kehx,c|7ud&P/cIV~Xs|,>:1;xH>2a]0jW7' );
define( 'SECURE_AUTH_KEY',  'cn`SL;:=:w`MG}nNQozR[IH;F,bppw$(B7<YKnYp+veAfhox;6X _#Thl67;89jE' );
define( 'LOGGED_IN_KEY',    '_lY/^R)d|L*Kos#Sq%w^LfFhO.A9pUs*r^W|=UNODjY{>7zbr8ju^R%wf//oE37Y' );
define( 'NONCE_KEY',        'XT?)sH1cs/AZ=aa?1qWx|PDs8w7df~d:;L6jXKRP>-h#~BGF -h7o.p8ibVWcDu^' );
define( 'AUTH_SALT',        'Ml/Tu%<v|?O)Bk?nLFem!+P|-0JrXL/)U!+@bz jv<kA0V9@j(X1U2#*SRb8mvXw' );
define( 'SECURE_AUTH_SALT', 'iC?FZQo1:B-,?&7Nj:TgN%K<P^H8ejx.@[;!n!wiUYd2#;w>WF>#]Gt2OTI9VuQP' );
define( 'LOGGED_IN_SALT',   '2*f=w3A41p=e^GuPYr ad4h]xw|O(w3c(iRC=uVs=-p1|J$?vEAd{v4rZxOg9;9}' );
define( 'NONCE_SALT',       '^pGnLaGX/m>,!p&>K -`QKjT.Jf0.#{t3!6<)n+ys:Og(Gkc1}J%F}ifk?B{QB+<' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
