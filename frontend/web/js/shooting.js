$('.shot_screen_game_wrapper img').on('dragstart', function(event) { event.preventDefault(); });

//Get Cookie
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

//Set Cookie
function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}

var timerTextIntervalId;
var endGameSetTimeoutId;
var leftTime = timeGame;
var userPoins = 0;
var gameWarriorsCount = $('#shot_game_screen2').find('.game_warriors').length;
var warriorsIndexesPlusPoint = [0,2,4,8,11,12,13,14,15];

var cookieSound = getCookie("shootingsound");
var shootAudio = document.createElement("audio");
    shootAudio.src = window.location.origin + "/audio/ak47.mp3";
    if (typeof cookieSound !== 'undefined' && cookieSound == 1) {
      shootAudio.volume = 0.70;
    } else {
      shootAudio.volume = 0;
    }
    shootAudio.autoPlay = false;
    shootAudio.preLoad = true;

// Sound control
function switchSound(turnOffSound) {
  if (turnOffSound) {
    setCookie("shootingsound", 0);
    shootAudio.volume = 0;
  } else {
    setCookie("shootingsound", 1);
    shootAudio.volume = 0.70;
  }
}

//Reset Game params.
function clearGame() {
  userPoins = 0;
  var scoreText = getScoreText(userPoins);
  $('#shot_game_screen2').find('.game_warriors').removeClass('active').removeClass('clicked').hide();
  $('.game_block_stat_res p').html(scoreText);
  $('.game_block_stat_time p').html(leftTime/1000 + ' сек');
  $('#shoot-explosion').remove();
}

//Animate random warrior
function animateRandomWarrior() {
  var randomWarriorIndex = Math.floor(Math.random() * gameWarriorsCount);
  $('#shot_game_screen2').find('.game_warriors.active').fadeOut(timeAnimationHideWarrior, function() {
    $(this).removeClass('active').removeClass('clicked');
  });
  var $randomWarrior = $('#shot_game_screen2').find('.game_warriors').eq(randomWarriorIndex).fadeIn(timeAnimationShowWarrior, function() {
    $(this).addClass('active');
  });
}

//Get score text
function getScoreText(score) {
  var lastone = score.toString().split('').pop();
  var str = ' БАЛЛОВ';
  if (lastone == 1) {
    str = ' БАЛЛ';
  } else if(lastone == 2 || lastone == 3 || lastone == 4) {
    str = ' БАЛЛА';
  }
  return score + str;
}

//Start Game
function startGame() {
  clearGame();
  // Seconds left
  timerTextIntervalId = setInterval(function () {
    leftTime -= 1000;
    $('.game_block_stat_time p').html(leftTime/1000 + ' сек');
  }, 1000);

  // Creating warrior
  var createWarrior = function () {
    appearTargetTimerId = setInterval(function () {
      animateRandomWarrior();
      clearInterval(appearTargetTimerId);
      delayAnimationSetTimeoutId = setTimeout(function () {
        createWarrior();
      }, timeBeforeShowWarrior);
    }, timeLifeWarrior);
  };

  createWarrior();

  // Game over timeout
  endGameSetTimeoutId = setTimeout(function () {
    clearInterval(timerTextIntervalId);
    clearTimeout(delayAnimationSetTimeoutId);
    clearTimeout(endGameSetTimeoutId);
    $('#shot_game_screen2').hide();
    $('#shot_game_screen3').show();
    $('#shootingresult-client_score').val(userPoins);
    if($('#shot_game_screen3').find('#shootingresult-recaptcha-recaptcha').length == 0) {
      $('#score_form').submit();
    }
    //$('#shot_game_screen4').find('.shot_screen_block h4').html('<b>Ты заработал</b> ' + userPoins + ' <b>баллов</b>');
    // $.ajax({
    //   type: 'POST',
    //   data: 'client_score=' + userPoins,
    //   success: function (data) {

    //   },
    // });
  }, timeGame);
}

//Animate explosion
function animateExplosion() {
  var i = 0;
  var timeout = parseInt(timeBeforeShowWarrior / 25);
  timerAnimateExplosionIntervalId = setInterval(function () {
    $('#shoot-explosion').removeClass('state' + i);
    i++;
    $('#shoot-explosion').addClass('state' + i);
    if (i == 24) {
      $('#shoot-explosion').remove();
      clearInterval(timerAnimateExplosionIntervalId);
    }
  }, timeout);
}

$(document).ready(function() {
  // $('#shot_game_screen1').hide();
  // $('#shot_game_screen2').show();
  // startGame();

  if (typeof cookieSound !== 'undefined' && cookieSound == 1) {
    $('.sound-off').hide();
    $('.sound-on').show();
  } else {
    $('.sound-off').show();
    $('.sound-on').hide();
  }

  //Play game button
  $('.shot_play_btn').on('click', function(event) {
    $('#shot_game_screen1').hide();
    $('#shot_game_screen2').show();
    startGame();
    return false;
  });

  //Shoot on warrior
  $('#shot_game_screen2').find('.game_warriors').on('mousedown', function(e) {
    if ($(this).hasClass('clicked')) {
    }
    else {
      var elemOffetLeft = this.offsetLeft;
      var elemOffetTop = this.offsetTop;
      var x = e.offsetX===undefined?e.layerX:e.offsetX;
      var y = e.offsetY===undefined?e.layerY:e.offsetY;
      // console.log(elemOffetLeft);
      // console.log(elemOffetTop);
      // console.log(x);
      // console.log(y);
      $(this).parent().append('<div id="shoot-explosion" style="left: ' + (elemOffetLeft+x) + 'px; top: ' + (elemOffetTop+y) + 'px;"></div>');
      animateExplosion();
      shootAudio.play();
      var index = $('#shot_game_screen2').find('.game_warriors').index($(this));
      $(this).addClass('clicked');
      //console.log(index);
      if ($.inArray(index, warriorsIndexesPlusPoint) !== -1) {//террористы
        //console.log('plus');
        userPoins += pointsPlus;
        $(this).parent().append('<div id="shoot-plus-points" class="shoot-points" style="left: ' + (elemOffetLeft+x) + 'px; top: ' + (elemOffetTop+y) + 'px;">+' + pointsPlus + '</div>');
        setTimeout(function () {
          $('body').find('.shoot-points').addClass('animate');
          pointsAnimationTimeoutId = setTimeout(function () {
            $('#shoot-plus-points').remove();
          }, timeBeforeShowWarrior);
        }, 50);
      }
      else {
        //console.log('minus');
        if (userPoins > 0) {
          userPoins += pointsMinus;
          $(this).parent().append('<div id="shoot-minus-points" class="shoot-points" style="left: ' + (elemOffetLeft+x) + 'px; top: ' + (elemOffetTop+y) + 'px;">' + pointsMinus + '</div>');
          setTimeout(function () {
            $('body').find('.shoot-points').addClass('animate');
            pointsAnimationTimeoutId = setTimeout(function () {
              $('#shoot-minus-points').remove();
            }, timeBeforeShowWarrior);
          }, 50);
        }
      }
      var scoreText = getScoreText(userPoins);
      $('.game_block_stat_res p').html(scoreText);
    }
  });

  //Sound toggle
  $('#shot_game_screen2').find('.game_block_sound p').on('click', function(event) {
    if ($(this).hasClass('sound-off')) {
      $('.sound-off').hide();
      $('.sound-on').show();
      switchSound(false);
    }
    else {
      $('.sound-off').show();
      $('.sound-on').hide();
      switchSound(true);
    }
  });

});







