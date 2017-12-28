<?php
use yii\helpers\Url;

$this->registerCssFile(Url::toRoute('css/main_clicker.css'));
$this->registerJsFile('/js/phaser.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="clickbattle_page">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="main_title">
                    <h2><b><strong>Кликбатл</strong></b></h2>
                </div>
                <div class="clickbattle_game_wrapper">
                    <!-- block -->
                    <div class="cb_game_table" id="cb_game_table1" style="background: url(/img/bg_game.jpg) center no-repeat; background-size: cover;">
                        <div class="cb_game_cell">
                            <div class="enemy_blocks">
                                <h4>Выберите «врага» для тренировки</h4>
                                <!-- block -->
                                <div class="enemy_block">
                                    <div class="enemy_block_img">
                                        <img src="/img/tank.png" alt="img">
                                    </div>
                                    <a onclick="openBeginWindow('tank')" class="enemy_block_button transition">Выбрать</a>
                                </div>
                                <!-- /block -->
                                <!-- block -->
                                <div class="enemy_block">
                                    <div class="enemy_block_img">
                                        <img src="/img/axe.png" alt="img">
                                    </div>
                                    <a onclick="openBeginWindow('axe')" class="enemy_block_button transition">Выбрать</a>
                                </div>
                                <!-- /block -->
                                <!-- block -->
                                <div class="enemy_block">
                                    <div class="enemy_block_img">
                                        <img src="/img/monster.png" alt="img">
                                    </div>
                                    <a onclick="openBeginWindow('monster')" class="enemy_block_button transition">Выбрать</a>
                                </div>
                                <!-- /block -->
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cb_game_table" id="cb_game_table2" style="background: url(/img/bg_game.jpg) center no-repeat; background-size: cover;">
                        <div class="cb_game_cell">
                            <a onclick="loadGame()" class="transition start_bame_btn">Нажмите чтобы начать</a>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="game_block" id="game_block" style="background: url(/img/space.jpg) center no-repeat; background-size: cover;">
                        <!--<div class="bame_el game_el1" style="top: 290px; left:  107px;"><img src="/img/gl1.png" alt="img"></div>
                        <div class="bame_el game_el2" style="top: 164px; right: 112px"><img src="/img/gl2.png" alt="img"></div>-->
                        <div class="bame_el game_el3" style="top: 73px; right: 212px"><img src="/img/shot.png" alt="img"></div>
                        <!--<div class="bame_el game_el4" style="top: 64px; left: 22px"><img src="/img/gl3.png" alt="img"></div>
                        <div class="bame_el game_el5" style="top: 364px; right: 212px"><img src="/img/gl4.png" alt="img"></div>
                        <div class="bame_el game_el6" style="top: 104px; right: 212px"><img src="/img/gl5.png" alt="img"></div>
                        <div class="bame_el game_el7" style="top: 204px; left: 312px"><img src="/img/gl6.png" alt="img"></div>
                        <div class="game_block_stat">
                            <div class="game_block_stat_res">
                                <p>1234 баллов</p>
                            </div>
                            <div class="game_block_stat_time">
                                <p>120 сек</p>
                            </div>
                        </div>-->
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cb_game_table" id="cb_game_table3" style="background: url(/img/tank_bg.jpg) center no-repeat; background-size: cover;">
                        <div class="cb_game_cell">
                            <div class="cb_game_res">
                                <h4>Рейтинг участников <br> <b>топ 10</b></h4>
                                <div class="cb_game_res_blocks">
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                    <!-- block -->
                                    <div class="ch_res_block">
                                        <div class="ch_res_block_img">
                                            <img src="/img/vinner.jpg" alt="img">
                                        </div>
                                        <div class="user_block_info">
                                            <h4>viktor tsoy</h4>
                                            <h5>5689 баллов</h5>
                                        </div>
                                    </div>
                                    <!-- /block -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cb_game_table" id="cb_game_table4" style="background: url(/img/res_bg.jpg) center no-repeat; background-size: cover;">
                        <div class="cb_game_cell">
                            <div class="cb_game_reslt">
                                <div class="cb_reslt_heading">
                                    <h4>Game Over</h4>
                                    <p>Ты заработал <b id="score"></b></p>
                                </div>
                                <div class="cb_reslt_buttons">
                                    <a onclick="tryAgain()" class="transition cb_reslt_button hovered">Попробовать еще раз</a>
                                    <a onclick="showRanking()" class="transition cb_reslt_button">Рейтинг участников</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
                <!-- /end of game -->
                <!-- warning message -->
                <div class="game_warning_message">
                    <p><b>Для прохождения игры,</b>
                        <br> пожалуйста, воспользуйся десктоп-версией сайта</p>
                </div>
                <!-- /warning message -->
                <div class="clickbattle_bottom">
                    <div class="clickbattle_bottom_text">
                        <p>Играй, зарабатывай баллы и выигрывай топовые игровые мышки, а так же
                            <br> подарочные наборы AXE. </p>
                        <p><b>Итоги конкурса будут подведены 22 января 2018 г. </b></p>
                    </div>
                    <div class="clickbattle_bottom_img"><img src="/img/mouse.png" alt="img"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        const radius = 20;
        const timeInterval = 1000;
        const endGameTime = 12000;
        var clickEnabled = true,
            distance,
            explosions,
            game,
            icon,
            isClicked = true,
            isFirst = true,
            music,
            object1,
            object2,
            score = 0,
            setTimeoutId,
            audio,
            stat,
            time,
            timerId,
            turnOffSound = true,
            tween1,
            tween2,
            x,
            y,
            x1,
            y1;

        function openBeginWindow(iconType) {
            icon = iconType;
            $("#cb_game_table1").hide();
            $("#cb_game_table2").css('display', 'table');
        }

        function loadGame() {
            $("#cb_game_table2").hide();
            $(".game_block").css('display', 'table');
            game = new Phaser.Game($("#cb_game_table1").outerWidth(), $("#cb_game_table1").outerHeight(), Phaser.AUTO, 'game_block', { preload: preload, create: create, update: update, render: render });
        }

        function tryAgain() {
            $("#cb_game_table4").hide();
            $("#cb_game_table1").css('display', 'table');
        }

        function showRanking() {
            $("#cb_game_table4").hide();
            $("#cb_game_table3").css('display', 'table');
        }

        function preload() {

            //  You can fill the preloader with as many assets as your game requires

            //  Here we are loading an image. The first parameter is the unique
            //  string by which we'll identify the image later in our code.

            //  The second parameter is the URL of the image (relative)
            game.load.image(icon + '1', '/img/' + icon + '1.png');
            game.load.image(icon + '2', '/img/' + icon + '2.png');
            game.load.image('background', '/img/space.jpg');
            game.load.image('soundOn', '/img/sound_on.png');
            game.load.image('soundOff', '/img/sound_off.png');
            game.load.spritesheet('boom', '/img/explosion.png', 64, 64, 23);
            game.load.audio('ak47', '/audio/ak47.mp3');

        }

        function create() {

            game.physics.startSystem(Phaser.Physics.ARCADE);
            game.add.sprite(0, 0, 'background');
            audio = game.add.sprite($("#cb_game_table1").outerWidth() - 100, 15, 'soundOn');
            audio.inputEnabled = true;
            audio.input.useHandCursor = true;
            audio.events.onInputDown.add(switchSound, this);
            music = game.add.audio('ak47');

            timerId = setInterval(function () {
                if (isFirst) {
                    object1.kill();
                    object2 = game.add.sprite(Math.abs(game.world.randomX) + 20, Math.abs(game.world.randomY) + 20, icon + '2');
                    object2.width = 40;
                    object2.height = 40;
                    object2.alpha = 0;
                    tween2 = game.add.tween(object2).to( { alpha: 1 }, 500, Phaser.Easing.Linear.None, true, 0, 0, true);
                    object2.inputEnabled = true;
                    game.physics.arcade.enable(object2);
                    x1 = object2.centerX;
                    y1 = object2.centerY;
                } else {
                    object2.kill();
                    object1 = game.add.sprite(Math.abs(game.world.randomX) + 20, Math.abs(game.world.randomY) + 20, icon + '1');
                    object1.width = 40;
                    object1.height = 40;
                    object1.alpha = 0;
                    tween1 = game.add.tween(object1).to( { alpha: 1 }, 500, Phaser.Easing.Linear.None, true, 0, 0, true);
                    x1 = object1.centerX;
                    y1 = object1.centerY;
                }
                isFirst = !isFirst;
                time.setText((game.time.totalElapsedSeconds().toFixed(0)) + ' СЕК');
                clickEnabled = true;
            }, timeInterval);

            setTimeoutId = setTimeout(function () {
                game.destroy();
                clearInterval(timerId);
                clearTimeout(setTimeoutId);
                $(".game_block").hide();
                $("#cb_game_table4").css('display', 'table');
                $("#score").text(score + ' баллов');
                score = 0;
            }, endGameTime);

            object1 = game.add.sprite(Math.abs(game.world.randomX) + 20, Math.abs(game.world.randomY) + 20, icon + '1');
            object1.width = 40;
            object1.height = 40;
            object1.alpha = 0;
            tween1 = game.add.tween(object1).to( { alpha: 1 }, 500, Phaser.Easing.Linear.None, true, 0, 0, true);
            object1.inputEnabled = true;

            x1 = object1.centerX;
            y1 = object1.centerY;

            game.input.onDown.add(onDown, this);

            var statStyle = { font: "20px BebasNeueRegular", fill: "#ab9675", lineHeight: 'normal' };
            var timeStyle = { font: "20px BebasNeueRegular", fill: "#ffffff", lineHeight: 'normal' };

            stat = game.add.text($("#cb_game_table1").outerWidth() - 100, 40, '0 БАЛЛОВ', statStyle);
            time = game.add.text($("#cb_game_table1").outerWidth() - 100, 65, '0 СЕК', timeStyle);

            game.physics.arcade.enable(object1);

            //  Explosion pool
            explosions = game.add.group();

            for (var i = 0; i < 10; i++)
            {
                var explosionAnimation = explosions.create(0, 0, 'boom', [0], false);
                explosionAnimation.anchor.setTo(0.5, 0.5);
                explosionAnimation.animations.add('boom');
            }

        }

        function switchSound() {
            if (turnOffSound) {
                audio.key = "soundOff";
                audio.loadTexture("soundOff", 0);
                music.volume = 0;
                turnOffSound = false;
            } else {
                audio.key = "soundOn";
                audio.loadTexture("soundOn", 0);
                music.volume = 1;
                turnOffSound = true;
            }
        }

        function getDistance(x, y, x1, y1) {
            return Math.sqrt(Math.pow(x - x1, 2) + Math.pow(y - y1, 2)).toFixed();
        }

        function onDown(object) {
            if (clickEnabled) {
                x = Math.floor(object.position.x);
                y = Math.floor(object.position.y);
                distance = +getDistance(x, y, x1, y1);

                if (distance <= radius) {
                    music.play();
                    score += (radius - distance);
                    stat.setText(score + ' БАЛЛОВ');
                    var explosionAnimation = explosions.getFirstExists(false);
                    explosionAnimation.reset(x1, y1);
                    explosionAnimation.play('boom', 30, false, true);
                }

                isClicked = true;
                clickEnabled = false;
            } else {
                if (distance <= radius) {
                    score -= 2;
                    stat.setText(score + ' БАЛЛОВ');
                }
            }
        }

        function update () {

        }

        function render () {

        }

    </script>
</div>