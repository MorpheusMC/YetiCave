<?php
function price_format($price)
{
    $price = ceil($price);
    if ($price > 1000) {
        $price = number_format($price, 0, '', ' ');
    }
    return $price . " " . "₽";
}

function get_dt_range($date)
{
    date_default_timezone_set('asia/novosibirsk');
    $finish_date = date_create($date);
    $cur_date = date_create();

    $diff_date = date_diff($finish_date, $cur_date);
    $format_diff = date_interval_format($diff_date, "%d %H %I");
    $arr = explode(" ", $format_diff);

    $hours = $arr[0] * 24 + $arr[1];
    $minutes = intval($arr[2]);

    $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
    $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

    $res[] = $hours;
    $res[] = $minutes;

    return $res;
}

/**
 * Формирует SQL-запрос для получения списка новых лотов от определенной даты, с сортировкой
 * @return string SQL-запрос
 */
function get_query_list_lots()
{
    return "SELECT l.id,
       l.date_creation,
       l.title,
       l.lot_description,
       l.start_price,
       l.img,
       l.date_finish,
       l.step,
       c.name_category
FROM lots l
         JOIN categories c on c.id = l.category_id
WHERE l.date_finish < NOW() ORDER BY date_creation DESC ";
}

//function get_query_list_lots ($date) {
//    return "SELECT lots.id, lots.title, lots.start_price, lots.img, lots.date_finish, categories.name_category FROM lots
//    JOIN categories ON lots.category_id=categories.id
//    WHERE date_creation > $date ORDER BY date_creation DESC;";
//}

function get_categories($con)
{
    if (!$con) {
        $error = mysqli_connect_error();
//        return $error;
    } else {
        $sql = "SELECT id, character_code, name_category FROM categories";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $categories = get_arrow($result);
            return $categories;
        } else {
            $error = mysqli_error($con);
            return $error;
        }
    }
}

/**
 * Формирует запрос для показа лота на странице lot.php
 * @param integer $id_lot id лота
 * @return string запрос
 */
function get_query_lot($id_lot)
{
    return "SELECT l.id,
       l.date_creation,
       l.title,
       l.lot_description,
       l.start_price,
       l.img,
       l.date_finish,
       l.step,
       c.name_category
    FROM lots l
         JOIN categories c on c.id = l.category_id
    WHERE l.id = $id_lot";
}

function get_arrow($result_query)
{
    $row = mysqli_num_rows($result_query);
    if ($row === 1) {
        $arrow = mysqli_fetch_assoc($result_query);
        return $arrow;
    } elseif ($row > 1) {
        $arrow = mysqli_fetch_all($result_query, MYSQLI_ASSOC);
        return $arrow;
    }
}

/**
 * Валидирует поле категории, если такой категории нет в списке
 * возвращает сообщение об этом
 * @param int $id категория, которую ввел пользователь в форму
 * @param array $allowed_list Список существующих категорий
 * @return string Текст сообщения об ошибке
 */
function validate_category($id, $allowed_list)
{
    if (!in_array($id, $allowed_list)) {
        return "Указана несуществующая категория";
    }
}

///**
// * @param ?string|null $num
// * @return string|null
// */
function validate_number($num)
{
    if (!empty($num)) {
        $num *= 1; //преобразуем строку в числовой тип
        if (is_int($num) && $num > 0) {
            return NULL; //ошибок нет - возвращаем Null
        }
        return "Содержимое поля должно быть целым числом больше ноля";
    }
}

function validate_date($date)
{
    if (is_date_valid($date)) {
        $now = date_create("now");
        $d = date_create($date);
        $diff = date_diff($d, $now);
        $interval = date_interval_format($diff, "%d");

        if ($interval < 1) {
            return "Дата должна быть больше текущей не менее чем на 1 день";
        };
    } else {
        return "Содержимое поля дата завершения должно быть датой в формате ГГГГ-ММ-ДД";
    }
}


/**
 * Формирует запрос для создания нового лота
 * @param integer $user_id id пользователя
 * @return string запрос
 */
function get_query_create_lot($user_id)
{
    return "INSERT INTO lots (title, category_id, lot_description, start_price, step, date_finish, img, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, $user_id);
";
}