<?php 
function sh_xml_importer()
{
	global $wpdb; 
	if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
    // Load Importer API
    require_once ABSPATH . 'wp-admin/includes/import.php';
	
    if ( ! class_exists( 'WP_Importer' ) )
	{
        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        if ( file_exists( $class_wp_importer ) )
        {
            require $class_wp_importer;
        }
    }

    if ( ! class_exists( 'WP_Import' ) ) {
        $class_wp_importer = get_template_directory() ."/framework/wordpress-importer/wordpress-importer.php";
        if ( file_exists( $class_wp_importer ) )
            require $class_wp_importer;
    }

    if ( class_exists( 'WP_Import' ) ) 
    { 
        $import_filepath = get_template_directory() ."/framework/backup/data.xml" ;

        $wp_import = new WP_Import();
        $wp_import->fetch_attachments = true;
        $wp_import->import($import_filepath);

        _load_class('import_export', 'helpers');
		$GLOBALS['_sh_base']->import_export->import();

    }
	die(); 
}
?>