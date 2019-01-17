<?php
namespace App\Themes\Pvtl\Library;

class RegisterBlocks
{
    // Required params for each block
    protected $title = null; // eg. My Custom Block
    protected $render_callback = null; // Method defined in each block's render()

    // Optional params for each block
    // https://www.advancedcustomfields.com/resources/acf_register_block/
    protected $name = null; // eg. my_custom_block - must only start with a letter
    protected $description = '';
    protected $category = 'layout'; // [ common | formatting | layout | widgets | embed ]
    protected $icon = 'admin-comments'; // https://developer.wordpress.org/resource/dashicons/
    protected $mode = 'edit'; // Default display mode - [ preview | edit ]
    protected $keywords = ['block', 'custom', 'pvtl']; // Used for search
    protected $supports = ['align' => false];
    protected $post_types = array('post', 'page');

    public function __construct()
    {
        // Make sure ACF plugin is installed
        if (!function_exists('acf_register_block')) {
            exit;
        }
    }

    /**
     * Add init action into ACF
     *
     * @return void
     */
    public function init()
    {
        add_action('acf/init', [$this, 'registerAllBlocks']);
    }

    /**
     * Register all of our ACF-Gutenburg Blocks that reside in /template-parts/blocks
     *
     * @return void
     */
    public function registerAllBlocks()
    {
        // Get all block files
        $blocks = glob(dirname(dirname(__FILE__)) . '/template-parts/blocks/*.php');

        foreach ($blocks as $block_path) {
            if (!file_exists($block_path)) {
                continue; // File now doesn't exist for whatever reason
            }
            require_once($block_path);

            $class_name = $this->getClassNameFromPath($block_path);
            if (!class_exists($class_name)) {
                continue; // Class doesn't exist or named incorrectly
            }

            $class_ref = new $class_name();
            if ($class_ref->blockIsValid()) {
                $defaultBlockName = $this->createBlockName($block_path);
                $class_ref->registerBlock($defaultBlockName);
            }
        }
    }

    /**
     * Validate that a block has the required params
     *
     * @return bool
     */
    protected function blockIsValid()
    {
        // $title needs to be set in each block
        // render() method need to exist in each block
        if (empty($this->title) || !method_exists($this, 'render')) {
            return false;
        }

        return true; // Success
    }

    /**
     * Register each individual block
     *
     * @param str $defaultBlockName
     * @return void
     */
    protected function registerBlock($defaultBlockName)
    {
        return acf_register_block([
            'name' => $this->name ?? $defaultBlockName,
            'title' => __($this->title),
            'description' => __($this->description),
            'render_callback' => [$this, 'render'],
            'category' => $this->category,
            'icon' => $this->icon,
            'mode' => $this->mode,
            'post_types' => $this->post_types,
            'keywords' => $this->keywords,
        ]);
    }

    /**
     * Assume a Class Name from a given path
     *
     * @param str $path
     * @return str
     */
    private function getClassNameFromPath($path)
    {
        // '/var/www/file.php' becomes 'file'
        $filename = basename($path, '.php');

        // 'one-column-image-banner' becomes 'OneColumnImageBanner'
        $class_name = str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $filename)));

        return 'App\\Themes\\Pvtl\\Blocks\\' . $class_name;
    }

    /**
     * Create block name - allows us to not "need" to create a block name per block
     *
     * @param str $path
     * @return str
     */
    private function createBlockName($path)
    {
        // '/var/www/file.php' becomes 'file'
        $filename = basename($path, '.php');

        // 'one_Column_Image_banner' becomes 'one-column-image-banner'
        $block_name = strtolower(preg_replace('/[^a-zA-Z0-9]/', ' ', $filename));
        $block_name = str_replace(' ', '-', $block_name);

        return $block_name;
    }
}

if (!defined('ABSPATH')) {
    exit;  // Exit if accessed directly
}

$pvtlRegisterBlocks = new RegisterBlocks();
$pvtlRegisterBlocks->init(); // Add the init action
