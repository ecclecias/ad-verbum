<?php

function createFloatButton()
{
    $f_left = file_get_contents(plugin_dir_path(__FILE__) . '../template/float-arrow-left.html');
    $f_right = file_get_contents(plugin_dir_path(__FILE__) . '../template/float-arrow-right.html');

    return $f_left . $f_right;
}

function createVerse($verse_number, $verse, $id, $chapter)
{
    $_e = file_get_contents(plugin_dir_path(__FILE__) . '../template/wrapper-verse.html');

    $_e = str_replace("{verse_number}", $verse_number ? $verse_number : "", $_e);
    $_e = str_replace("{verse}", $verse ? $verse : "", $_e);
    $_e = str_replace("{id}", $id ? $id : "", $_e);
    $_e = str_replace("{span_class}", $chapter ? $chapter : "", $_e);

    return $_e;
}

function createButton($id, $class, $name, $type = "button")
{
    $_e = file_get_contents(plugin_dir_path(__FILE__) . '../template/button.html');

    $_e = str_replace("{id}", $id ? $id : "", $_e);
    $_e = str_replace("{class}", $class ? $class : "", $_e);
    $_e = str_replace("{name}", $name ? $name : "", $_e);
    $_e = str_replace("{type}", $type ? $type : "", $_e);

    return $_e;
}

function createWrapperElement($content, $class = "wrapper")
{
    $_e = file_get_contents(plugin_dir_path(__FILE__) . '../template/wrapper.html');

    $_e = str_replace("{content}", $content ? $content : "", $_e);
    $_e = str_replace("{class}", $class ? $class : "", $_e);

    return $_e;
}

function createBibleElement($bible)
{
    $book_buttons = "";
    $chapter_wrappers = "";
    $verse_wrappers = "";

    $bible_fields =  get_post_meta($bible->ID);
    $bible_json = json_decode($bible_fields['bible_json'][0], true);

    $abbrev = strtolower($bible_fields['abbrev'][0]);

    foreach (($bible_json ?? []) as $translation) {
        $book_id = $translation['abbrev'];

        $chapter_button = "";

        $book_buttons .= createButton($book_id, $abbrev, $translation['name'], "book");

        foreach (($translation['chapters'] ?? []) as $k_chapter => $chapter) {
            $current_chapter = $k_chapter + 1;
            $chapter_id = $translation['abbrev'] . '_' . $current_chapter;

            $verse_number = 1;
            $verse_spans = "";

            $chapter_button .= createButton($chapter_id, $book_id, $current_chapter, "chapter");

            foreach (($chapter ?? []) as $verses) {
                $verse_id = $chapter_id . '_' . $verse_number;

                $verse_spans .= createVerse($verse_number, $verses, $verse_id, $chapter_id);

                $verse_number++;
            }

            $verse_wrappers .= createWrapperElement($verse_spans, $chapter_id . ' d-none');
        }

        $chapter_wrappers .= createWrapperElement($chapter_button, $book_id . ' d-none');
    }

    $t_book = createWrapperElement($book_buttons, "wrapper-books");
    $t_chapter = createWrapperElement($chapter_wrappers, "wrapper-chapters");
    $t_verse = createWrapperElement($verse_wrappers, "wrapper-verses");

    $content = $t_book;
    $content .= $t_chapter;
    $content .= $t_verse;

    return createWrapperElement($content, "ecclesias-bible");
}
