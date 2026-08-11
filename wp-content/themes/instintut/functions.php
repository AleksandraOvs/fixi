<?php
define('JWT_AUTH_SECRET_KEY', 'fixibot-secret-key-2026');
define('JWT_AUTH_CORS_ENABLE', true);
/**
 * Author: Robert DeVore | @deviorobert
 * URL: html5blank.com | @html5blank
 * Custom functions, support, custom post types and more.
 */

require_once 'modules/is-debug.php';

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if (! isset($content_width)) {
    $content_width = 900;
}

if (function_exists('add_theme_support')) {

    // Add Thumbnail Theme Support.
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail.
    add_image_size('product', 300, 540, true);
    add_image_size('article', 400, 250, true);
    add_image_size('thumb', 600, '', true);

    // Enables post and comment RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Enable HTML5 support.
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

    // Localisation Support.
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
    wp_nav_menu(
        array(
            'theme_location'  => 'header-menu',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => 0,
            'walker'          => '',
        )
    );
}

//

add_action('wp_enqueue_scripts', 'theme_scripts');
function theme_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_enqueue_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array('jquery'), '4.3.0');
        wp_enqueue_script('conditionizr');

        wp_enqueue_script('fancy', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array('jquery'), '1', true);

        wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.js', array(), '1', true);

        wp_enqueue_script('imask', get_template_directory_uri() . '/js/imask.js', array('jquery'), '1', true);

        wp_enqueue_script('custom_scripts', get_template_directory_uri() . '/js/common.js', array('jquery'), '2.2');

        wp_enqueue_script('modal-script', get_template_directory_uri() . '/js/modals.js', array(), 0.1, true);
        wp_enqueue_script('header-script', get_template_directory_uri() . '/js/header-script.js', array(), 0.1, true);
        wp_enqueue_script('dropdowns-script', get_template_directory_uri() . '/js/dropdowns.js', array(), 0.1, true);
        wp_enqueue_script('search-script', get_template_directory_uri() . '/js/search.js', array(), 0.1, true);
        wp_enqueue_script('mobile-menu-script', get_template_directory_uri() . '/js/mobile-menu.js', array(), 0.1, true);

        //wp_enqueue_script('services-list-scripts', get_template_directory_uri() . '/js/services-list-script.js', array(), 0.1, true);
        //wp_enqueue_script('search-box-scripts', get_template_directory_uri() . '/js/search-box.js', array(), 0.1, true);
        //wp_enqueue_script('diagnostic-scripts', get_template_directory_uri() . '/js/diagnostic.js', array(), 0.1, true);


        wp_enqueue_script('team-slider', get_template_directory_uri() . '/js/team-slider.js', array(), 0.1, true);
    }
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles()
{

    wp_enqueue_style('fancybox-css', get_template_directory_uri() . '/css/jquery.fancybox.min.css');
    wp_enqueue_style('swiper-css', get_template_directory_uri() . '/css/swiper.css');
    wp_enqueue_style('grid-css', get_template_directory_uri() . '/css/grid.css?v=4.2');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style('mob-css', get_template_directory_uri() . '/css/mob.css');
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        // Conditional script(s)
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0');
        wp_enqueue_script('scriptname');
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    if (HTML5_DEBUG) {
        wp_register_style('normalize', get_template_directory_uri() . '/css/lib/normalize.css', array(), '7.0.0');
        wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');
        wp_enqueue_style('html5blank');
    } else {
        wp_register_style('html5blankcssmin', get_template_directory_uri() . '/style.css', array(), '1.0');
        wp_enqueue_style('html5blankcssmin');
    }
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array(
        'header-menu'  => esc_html('Header Menu', 'html5blank'),
        'extra-menu'   => esc_html('Extra Menu', 'html5blank'),
        'footer-menu1'   => esc_html('Footer Menu#1', 'html5blank'),
        'footer-menu2'   => esc_html('Footer Menu#2', 'html5blank'),
    ));
}

