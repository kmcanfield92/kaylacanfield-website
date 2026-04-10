<?php
/**
 * Kayla Canfield Theme — functions.php
 * WordPress theme setup, enqueue, CPTs, SEO, and customizer.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ── THEME SETUP ─────────────────────────────────────────── */
function kc_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );

    register_nav_menus( [
        'primary'  => __( 'Primary Navigation', 'kayla-canfield' ),
        'footer'   => __( 'Footer Navigation', 'kayla-canfield' ),
        'social'   => __( 'Social Links', 'kayla-canfield' ),
    ] );

    add_image_size( 'kc-portrait',  900, 1100, true );
    add_image_size( 'kc-card',      800, 450,  true );
    add_image_size( 'kc-thumb',     400, 300,  true );
    add_image_size( 'kc-wide',     1200, 600,  true );
}
add_action( 'after_setup_theme', 'kc_theme_setup' );

/* ── ENQUEUE STYLES & SCRIPTS ────────────────────────────── */
function kc_enqueue_assets() {
    $v = wp_get_theme()->get( 'Version' );

    // Google Fonts
    wp_enqueue_style(
        'kc-google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Lora:ital,wght@0,400;0,500;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap',
        [], null
    );

    // Main stylesheet
    wp_enqueue_style( 'kc-main', get_template_directory_uri() . '/assets/css/main.css', [ 'kc-google-fonts' ], $v );

    // Page-specific styles
    if ( is_front_page() )  wp_enqueue_style( 'kc-home',    get_template_directory_uri() . '/assets/css/home.css',    [ 'kc-main' ], $v );
    if ( is_page( 'about' ) ) wp_enqueue_style( 'kc-about', get_template_directory_uri() . '/assets/css/about.css',   [ 'kc-main' ], $v );
    if ( is_post_type_archive( 'project' ) || is_singular( 'project' ) )
        wp_enqueue_style( 'kc-work',  get_template_directory_uri() . '/assets/css/work.css',    [ 'kc-main' ], $v );
    if ( is_post_type_archive( 'writing' ) || is_singular( 'writing' ) )
        wp_enqueue_style( 'kc-writing', get_template_directory_uri() . '/assets/css/writing.css', [ 'kc-main' ], $v );
    if ( is_home() || is_single() )
        wp_enqueue_style( 'kc-blog',  get_template_directory_uri() . '/assets/css/blog.css',    [ 'kc-main' ], $v );
    if ( is_page( 'contact' ) )
        wp_enqueue_style( 'kc-contact', get_template_directory_uri() . '/assets/css/contact.css', [ 'kc-main' ], $v );

    // Main JS
    wp_enqueue_script( 'kc-main', get_template_directory_uri() . '/assets/js/main.js', [], $v, true );

    // Localize for AJAX contact form
    wp_localize_script( 'kc-main', 'kcData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'kc_contact_nonce' ),
    ] );

    // Comment reply script
    if ( is_singular() && comments_open() ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'kc_enqueue_assets' );

