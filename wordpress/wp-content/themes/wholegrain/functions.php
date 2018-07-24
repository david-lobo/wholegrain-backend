<?php

function wg_register_custom_posts_init() {
    // Register Recipes
    $recipes_labels = array(
        'name'               => 'Recipes',
        'singular_name'      => 'Recipe',
        'menu_name'          => 'Recipes'
    );
    $recipes_args = array(
        'labels'             => $recipes_labels,
        'public'             => true,
        'capability_type'    => 'post',
      	'show_in_rest' 		 => true,
      	'rest_base'          => 'recipes',
        'has_archive'        => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        'taxonomies'          => array( 'category' )
    );
    register_post_type('recipes', $recipes_args);
}

add_action('init', 'wg_register_custom_posts_init');

function wg_rest_prepare_recipes( $data, $post, $request ) {
	$_data = $data->data;
	$params = $request->get_params();
	$return = [];
	$return['id'] = $_data['id'];
	$return['title'] = $_data['title']['rendered'];
	$return['content'] = $_data['content']['rendered'];
	$return['link'] = $_data['link'];

	$categories = $_data['categories'];
	$category_names = [];
	foreach ($categories as $category) {
		$category_name = get_the_category_by_ID($category);
		$category_names[] = $category_name;
	}

	$return['categories'] = $category_names;
	$data->data = $_data;
	return $return;
}

add_filter( 'rest_prepare_recipes', 'wg_rest_prepare_recipes', 10, 3 );

function wg_theme_scripts() {
    wp_enqueue_script( 'wholegrain-app', get_template_directory_uri() . '/app.js', array( 'jquery' ), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'wg_theme_scripts' );

?>
