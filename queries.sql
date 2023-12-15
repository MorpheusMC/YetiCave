INSERT INTO categories (character_code, name_category)
VALUES ('boards', 'Доски и лыжи'),
       ('attachment', 'Крепления'),
       ('boots', 'Ботинки'),
       ('clothing', 'Одежда'),
       ('tools', 'Инструменты'),
       ('other', 'Разное');

INSERT INTO users(email, user_name, user_password, contacts)
VALUES ('info@darkfoils.ru', 'Фарид', 'pass3', '89091111112'),
       ('1@1.ru', 'Вася', 'pass1', '89091111111'),
       ('2@2.ru', 'Петя', 'pass2', '89092222222');

INSERT INTO lots(title, lot_description, img, start_price, date_finish, step, user_id, category_id)
VALUES ('Гидрофойл Даркфойлс',
        'Быстрый и красивый',
        'img/lot-7.jpg',
        58000,
        '2023-11-15',
        1000,
        3,
        6),
       ('2014 Rossignol District Snowboard',
        'Отличный борд',
        'img/lot-1.jpg',
        10999,
        '2023-11-07',
        100,
        1,
        1),
       ('DC Ply Mens 2016/2017 Snowboard',
        'Еще один борд',
        'img/lot-2.jpg',
        159999,
        '2023-11-08',
        200,
        1,
        1),
       ('Крепления Union Contact Pro 2015 года размер L/XL',
        'Классные крепы',
        'img/lot-3.jpg',
        8000,
        '2023-11-09',
        300,
        2,
        2),
       ('Ботинки для сноуборда DC Mutiny Charocal',
        'Еще одни боты',
        'img/lot-4.jpg',
        10999,
        '2023-11-10',
        400,
        2,
        3),
       ('Куртка для сноуборда DC Mutiny Charocal',
        'Крутая куртка',
        'img/lot-5.jpg',
        7500,
        '2023-11-06',
        500,
        1,
        4),
       ('Маска Oakley Canopy',
        'Бу маска',
        'img/lot-6.jpg',
        5400,
        '2023-11-05',
        600,
        2,
        6);

INSERT INTO bets(price_bet, user_id, lot_id)
VALUES (8500, 1, 4),
       (9000, 1, 4);

-- получить все категории
SELECT name_category AS 'Категории'
FROM categories;

-- получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории;
SELECT l.title, l.start_price, l.img, c.name_category
FROM lots l
         JOIN categories c on c.id = l.category_id;

-- показать лот по его ID. Получите также название категории, к которой принадлежит лот;
SELECT l.id,
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
WHERE l.id = 4;

-- обновить название лота по его идентификатору;
UPDATE lots
SET title='Ботинки обычные'
WHERE id = 4;

-- получить список ставок для лота по его идентификатору с сортировкой по дате.
SELECT b.date_bet, b.price_bet, l.title, u.user_name
FROM bets b
         JOIN lots l on l.id = b.lot_id
         JOIN users u on u.id = b.user_id
WHERE l.id = 4
ORDER BY b.date_bet DESC;