function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes, true);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name'          => esc_html('Widget Area 1', 'html5blank'),
        'description'   => esc_html('Description for this widget-area...', 'html5blank'),
        'id'            => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html('Widget Area 2', 'html5blank'),
        'description'   => esc_html('Description for this widget-area...', 'html5blank'),
        'id'            => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}

function my_remove_recent_comments_style()
{
    global $wp_widget_factory;

    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }
}

function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base'    => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'  => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total'   => $wp_query->max_num_pages,
    ));
}

function html5wp_index($length)
{
    return 20;
}

function html5wp_custom_post($length)
{
    return 40;
}

function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo esc_html($output);
}

function remove_admin_bar()
{
    return false;
}

function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', '', $html);
    return $html;
}

function html5blankgravatar($avatar_defaults)
{
    $myavatar                   = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = 'Custom Gravatar';
    return $avatar_defaults;
}

function enable_threaded_comments()
{
    if (! is_admin()) {
        if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

function html5blankcomments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
?>
    <<?php echo esc_html($tag) ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID(); ?>">
        <?php if ('div' != $args['style']) : ?>
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <?php endif; ?>
            <div class="comment-author vcard">
                <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
                <?php printf(esc_html('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.') ?></em>
                <br />
            <?php endif; ?>

            <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
                    <?php
                    printf(esc_html('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(esc_html_e('(Edit)'), '  ', '');
                                                                                                    ?>
            </div>

            <?php comment_text() ?>

            <div class="reply">
                <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <?php if ('div' != $args['style']) : ?>
            </div>
        <?php endif; ?>
        <?php }

    /*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

    //add_action('wp_enqueue_scripts', 'html5blank_header_scripts');
    add_action('get_header', 'enable_threaded_comments');
    add_action('init', 'register_html5_menu');
    add_action('widgets_init', 'my_remove_recent_comments_style');
    add_action('init', 'html5wp_pagination');

    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'rel_canonical');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

    add_filter('avatar_defaults', 'html5blankgravatar');
    add_filter('body_class', 'add_slug_to_body_class');
    add_filter('widget_text', 'do_shortcode');
    add_filter('widget_text', 'shortcode_unautop');
    add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
    add_filter('the_category', 'remove_category_rel_from_category_list');
    add_filter('the_excerpt', 'shortcode_unautop');
    add_filter('the_excerpt', 'do_shortcode');
    add_filter('style_loader_tag', 'html5_style_remove');
    add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
    add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
    add_filter('image_send_to_editor', 'remove_width_attribute', 10);

    remove_filter('the_excerpt', 'wpautop');

    add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo');
    add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2');

    function my_pagination_rewrite()
    {
        add_rewrite_rule('blog/page/?([0-9]{1,})/?$', 'index.php?category_name=blog&paged=$matches[1]', 'top');
    }
    add_action('init', 'my_pagination_rewrite');

    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title'    => 'Основные настройки',
            'menu_title'    => 'Основные настройки',
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }

    //function add_keywords_meta_tag()
    //{
    //    $keywords = get_field('keywords', get_the_ID());
    //    if ($keywords) {
    //        echo '<meta name="keywords" content="' . esc_attr($keywords) . '" />' . PHP_EOL;
    //    }
    //}
    //add_action('wp_head', 'add_keywords_meta_tag');

    add_filter('do_redirect_guess_404_permalink', '__return_false');

    function breadcrumbs($currentTitle = '', $links = [])
    {
        echo '<ul class="breadcrumb">';
        echo '<li class="breadcrumb-item"><a href="/">Главная</a></li>';
        if (count($links)) {
            foreach ($links as $item) {
                echo '<li class="breadcrumb-item"><a href="' . $item['link'] . '">' . $item['label'] . '</a></li>';
            }
        }
        if ($currentTitle) {
            echo '<li class="breadcrumb-item active">' . $currentTitle . '</li>';
        }
        echo '</ul>';
    }

    function enqueue_custom_acf_tinymce()
    {
        wp_enqueue_script('custom-acf-tinymce', get_template_directory_uri() . '/js/custom-acf-tinymce.js', array('jquery'), '1.0', true);
        wp_localize_script('custom-acf-tinymce', 'customAcfTinymce', array(
            'pluginUrl' => get_template_directory_uri() . '/js/custom-acf-tinymce.js'
        ));
    }
    add_action('acf/input/admin_enqueue_scripts', 'enqueue_custom_acf_tinymce');

    function custom_button_shortcode($atts)
    {
        $atts = shortcode_atts(array('title' => 'Оставить заявку', 'href' => '#'), $atts, 'btn');
        return '<a href="' . esc_url($atts['href']) . '" class="btn">' . esc_html($atts['title']) . '</a>';
    }
    add_shortcode('btn', 'custom_button_shortcode');

    function custom_modal_button_shortcode($atts)
    {
        $atts = shortcode_atts(array('title' => 'Оставить заявку'), $atts, 'btnModal');
        return '<a href="#" data-toggle="modal" data-target="#lead-modal" class="btn">' . esc_html($atts['title']) . '</a>';
    }
    add_shortcode('btnModal', 'custom_modal_button_shortcode');

    function custom_search()
    {
        $search_query = sanitize_text_field($_POST['search_query']);
        $args = array(
            'post_type' => array('post', 'page', 'product', 'service', 'portfolio'),
            's' => $search_query,
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                $title = get_the_title();
                $permalink = get_the_permalink();
                echo '<a href="' . esc_url($permalink) . '" class="search-item">';
                if ($thumbnail) {
                    echo '<img src="' . esc_url($thumbnail) . '" alt="' . esc_attr($title) . '">';
                }
                echo esc_html($title) . '</a>';
            }
        } else {
            echo '<p>Ничего не найдено</p>';
        }
        wp_die();
    }
    add_action('wp_ajax_custom_search', 'custom_search');
    add_action('wp_ajax_nopriv_custom_search', 'custom_search');

    function get_device_repair_data()
    {
        $repair_data = array();
        $categories = get_posts(array(
            'post_type' => 'device',
            'post_parent' => 0,
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ));
        foreach ($categories as $category) {
            $device_slug = get_field('device_slug', $category->ID) ?: sanitize_title($category->post_title);
            $models = get_posts(array(
                'post_type' => 'device',
                'post_parent' => $category->ID,
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ));
            $models_list = array();
            $problems_set = array();
            foreach ($models as $model) {
                $models_list[] = $model->post_title;
                $problems = get_posts(array(
                    'post_type' => 'device',
                    'post_parent' => $model->ID,
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                ));
                foreach ($problems as $problem) {
                    $problems_set[$problem->post_title] = true;
                }
            }
            if (!empty($models_list)) {
                $repair_data[$device_slug] = array(
                    'models' => $models_list,
                    'problems' => array_keys($problems_set),
                );
            }
        }
        return $repair_data;
    }

    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title'    => 'Настройки навигации',
            'menu_title'    => 'Навигация',
            'menu_slug'     => 'header-navigation',
            'capability'    => 'edit_posts',
            'icon_url'      => 'dashicons-menu',
            'position'      => 30
        ));
    }

    function fix_service_flat_permalink($post_link, $post)
    {
        if ('service' !== $post->post_type || 'publish' !== $post->post_status) {
            return $post_link;
        }
        return home_url('/service/' . $post->post_name . '/');
    }

    add_action('init', 'fix_service_rewrite_rules');
    function fix_service_rewrite_rules()
    {
        add_rewrite_rule(
            '^service/([^/]+)/?$',
            'index.php?post_type=service&name=$matches[1]',
            'top'
        );
    }

    add_action('template_redirect', 'fix_service_flat_redirect');
    function fix_service_flat_redirect()
    {
        if (is_singular('service')) {
            global $post;
            $flat_url = home_url('/service/' . $post->post_name . '/');
            $current_url = ((is_ssl() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            if (trailingslashit($current_url) !== trailingslashit($flat_url)) {
                wp_redirect($flat_url, 301);
                exit;
            }
        }
    }

    // Allow CORS for REST API
    add_action('rest_api_init', function () {
        remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
        add_filter('rest_pre_serve_request', function ($value) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Authorization, Content-Type');
            return $value;
        });
    });

    // Claude Proxy Endpoint
    add_action('rest_api_init', function () {
        register_rest_route('claude/v1', '/proxy', array(
            'methods' => array('POST', 'OPTIONS'),
            'callback' => function ($request) {
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: POST, OPTIONS');
                header('Access-Control-Allow-Headers: Content-Type');
                $body = $request->get_json_params();
                $url = isset($body['url']) ? $body['url'] : '';
                $method = isset($body['method']) ? $body['method'] : 'GET';
                $data = isset($body['data']) ? $body['data'] : null;
                $args = array(
                    'method' => $method,
                    'headers' => array(
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Basic ' . base64_encode('admin:br9X pyOW Sx7a eZWC 0v2l zfAJ'),
                    ),
                    'timeout' => 30,
                );
                if ($data) $args['body'] = json_encode($data);
                $response = wp_remote_request($url, $args);
                $code = wp_remote_retrieve_response_code($response);
                $result = json_decode(wp_remote_retrieve_body($response), true);
                return new WP_REST_Response($result, $code);
            },
            'permission_callback' => '__return_true',
        ));
    });

    // Fixibot Options API
    add_action('rest_api_init', function () {
        register_rest_route('fixibot/v1', '/options', array(
            array(
                'methods' => 'GET',
                'callback' => function () {
                    return new WP_REST_Response(array(
                        'phone'    => get_field('phone', 'option'),
                        'schedule' => get_field('schedule', 'option'),
                        'email'    => get_field('email', 'option'),
                        'address'  => get_field('address', 'option'),
                    ), 200);
                },
                'permission_callback' => '__return_true',
            ),
            array(
                'methods' => 'POST',
                'callback' => function ($request) {
                    $data = $request->get_json_params();
                    if (isset($data['phone']))    update_field('phone',    $data['phone'],    'option');
                    if (isset($data['schedule'])) update_field('schedule', $data['schedule'], 'option');
                    if (isset($data['email']))    update_field('email',    $data['email'],    'option');
                    if (isset($data['address']))  update_field('address',  $data['address'],  'option');
                    return new WP_REST_Response(array('success' => true), 200);
                },
                'permission_callback' => function () {
                    return current_user_can('edit_posts');
                },
            ),
        ));
    });

    // ACF REST API — открываем все поля
    add_filter('acf/rest_api/field_settings/show_in_rest', '__return_true');

    // Claude Panel
    add_action('init', function () {
        if (isset($_GET['claude_panel']) && $_GET['claude_panel'] === 'fixibot2026') {
            $base = 'https://fixibot-omsk.ru/wp-json/wp/v2';
            $nonce = wp_create_nonce('wp_rest');
        ?>
            <!DOCTYPE html>
            <html>

            <head>
                <meta charset="utf-8">
                <title>Claude Panel</title>
                <style>
                    body {
                        font-family: sans-serif;
                        max-width: 1100px;
                        margin: 40px auto;
                        padding: 0 20px
                    }

                    input,
                    textarea,
                    select {
                        width: 100%;
                        padding: 8px;
                        margin: 4px 0 12px;
                        box-sizing: border-box;
                        border: 1px solid #ddd;
                        border-radius: 4px
                    }

                    button {
                        padding: 8px 16px;
                        margin-right: 8px;
                        cursor: pointer;
                        background: #0073aa;
                        color: #fff;
                        border: none;
                        border-radius: 4px
                    }

                    button:hover {
                        background: #005a8a
                    }

                    #res {
                        margin-top: 16px;
                        padding: 12px;
                        background: #f5f5f5;
                        border-radius: 4px
                    }

                    .tab {
                        display: none
                    }

                    .tab.active {
                        display: block
                    }

                    .tabs {
                        margin-bottom: 20px
                    }

                    .tabs button {
                        background: #ddd;
                        color: #333
                    }

                    .tabs button.active {
                        background: #0073aa;
                        color: #fff
                    }

                    label {
                        font-weight: bold;
                        display: block;
                        margin-top: 10px
                    }

                    h3 {
                        border-bottom: 2px solid #0073aa;
                        padding-bottom: 5px
                    }
                </style>
            </head>

            <body>
                <h2>Claude Panel — fixibot-omsk.ru</h2>
                <div class="tabs">
                    <button onclick="switchTab('pages')" id="tbtn-pages" class="active">Страницы</button>
                    <button onclick="switchTab('services')" id="tbtn-services">Услуги (ACF)</button>
                    <button onclick="switchTab('options')" id="tbtn-options">Настройки сайта</button>
                </div>

                <!-- СТРАНИЦЫ -->
                <div id="tab-pages" class="tab active">
                    <h3>Страницы</h3>
                    <label>Заголовок</label><input id="ptitle" placeholder="Заголовок страницы">
                    <label>Slug</label><input id="pslug" placeholder="slug">
                    <label>HTML содержимое</label><textarea id="pcontent" rows="6" placeholder="HTML содержимое"></textarea>
                    <select id="pstatus">
                        <option value="draft">Черновик</option>
                        <option value="publish">Опубликовать</option>
                    </select>
                    <button onclick="check()">Проверить</button>
                    <button onclick="loadPages()">Загрузить страницы</button>
                    <button onclick="publishPage()">Опубликовать</button>
                    <div id="plist"></div>
                </div>

                <!-- УСЛУГИ ACF -->
                <div id="tab-services" class="tab">
                    <h3>Услуги (service) + ACF поля</h3>
                    <button onclick="loadServices()" style="margin-bottom:15px">Загрузить услуги</button>
                    <input id="sid" placeholder="ID услуги" style="width:150px;display:inline-block;margin-right:8px">
                    <button onclick="editService(document.getElementById('sid').value)">Открыть по ID</button>
                    <button onclick="newService()" style="margin-bottom:15px;background:#28a745">+ Новая услуга</button>
                    <div id="slist"></div>

                    <div id="service-form" style="display:none">
                        <h3 id="sform-title">Редактировать услугу</h3>
                        <label>Заголовок (title)</label><input id="s_title" placeholder="Название услуги">
                        <label>Slug</label><input id="s_slug" placeholder="slug">
                        <label>Статус</label>
                        <select id="s_status">
                            <option value="draft">Черновик</option>
                            <option value="publish">Опубликовать</option>
                        </select>

                        <h3>Первый экран</h3>
                        <label>h1_sub</label><input id="s_h1_sub">
                        <label>title (h1)</label><input id="s_main_title">
                        <label>sub</label><input id="s_sub">

                        <h3>Цены</h3>
                        <label>prices (JSON)</label>
                        <textarea id="s_prices" rows="6" placeholder='[{"name":"Замена экрана","price":"от 1500 руб."}]'></textarea>

                        <h3>Типовые неисправности</h3>
                        <label>problems_title</label><input id="s_problems_title">
                        <label>problems_text</label><textarea id="s_problems_text" rows="3"></textarea>
                        <label>problems_list (JSON)</label>
                        <textarea id="s_problems_list" rows="4" placeholder='[{"title":"Не включается","text":"Описание"}]'></textarea>

                        <h3>FAQ</h3>
                        <label>faq_title</label><input id="s_faq_title">
                        <label>faq (JSON)</label>
                        <textarea id="s_faq" rows="5" placeholder='[{"question":"Вопрос?","answer":"Ответ."}]'></textarea>

                        <h3>Текстовый блок</h3>
                        <label>text_title</label><input id="s_text_title">
                        <label>text</label><textarea id="s_text" rows="5"></textarea>

                        <h3>Неисправности с иконками</h3>
                        <label>neispravnosti (JSON)</label>
                        <textarea id="s_neispravnosti" rows="4" placeholder='[{"icon":"icon-class","title":"Название","text":"Описание"}]'></textarea>

                        <h3>Yoast SEO</h3>
                        <label>SEO заголовок</label><input id="s_seo_title">
                        <label>Мета-описание</label><textarea id="s_seo_desc" rows="2"></textarea>

                        <input type="hidden" id="s_eid" value="">
                        <br><br>
                        <button onclick="saveService()" style="background:#28a745;font-size:16px;padding:12px 24px">💾 Сохранить услугу</button>
                        <button onclick="document.getElementById('service-form').style.display='none'" style="background:#dc3545">Отмена</button>
                    </div>
                </div>

                <!-- НАСТРОЙКИ САЙТА -->
                <div id="tab-options" class="tab">
                    <h3>Основные настройки сайта</h3>
                    <button onclick="loadOptions()" style="margin-bottom:15px">Загрузить настройки</button>
                    <label>Телефон</label><input id="o_phone" placeholder="+7 (908) 119-13-74">
                    <label>График работы</label><input id="o_schedule" placeholder="Пн-Вс: с 10:00 до 19:00">
                    <label>Email</label><input id="o_email" placeholder="osuhov.maksim@mail.ru">
                    <label>Адрес</label><textarea id="o_address" rows="3" placeholder="ул. 6-я Станционная, 2 к 2"></textarea>
                    <br><br>
                    <button onclick="saveOptions()" style="background:#28a745;font-size:16px;padding:12px 24px">💾 Сохранить настройки</button>
                </div>

                <div id="res">Готов к работе</div>

                <script>
                    const NONCE = '<?php echo $nonce; ?>';
                    const BASE = '<?php echo $base; ?>';

                    function r(h) {
                        document.getElementById('res').innerHTML = h;
                    }

                    function switchTab(name) {
                        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                        document.querySelectorAll('.tabs button').forEach(t => t.classList.remove('active'));
                        document.getElementById('tab-' + name).classList.add('active');
                        document.getElementById('tbtn-' + name).classList.add('active');
                    }

                    async function api(url, method, data) {
                        const o = {
                            method: method || 'GET',
                            headers: {
                                'X-WP-Nonce': NONCE,
                                'Content-Type': 'application/json'
                            }
                        };
                        if (data) o.body = JSON.stringify(data);
                        const res = await fetch(url, o);
                        return res.json();
                    }

                    async function check() {
                        r('Проверяю...');
                        const d = await api(BASE + '/users/me?context=edit');
                        r(d.name ? '✅ Подключено! Пользователь: ' + d.name : '❌ Ошибка: ' + JSON.stringify(d));
                    }

                    async function loadPages() {
                        r('Загружаю...');
                        const p = await api(BASE + '/pages?per_page=20');
                        if (!Array.isArray(p)) {
                            r('Ошибка: ' + JSON.stringify(p));
                            return;
                        }
                        r('Страниц: ' + p.length);
                        document.getElementById('plist').innerHTML = p.map(x => '<div style="border:1px solid #ddd;padding:10px;margin:6px 0;border-radius:4px"><b>' + x.title.rendered + '</b> /' + x.slug + ' (' + x.status + ')<button onclick="sel(' + x.id + ',\'' + encodeURIComponent(x.slug) + '\',\'' + encodeURIComponent(x.title.rendered) + '\')" style="float:right">Выбрать</button></div>').join('');
                    }

                    function sel(id, slug, title) {
                        document.getElementById('pslug').value = decodeURIComponent(slug);
                        document.getElementById('ptitle').value = decodeURIComponent(title);
                        document.getElementById('pslug').dataset.eid = id;
                        r('Выбрана страница ID ' + id);
                    }

                    async function publishPage() {
                        const title = document.getElementById('ptitle').value;
                        const slug = document.getElementById('pslug').value;
                        const content = document.getElementById('pcontent').value;
                        const status = document.getElementById('pstatus').value;
                        const eid = document.getElementById('pslug').dataset.eid;
                        if (!title) {
                            r('Введи заголовок!');
                            return;
                        }
                        r('Публикую...');
                        const body = {
                            title,
                            content,
                            status
                        };
                        if (slug) body.slug = slug;
                        const url = eid ? BASE + '/pages/' + eid : BASE + '/pages';
                        const d = await api(url, eid ? 'PUT' : 'POST', body);
                        r(d.link ? '✅ Готово! <a href="' + d.link + '" target="_blank">' + d.link + '</a>' : 'Ответ: ' + JSON.stringify(d).substring(0, 200));
                    }

                    async function loadServices() {
                        r('Загружаю услуги...');
                        const p = await api(BASE + '/service?per_page=50&status=any');
                        if (!Array.isArray(p)) {
                            r('Ошибка: ' + JSON.stringify(p));
                            return;
                        }
                        r('Услуг: ' + p.length);
                        document.getElementById('slist').innerHTML = p.map(x => '<div style="border:1px solid #ddd;padding:10px;margin:6px 0;border-radius:4px"><b>' + x.title.rendered + '</b> /' + x.slug + ' (' + x.status + ')<button onclick="editService(' + x.id + ')" style="float:right">Редактировать</button></div>').join('');
                    }

                    function newService() {
                        document.getElementById('service-form').style.display = 'block';
                        document.getElementById('sform-title').textContent = 'Новая услуга';
                        ['s_title', 's_slug', 's_h1_sub', 's_main_title', 's_sub', 's_prices', 's_problems_title', 's_problems_text', 's_problems_list', 's_faq_title', 's_faq', 's_text_title', 's_text', 's_neispravnosti', 's_seo_title', 's_seo_desc'].forEach(id => document.getElementById(id).value = '');
                        document.getElementById('s_eid').value = '';
                        document.getElementById('s_status').value = 'draft';
                    }

                    async function editService(id) {
                        r('Загружаю...');
                        const d = await api(BASE + '/service/' + id + '?context=edit');
                        document.getElementById('service-form').style.display = 'block';
                        document.getElementById('sform-title').textContent = 'Редактировать: ' + d.title.rendered;
                        document.getElementById('s_eid').value = id;
                        document.getElementById('s_title').value = d.title.rendered || '';
                        document.getElementById('s_slug').value = d.slug || '';
                        document.getElementById('s_status').value = d.status || 'draft';
                        const acf = d.acf || {};
                        document.getElementById('s_h1_sub').value = acf.h1_sub || '';
                        document.getElementById('s_main_title').value = acf.title || '';
                        document.getElementById('s_sub').value = acf.sub || '';
                        document.getElementById('s_prices').value = acf.prices ? JSON.stringify(acf.prices, null, 2) : '';
                        document.getElementById('s_problems_title').value = acf.problems_title || '';
                        document.getElementById('s_problems_text').value = acf.problems_text || '';
                        document.getElementById('s_problems_list').value = acf.problems_list ? JSON.stringify(acf.problems_list, null, 2) : '';
                        document.getElementById('s_faq_title').value = acf.faq_title || '';
                        document.getElementById('s_faq').value = acf.faq ? JSON.stringify(acf.faq, null, 2) : '';
                        document.getElementById('s_text_title').value = acf.text_title || '';
                        document.getElementById('s_text').value = acf.text || '';
                        document.getElementById('s_neispravnosti').value = acf.neispravnosti ? JSON.stringify(acf.neispravnosti, null, 2) : '';
                        document.getElementById('s_seo_title').value = (d.yoast_head_json && d.yoast_head_json.title) || '';
                        document.getElementById('s_seo_desc').value = (d.yoast_head_json && d.yoast_head_json.description) || '';
                        r('✅ Загружено: ' + d.title.rendered);
                        document.getElementById('service-form').scrollIntoView();
                    }

                    function parseJSON(val) {
                        try {
                            return val ? JSON.parse(val) : '';
                        } catch (e) {
                            return val;
                        }
                    }

                    async function saveService() {
                        const title = document.getElementById('s_title').value;
                        const eid = document.getElementById('s_eid').value;
                        if (!title) {
                            r('❌ Введи заголовок!');
                            return;
                        }
                        r('Сохраняю...');
                        const body = {
                            title,
                            slug: document.getElementById('s_slug').value,
                            status: document.getElementById('s_status').value,
                            acf: {
                                h1_sub: document.getElementById('s_h1_sub').value,
                                title: document.getElementById('s_main_title').value,
                                sub: document.getElementById('s_sub').value,
                                prices: parseJSON(document.getElementById('s_prices').value),
                                problems_title: document.getElementById('s_problems_title').value,
                                problems_text: document.getElementById('s_problems_text').value,
                                problems_list: parseJSON(document.getElementById('s_problems_list').value),
                                faq_title: document.getElementById('s_faq_title').value,
                                faq: parseJSON(document.getElementById('s_faq').value),
                                text_title: document.getElementById('s_text_title').value,
                                text: document.getElementById('s_text').value,
                                neispravnosti: parseJSON(document.getElementById('s_neispravnosti').value)
                            },
                            meta: {
                                _yoast_wpseo_title: document.getElementById('s_seo_title').value,
                                _yoast_wpseo_metadesc: document.getElementById('s_seo_desc').value
                            }
                        };
                        const url = eid ? BASE + '/service/' + eid : BASE + '/service';
                        const d = await api(url, eid ? 'PUT' : 'POST', body);
                        r(d.link ? '✅ Готово! <a href="' + d.link + '" target="_blank">' + d.link + '</a>' : 'Ответ: ' + JSON.stringify(d).substring(0, 300));
                    }

                    async function loadOptions() {
                        r('Загружаю настройки...');
                        const d = await fetch('/wp-json/fixibot/v1/options', {
                            headers: {
                                'X-WP-Nonce': NONCE
                            }
                        }).then(r => r.json());
                        document.getElementById('o_phone').value = d.phone || '';
                        document.getElementById('o_schedule').value = d.schedule || '';
                        document.getElementById('o_email').value = d.email || '';
                        document.getElementById('o_address').value = d.address || '';
                        r('✅ Настройки загружены!');
                    }

                    async function saveOptions() {
                        r('Сохраняю...');
                        const data = {
                            phone: document.getElementById('o_phone').value,
                            schedule: document.getElementById('o_schedule').value,
                            email: document.getElementById('o_email').value,
                            address: document.getElementById('o_address').value
                        };
                        const d = await fetch('/wp-json/fixibot/v1/options', {
                            method: 'POST',
                            headers: {
                                'X-WP-Nonce': NONCE,
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(data)
                        }).then(r => r.json());
                        r(d.success ? '✅ Сохранено!' : '❌ Ошибка: ' + JSON.stringify(d));
                    }
                </script>
            </body>

            </html><?php
                    exit;
                }
            });

            // REST: очистка кэша (добавлено автоматически)
            add_action('rest_api_init', function () {
                register_rest_route('fixibot/v1', '/clear-cache', array(
                    'methods'  => 'POST',
                    'callback' => function () {
                        if (function_exists('wpfc_clear_all_cache')) wpfc_clear_all_cache();
                        if (function_exists('rocket_clean_domain')) rocket_clean_domain();
                        $dir = WP_CONTENT_DIR . '/cache/all/';
                        if (is_dir($dir)) {
                            $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
                            foreach ($it as $f) {
                                if ($f->isFile()) @unlink($f->getPathname());
                            }
                        }
                        return array('cleared' => true, 'time' => current_time('mysql'));
                    },
                    'permission_callback' => function () {
                        return current_user_can('manage_options');
                    }
                ));
            });

            //Отображение текущего шаблона
            add_filter('template_include', 'var_template_include', 1000);
            function var_template_include($t)
            {
                $GLOBALS['current_theme_template'] = basename($t);
                return $t;
            }

            function get_current_template($echo = false)
            {

                if (!isset($GLOBALS['current_theme_template']))
                    return false;
                if ($echo)
                    echo $GLOBALS['current_theme_template'];
                else
                    return $GLOBALS['current_theme_template'];
            }
