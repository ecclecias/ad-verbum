<?php

function register_bible_post_type()
{
    $labels = array(
        'name' => 'Bíblias',
        'singular_name' => 'Bíblia',
        'menu_name' => 'Bíblia',
        'add_new' => 'Adicionar Tradução',
        'add_new_item' => 'Adicionar Nova Tradução',
        'edit_item' => 'Editar Bíblia',
        'new_item' => 'Nova Tradução',
        'view_item' => 'Ver Tradução',
        'search_items' => 'Buscar Bíblia',
        'not_found' => 'Nenhuma Tradução',
        'not_found_in_trash' => 'Nenhuma Tradução',
        'parent_item_colon' => '',
        'all_items' => 'Todos as Traduções',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'bible'),
        'supports' => array('title', 'editor'),
    );

    register_post_type('bible', $args);
}

add_action('init', 'register_bible_post_type');