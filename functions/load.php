<?php

/**
 * functionsディレクトリ内のファイルを読み込む
 * テーマ直下のfunctions.phpではこのファイルだけ読み込むようにする
 * functionsディレクトリ内にファイルを追加した場合はここで読み込む
 */

//  デバッグ用フラグ
define('FLG_DEBUG_FUNCTIONS', false);

call_php_Files_for_functions(MY_SNOW_MONKEY_PATH . "/functions");

function call_php_Files_for_functions($dir)
{
    $files = glob(rtrim($dir, '/') . '/*');

    foreach ($files as $file) {
        if (is_file($file)) {
            $filetype = pathinfo($file, PATHINFO_EXTENSION);
            if ($filetype === 'php') {
                if (strpos($file, '_') === 0) {
                    // _から始まるファイルは読み込まない
                    continue;
                }

                // デバッグ用
                // 特定のファイルを読み込まないための処理
                if (FLG_DEBUG_FUNCTIONS) {
                    var_dump($file);
                    if (strpos($file, 'ar_profile_edit') !== false) {
                        continue;
                    }
                }
                require_once $file;
            }
        }

        if (is_dir($file)) {
            call_php_Files_for_functions($file);
        }
    }

    if (FLG_DEBUG_FUNCTIONS) var_dump($list);
}
