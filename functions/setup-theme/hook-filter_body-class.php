<?php

/**
 * ページのスラッグをbodyタグのclassに付与する
 */
add_filter(
    'body_class',
    function ($classes) {
        if (is_page()) {
            $page = get_post();
            $classes[] = $page->post_name;
        } else if (is_singular(array('transport', 'equipment', 'studies', 'product', 'buffered', 'contract', 'handling'))) {
            $classes[] = 'dainichi-manufactured-detail';
        }
        return $classes;
    }
);
