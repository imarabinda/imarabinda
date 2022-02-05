<?php
/**
 * imarabinda
 *
 * @package       IMARABINDA
 * @author        Arabinda Baidya
 * @license       gplv3-or-later
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   imarabinda
 * Plugin URI:    https://facebook.com/imarabinda
 * Description:   You know who I am.
 * Version:       1.0.0
 * Author:        Arabinda Baidya
 * Author URI:    https://facebook.com/imarabinda
 * Text Domain:   imarabinda
 * Domain Path:   /languages
 * License:       GPLv3 or later
 * License URI:   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with imarabinda. If not, see <https://www.gnu.org/licenses/gpl-3.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
// Plugin name
define( 'IMARABINDA_NAME',			'imarabinda' );

// Plugin version
define( 'IMARABINDA_VERSION',		'1.0.0' );

// Plugin Root File
define( 'IMARABINDA_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'IMARABINDA_PLUGIN_BASE',	plugin_basename( IMARABINDA_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'IMARABINDA_PLUGIN_DIR',	plugin_dir_path( IMARABINDA_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'IMARABINDA_PLUGIN_URL',	plugin_dir_url( IMARABINDA_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once IMARABINDA_PLUGIN_DIR . 'core/class-imarabinda.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Arabinda Baidya
 * @since   1.0.0
 * @return  object|Imarabinda
 */
function IMARABINDA() {
	return Imarabinda::instance();
}

IMARABINDA();