/* ── CUSTOM POST TYPES ───────────────────────────────────── */
function kc_register_post_types() {

    // Projects (Portfolio)
    register_post_type( 'project', [
        'labels' => [
            'name'               => __( 'Projects', 'kayla-canfield' ),
            'singular_name'      => __( 'Project', 'kayla-canfield' ),
            'add_new'            => __( 'Add New Project', 'kayla-canfield' ),
            'add_new_item'       => __( 'Add New Project', 'kayla-canfield' ),
            'edit_item'          => __( 'Edit Project', 'kayla-canfield' ),
            'new_item'           => __( 'New Project', 'kayla-canfield' ),
            'view_item'          => __( 'View Project', 'kayla-canfield' ),
            'search_items'       => __( 'Search Projects', 'kayla-canfield' ),
            'not_found'          => __( 'No projects found', 'kayla-canfield' ),
            'not_found_in_trash' => __( 'No projects found in trash', 'kayla-canfield' ),
            'menu_name'          => __( 'Work', 'kayla-canfield' ),
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => [ 'slug' => 'work' ],
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ],
        'menu_icon'          => 'dashicons-portfolio',
        'show_in_rest'       => true,
        'menu_position'      => 5,
    ] );

    // Writing pieces
    register_post_type( 'writing', [
        'labels' => [
            'name'               => __( 'Writing', 'kayla-canfield' ),
            'singular_name'      => __( 'Writing Piece', 'kayla-canfield' ),
            'add_new'            => __( 'Add New Piece', 'kayla-canfield' ),
            'add_new_item'       => __( 'Add New Writing Piece', 'kayla-canfield' ),
            'edit_item'          => __( 'Edit Writing Piece', 'kayla-canfield' ),
            'menu_name'          => __( 'Writing', 'kayla-canfield' ),
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => [ 'slug' => 'writing' ],
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ],
        'menu_icon'          => 'dashicons-edit',
        'show_in_rest'       => true,
        'menu_position'      => 6,
    ] );
}
add_action( 'init', 'kc_register_post_types' );

/* ── CUSTOM TAXONOMIES ───────────────────────────────────── */
function kc_register_taxonomies() {

    // Project categories
    register_taxonomy( 'project_category', 'project', [
        'labels' => [
            'name'          => __( 'Project Categories', 'kayla-canfield' ),
            'singular_name' => __( 'Project Category', 'kayla-canfield' ),
            'menu_name'     => __( 'Categories', 'kayla-canfield' ),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'rewrite'           => [ 'slug' => 'work-category' ],
        'show_in_rest'      => true,
    ] );

    // Writing categories
    register_taxonomy( 'writing_category', 'writing', [
        'labels' => [
            'name'          => __( 'Writing Categories', 'kayla-canfield' ),
            'singular_name' => __( 'Writing Category', 'kayla-canfield' ),
            'menu_name'     => __( 'Categories', 'kayla-canfield' ),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'rewrite'           => [ 'slug' => 'writing-category' ],
        'show_in_rest'      => true,
    ] );

    // Skills / Tools taxonomy (shared)
    register_taxonomy( 'skill', [ 'project', 'writing' ], [
        'labels' => [
            'name'          => __( 'Skills & Tools', 'kayla-canfield' ),
            'singular_name' => __( 'Skill', 'kayla-canfield' ),
            'menu_name'     => __( 'Skills', 'kayla-canfield' ),
        ],
        'hierarchical'  => false,
        'public'        => true,
        'rewrite'       => [ 'slug' => 'skill' ],
        'show_in_rest'  => true,
    ] );
}
add_action( 'init', 'kc_register_taxonomies' );

/* ── CUSTOMIZER ──────────────────────────────────────────── */
function kc_customizer_settings( $wp_customize ) {

    // Section: Contact & Social
    $wp_customize->add_section( 'kc_contact', [
        'title'    => __( 'Contact & Social', 'kayla-canfield' ),
        'priority' => 30,
    ] );

    $contact_settings = [
        'kc_email'    => [ 'label' => 'Email Address',   'default' => 'k.m.canfield@msmary.edu' ],
        'kc_linkedin' => [ 'label' => 'LinkedIn URL',    'default' => 'https://linkedin.com/in/kaylacanfield' ],
        'kc_cv_url'   => [ 'label' => 'CV PDF URL',      'default' => '' ],
        'kc_resume_url' => [ 'label' => 'Resume PDF URL', 'default' => '' ],
    ];

    foreach ( $contact_settings as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ] );
        $wp_customize->add_control( $id, [
            'label'   => __( $args['label'], 'kayla-canfield' ),
            'section' => 'kc_contact',
            'type'    => 'text',
        ] );
    }

    // Section: Site Identity extras
    $wp_customize->add_setting( 'kc_tagline_display', [
        'default'           => 'Instructional Designer · Writer · Researcher',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'kc_tagline_display', [
        'label'   => __( 'Header Tagline', 'kayla-canfield' ),
        'section' => 'title_tagline',
        'type'    => 'text',
    ] );
}
add_action( 'customize_register', 'kc_customizer_settings' );

/* ── SEO META TAGS ───────────────────────────────────────── */
function kc_seo_meta() {
    if ( is_singular() ) {
        global $post;
        $desc = get_the_excerpt( $post );
        if ( $desc ) {
            echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $desc ) ) . '" />' . "\n";
        }
        echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
        if ( has_post_thumbnail() ) {
            echo '<meta property="og:image" content="' . esc_url( get_the_post_thumbnail_url( null, 'kc-wide' ) ) . '" />' . "\n";
        }
    } elseif ( is_front_page() ) {
        echo '<meta name="description" content="Kayla Canfield is an instructional designer, writer, and researcher. She designs learning materials, workplace systems, and academic writing projects for education and the humanities." />' . "\n";
        echo '<meta property="og:title" content="Kayla Canfield — Instructional Designer &amp; Writer" />' . "\n";
        echo '<meta property="og:type" content="website" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url( home_url() ) . '" />' . "\n";
    }
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
}
add_action( 'wp_head', 'kc_seo_meta' );

