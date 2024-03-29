<?php

// Advanced Custom Fields
function add_bible_custom_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_65fc5528bd699',
        'title' => 'Bíblia',
        'fields' => array(
            array(
                'key' => 'field_65fc5529be1cc',
                'label' => 'Sigla',
                'name' => 'abbrev',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Exemplos: NVI para Nova Versão Internacional, NVT para Nova Versão Transformadora ou NTLH para Nova Tradução da Linguagem de Hoje.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => 4,
                'placeholder' => 'ARC',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_65fc5618be1cd',
                'label' => 'Tradução',
                'name' => 'bible_json',
                'aria-label' => '',
                'type' => 'acfe_code_editor',
                'instructions' => 'Insira o JSON da Tradução da Bíblia no formato especificado.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '[
    {
        "abbrev": "gn",
        "name": "Gênesis",
        "chapters": [
            ["Versículo 1:1", "Versículo 1:2"],
            ["Versículo 2:1", "Versículo 3:2"]
        ]
    }
]',
                'mode' => 'application/x-json',
                'lines' => 1,
                'indent_unit' => 4,
                'maxlength' => '',
                'rows' => 4,
                'max_rows' => 33,
                'return_format' => array(),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'bible',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'permalink',
            1 => 'block_editor',
            2 => 'discussion',
            3 => 'comments',
            4 => 'revisions',
            5 => 'slug',
            6 => 'author',
            7 => 'format',
            8 => 'page_attributes',
            9 => 'categories',
            10 => 'tags',
            11 => 'send-trackbacks',
        ),
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
        'acfe_display_title' => '',
        'acfe_autosync' => '',
        'acfe_form' => 0,
        'acfe_meta' => '',
        'acfe_note' => '',
    ));
}

add_action('acf/include_fields', 'add_bible_custom_fields');
