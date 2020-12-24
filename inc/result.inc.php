<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 12.05.2019
 * Time: 21:55
 */

require_once 'modules/testsfunctions.php';

if (isset($_REQUEST['tid'])){

    $res=getAnswear($_REQUEST['tid'],$mysqli);
   

}
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Отличные новости</h3>
            <?php
            echo <<<RESULT
                <p>Тестирование начато: $res[time_start] </p>
                <p>Тестирование закончено: $res[time_end] </p>
                <p>Из $res[count_all] вопросов правильно отвечено на $res[mark]</p>
                <p>Скопируйте ссылку на данный тест: <a href="http://apachetest.capslow.ru/?id=result&tid=$res[link]">http://apachetest.capslow.ru/?id=result&tid=$res[link]</a></p>
                
RESULT;

            ?>
        </div>
    </div>
</div>