/* ── SCHEMA.ORG JSON-LD ──────────────────────────────────── */
function kc_schema_jsonld() {
    if ( is_front_page() ) {
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Person',
            'name'        => 'Kayla Canfield',
            'url'         => home_url(),
            'jobTitle'    => 'Instructional Designer',
            'description' => 'Instructional designer, writer, and researcher specializing in education and the humanities.',
            'alumniOf'    => 'Mount St. Mary\'s University',
            'knowsAbout'  => [ 'Instructional Design', 'Educational Technology', 'Digital Humanities', 'American Literature', 'Higher Education' ],
            'sameAs'      => [ get_theme_mod( 'kc_linkedin', 'https://linkedin.com/in/kaylacanfield' ) ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'kc_schema_jsonld' );

/* ── AJAX CONTACT FORM ───────────────────────────────────── */
function kc_handle_contact_form() {
    check_ajax_referer( 'kc_contact_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name'] ?? '' );
    $email   = sanitize_email( $_POST['email'] ?? '' );
    $subject = sanitize_text_field( $_POST['subject'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( ! $name || ! is_email( $email ) || ! $message ) {
        wp_send_json_error( [ 'message' => 'Please fill in all required fields.' ] );
    }

    $to      = get_theme_mod( 'kc_email', get_option( 'admin_email' ) );
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>" ];
    $body    = "Name: {$name}\nEmail: {$email}\nSubject: {$subject}\n\n{$message}";

    $sent = wp_mail( $to, "Portfolio Contact: {$subject}", $body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => 'Message sent. I will be in touch within a few days.' ] );
    } else {
        wp_send_json_error( [ 'message' => 'There was a problem sending your message. Please try emailing directly.' ] );
    }
}
add_action( 'wp_ajax_kc_contact', 'kc_handle_contact_form' );
add_action( 'wp_ajax_nopriv_kc_contact', 'kc_handle_contact_form' );

/* ── EXCERPT LENGTH ──────────────────────────────────────── */
function kc_excerpt_length( $length ) { return 30; }
add_filter( 'excerpt_length', 'kc_excerpt_length' );

function kc_excerpt_more( $more ) { return '&hellip;'; }
add_filter( 'excerpt_more', 'kc_excerpt_more' );

/* ── BODY CLASSES ────────────────────────────────────────── */
function kc_body_classes( $classes ) {
    if ( is_singular() ) $classes[] = 'singular';
    if ( is_front_page() ) $classes[] = 'home-page';
    return $classes;
}
add_filter( 'body_class', 'kc_body_classes' );

/* ── REMOVE EMOJI SCRIPTS (PERFORMANCE) ─────────────────── */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
