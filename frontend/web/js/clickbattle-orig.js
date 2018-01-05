//http://www.javascriptobfuscator.com/Javascript-Obfuscator.aspx
var appearTargetTimerId,
    clickEnabled = false,
    currentTime = 0,
    delayAnimationSetTimeoutId,
    distance,
    endGameSetTimeoutId,
    explosions,
    game,
    icon,
    isFirst = true,
    music,
    number,
    tNumber = 0,
    currentTarget,
    targetsResult = [],
    object1,
    object2,
    score = 0,
    audio,
    stat,
    time,
    timerTextIntervalId,
    totalElapsedMilliSeconds,
    turnOffSound = true,
    tween1,
    tween2,
    x,
    y,
    x1,
    y1;

$('.enemy_block_button').on('click', function(e) {
    icon = $(this).data('icon');
    $("#cb_game_table1").hide();
    $("#cb_game_table2").css('display', 'table');

    return false;
});

$('.start_bame_btn').on('click', function(e) {
    $("#cb_game_table2").hide();
    $(".game_block").css('display', 'table');
    game = new Phaser.Game($("#cb_game_table1").outerWidth(), $("#cb_game_table1").outerHeight(), Phaser.AUTO, 'game_block', { preload: preload, create: create, update: update});

    return false;
});

function preload() {
    if (icon === 'tank') {
        game.load.image('background', '/img/tank_bg.jpg');
    } else if (icon === 'axe') {
        game.load.image('background', '/img/res_bg.jpg');
    } else if (icon === 'weapon') {
        game.load.image('background', '/img/space.jpg');
    }
    game.load.image(icon + '1', '/img/' + icon + '1.png');
    game.load.image(icon + '2', '/img/' + icon + '2.png');
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

    // Seconds pass after game start
    timerTextIntervalId = setInterval(function () {
        currentTime++;
        time.setText(currentTime + ' СЕК');
    }, timerTextInterval);

    // Creating target1 or target2
    var create = function () {
        appearTargetTimerId = setInterval(function () {
            createTarget();
            update();
            clearInterval(appearTargetTimerId);
        }, targetLifeDurationInterval);
    }

    // Delay between target1 and target2
    var update = function () {
        delayAnimationSetTimeoutId = setTimeout(function () {
            create();
        }, delayInterval);
    }

    // Game over timeout
    endGameSetTimeoutId = setTimeout(function () {
        game.destroy();
        clearInterval(appearTargetTimerId);
        clearInterval(timerTextIntervalId);
        clearTimeout(delayAnimationSetTimeoutId);
        clearTimeout(endGameSetTimeoutId);
        $(".game_block").hide();
        if (icon === 'tank') {
            $("#cb_game_table4").css({'background': 'url(/img/tank_bg.jpg) center no-repeat', 'background-size': 'cover'});
        } else if (icon === 'axe') {
            $("#cb_game_table4").css({'background': 'url(/img/res_bg.jpg) center no-repeat', 'background-size': 'cover'});
        } else if (icon === 'weapon') {
            $("#cb_game_table4").css({'background': 'url(/img/space.jpg) center no-repeat', 'background-size': 'cover'});
        }
        $("#cb_game_table4").css('display', 'table');
        $("#score").text(getScoreText(score));

        $.ajax({
            type: 'POST',
            data: 'client_score='+score+'&clicks='+JSON.stringify(clicks)+'&targets='+JSON.stringify(targetsResult),
            success: function (data) {
                score = 0;
                currentTime = 0;
            },
        })
    }, endGameTime);

    // Creating first target after the game starts
    createTarget();
    var init = setTimeout(function () {
        create();
        clearTimeout(init);
    }, 800);

    game.input.onDown.add(onDown, this);

    var statStyle = { font: "20px BebasNeueRegular", fill: "#ab9675", lineHeight: 'normal' };
    var timeStyle = { font: "20px BebasNeueRegular", fill: "#ffffff", lineHeight: 'normal' };

    stat = game.add.text($("#cb_game_table1").outerWidth() - 100, 40, '0 БАЛЛОВ', statStyle);
    time = game.add.text($("#cb_game_table1").outerWidth() - 100, 65, '0 СЕК', timeStyle);

    //  Explosion pool
    explosions = game.add.group();

    for (var i = 0; i < 10; i++) {
        var explosionAnimation = explosions.create(0, 0, 'boom', [0], false);
        explosionAnimation.anchor.setTo(0.5, 0.5);
        explosionAnimation.animations.add('boom');
    }

}

function createTarget() {
    update();
    object1 && object1.kill();
    iconNumber = Math.floor((Math.random() * 2) + 1).toString();
    object1 = game.add.sprite(targets[tNumber]['x'] - halfImageWidth, targets[tNumber]['y'] - halfImageWidth, icon + iconNumber);
    object1.alpha = 0;
    tween2 = game.add.tween(object1).to( { alpha: 1 }, targetLifeDurationInterval / 2, Phaser.Easing.Linear.None, true, 0, 0, true);
    object1.inputEnabled = true;
    game.physics.arcade.enable(object1);
    x1 = object1.centerX;
    y1 = object1.centerY;
    currentTarget = tNumber;

    targetsResult[tNumber] = {'time': totalElapsedMilliSeconds - (totalElapsedMilliSeconds % 1), 'x': x1 + 20, 'y': y1 - 20};
    tNumber = tNumber + 1;
    clickEnabled = true;
}

// Sound control
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

// Get distance
function getDistance(x, y, x1, y1) {
    return Math.sqrt(Math.pow(x - x1, 2) + Math.pow(y - y1, 2)).toFixed();
}

var clicks = {};
// On click target
function onDown(object) {
    targetTime = targetsResult[currentTarget].time;

    x = Math.floor(object.position.x);
    y = Math.floor(object.position.y);
    var flag = true;
    
    if (totalElapsedMilliSeconds >= targetTime && targetTime + targetLifeDurationInterval > totalElapsedMilliSeconds) {
        if (clickEnabled) {
            distance = getDistance(x, y, x1, y1);
            if (distance <= radius) {
                flag = false;
                music.play();
                score += (radius - distance);
                var explosionAnimation = explosions.getFirstExists(false);
                explosionAnimation.reset(x1, y1);
                explosionAnimation.play('boom', 30, false, true);
                clickEnabled = false;
            }
        }
    } 
    
    if(flag) {
        score -= 2;
    }
    stat.setText(getScoreText(score));

    var click = {'x': x, 'y': y, 't': targetTime};   
    clicks[totalElapsedMilliSeconds - (totalElapsedMilliSeconds%1)] = click;
}

function update () {
    totalElapsedMilliSeconds = game.time.totalElapsedSeconds() * 1000;
}

function getScoreText(score) {    
    var lastone = score.toString().split('').pop();
    var str = ' БАЛЛОВ';
    if(lastone == 1) {
        str = ' БАЛЛ';
    } else if(lastone == 2 || lastone == 3 || lastone == 4) {
        str = ' БАЛЛА';
    }

    return score + str;
}