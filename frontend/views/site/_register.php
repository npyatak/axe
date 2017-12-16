<div class="reg_screen_block">
    <h3>Зарегистрируйтесь с помощью</h3>
    <p>	
    	<a href="/login?service=fb&amp;ref=%2Ftest-result" class="soc_lnk eauth-service-link fb"  data-eauth-service="facebook">
    		<i class="zmdi zmdi-facebook"></i>
    	</a> 
    	или 
    	<a href="/login?service=vk&amp;ref=%2Ftest-result" class="soc_lnk eauth-service-link vk"  data-eauth-service="vkontakte">
    		<i class="zmdi zmdi-vk"></i>
    	</a>
    </p>
    <div class="reg_screen_check">
        <input type="checkbox" id="register_checkbox" name="reg" checked>
        <label for="register_checkbox">Я соглашаюсь <a href="#">с полными правилами</a> конкурса</label>
    </div>
</div>

<?php
$script = "
    $(document).on('click', '.soc_lnk', function(e) {
        var div = $(this).closest('.test_slide');
        if(!$('#register_checkbox').is(':checked')) {
            return  false;
        }
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>