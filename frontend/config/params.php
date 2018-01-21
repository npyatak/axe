<?php
return [
    'adminEmail' => 'axe@promo-group.org',
    'share' => [
    	'title_fb' => 'Открой для себя мир киберспорта вместе с AXE',
	    'title_vk' => 'Открой для себя мир киберспорта вместе с AXE',
	    'text' => 'Участвуйте в конкурсах и выигрывайте призы: PlayStation 4 Slim, Xbox One S, игровые мыши и подарочные наборы AXE.',
	    'image_fb' => '/img/fb.jpg',
	    'image_vk' => '/img/vk_new1.jpg',
    ],
    'shareChallenge' => [
    	'title_fb' => 'Проголосуйте за лучший игровой момент в Челлендже AXE',
	    'title_vk' => 'Проголосуйте за лучший игровой момент в Челлендже AXE',
	    'text' => 'Участвуйте и выигрывайте призы: PlayStation 4 Slim и подарочные наборы AXE.',
	    'image_fb' => '/img/fb_ch.jpg',
	    'image_vk' => '/img/vk_ch.jpg',
    ],
    'videos' => [
        1 => ['src' => 'https://www.youtube.com/embed/UpVFUFwBzl0', 'sub_title' => 'Выпуск 1', 'title' => 'Открой мир киберспорта с AXE и Любовью Киберспортивной', 'img' => '/img/vdo2.jpg'],
        2 => ['src' => 'https://www.youtube.com/embed/udx9F89_q4E', 'sub_title' => 'Выпуск 2', 'title' => 'Открой мир киберспорта с AXE и Любовью Киберспортивной', 'img' => '/img/vdo_v2.jpg'],
        3 => ['src' => 'https://www.youtube.com/embed/hct3ON6faYE', 'sub_title' => 'Выпуск 3', 'title' => 'Открой мир киберспорта с AXE и Любовью Киберспортивной', 'img' => '/img/vdo_v3.jpg'],
        4 => ['src' => 'https://www.youtube.com/embed/emhhF5u8Ggg', 'sub_title' => 'Выпуск 4', 'title' => 'Открой мир киберспорта с AXE и Любовью Киберспортивной', 'img' => '/img/vdo_v4.jpg'],
        
    ], 
    'mainPageVideoId' => 4,

    'clickbattle' => [
        'endGameTime' => 60000,
        //ограничение игры по времени 120 сек.
        'delayInterval' => 1000,
        //это время в миллисекундах от момента появления одной картинки, до её пропадания
        'targetLifeDurationInterval' => 1000,
        //это время от момента пропадания картинки до появления новой.
        'radius' => 20,
        //это радиус круга в пикселах в который и нужно попадать на png-картинке “враге”, которая сама по себе 70-70.
        'halfImageWidth' => 35,
    ],

    'shooting' => [
        'timeGame' => 12000,//время игры
        'timeLifeWarrior' => 1000,//время отображения warrior
        'timeBeforeShowWarrior' => 500,//время перед отображением следующего warrior
        'timeAnimationShowWarrior' => 200,//время анимации появления warrior
        'timeAnimationHideWarrior' => 200,//время анимации скрытия warrior
        'pointsPlus' => 10,//очков за верный выстрел
        'pointsMinus' => -10,//очков за не верный выстрел
    ]

];
