<?php
use yii\helpers\Url;
?>

<div class="test_screen">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="test_screen_table">
                    <div class="test_screen_cell">
                        <div class="main_title">
                            <h2><b><strong>тест:</strong> <br> "Кем бы ты был в мире киберспорта"</b><br>участвуйте в розыгрыше подарочных наборов Axe  </h2>
                        </div>
                        <div class="test_slider">
                            <?php foreach ($questions as $question) {
                                echo $this->render('_question', ['question' => $question]);
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $script = '
    // slick
    $(".test_slider").slick({
        initialSlide: '.$initialSlide.',
        infinite: false,
        slidesToShow: 1,
        arrows: false,
        dots: true,
        autoplay: false,
        slidesToScroll: 1,
        adaptiveHeight: true,
        swipe: false,
        draggable: false,
        fade: true,
        customPaging: function(slider, i) {
            if (i < 9) {
                return "0" + (i + 1);
            } else {
                return i + 1;
            }
        },
        cssEase: "linear"
    });
';

$script .= "
    $(document).on('change', 'input:radio[name=\"answer\"]', function() {
        $(this).closest('.test_slide').find('.next_question_btn').removeClass('inactive');
    })

    $(document).on('click', '.next_question_btn', function(e) {
        var div = $(this).closest('.test_slide');
        if(!div.find('input[name=\"answer\"]').is(':checked')) {
            return  false;
        }

        $.ajax({
            type: 'POST',
            data: div.find('input').serialize(),
            success: function (data) {
                console.log(data.status);
                if(data.status == 'redirect') {
                    window.location.href = '".Url::toRoute(['site/test-result'])."';
                }
                $('.test_slider').slick('slickNext');
            }
        });

        return false;
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>