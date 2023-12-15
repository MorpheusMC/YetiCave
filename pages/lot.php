<?php

/**
 * @var $is_auth
 */
require_once("../helpers.php");
require_once("../functions.php");
require_once("../data.php");
require_once("../init.php");

$categories = get_categories($con);

$page_404 = include_template("404.php", [
    'categories' => $categories
]);

//foreach ($categories as $category => $item){
//    print ($item['character_code']);
//}
//die();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if ($id) {
    $sql = get_query_lot($id);
} else {
    print ($page_404);
    die();
}

//print ('тут');
//
//die();
$res = mysqli_query($con, $sql);
if ($res) {
    $lot = get_arrow($res);
} else {
    $error = mysqli_error($con);
}

if (!$lot) {
    print ($page_404);
    die();
}
//print ($lot['title']);
//print ($id);
//print ('тут');
//die();
$page_content = include_template("main-lot.php", [
    "categories" => $categories,
    "lot" => $lot
]);

$layout_content = include_template("layout-lot.php", [
    "title" => $lot['title'],
    "content" => $page_content,
    "categories" => $categories,
    "is_auth" => $is_auth,
    "user_name" => $user_name
]);

print ($layout_content);

//print ($page_content);
//foreach ($categories as $category) {
//    print ($category['name_category']);
//}
//print ($lot['title']);
//print ('тут');
//die();