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
define( 'DB_NAME', 'i7083689_wp1' );

/** MySQL database username */
define( 'DB_USER', 'i7083689_wp1' );

/** MySQL database password */
define( 'DB_PASSWORD', 'K.u8lNohU6BXH6n7hjF22' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'ApGclJzQXiFExgMMGTm7pKNfkyV5YaxyUoQfoTZelROofrS9Yj4PkWcpNvO0GiYy');
define('SECURE_AUTH_KEY',  '77TnUjwlzFvsAwE6P2OghDpEw7agJ5vz4RgfqZZ7e6AN7XCWzN0OXDvUguC2kKAc');
define('LOGGED_IN_KEY',    'uBLU8ujppppJ80MdSgTd8LDEM2RZ1aennETmqnaeTmbxi0sZcatxyYWsKCs0VX8U');
define('NONCE_KEY',        'VsbiEYtHTdeZtAPVAT5QqwFsnvWVujPnAKapN0PU1uFPMcxZFibk5nUJ1TN31n2r');
define('AUTH_SALT',        'xx1TGYB1Rv5JXqmFmsMJCezS2tOl5Pk9rVzIqEUgL3tl2BuV2jZidwcMzifUWm76');
define('SECURE_AUTH_SALT', '3PehMe6GdWBR0GXJpIon7onHlDMdAbzVOqn5KjtwmpqnFDeoVbRWOIcIm0DzFn1F');
define('LOGGED_IN_SALT',   'PK8RrQ8ZSQOVKCQxh0fDfBIkCwo7xIgcdDvOq0YXIONoKuTgOjSHhX7IHwsqUGKN');
define('NONCE_SALT',       'w3VEe1QraBESM1Menc6sZ9pHRqe0O0QKvWB5aVL005z4Gcx35cbR7A9f0puzXIf2');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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