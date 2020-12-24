<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 12.05.2019
 * Time: 22:44
 */

if (isset($_POST['question'])){
    $question=$_POST['question'];
    $answer1=$_POST['answer1'];
    $answer2=$_POST['answer2'];
    $answer3=$_POST['answer3'];
    $answer4=$_POST['answer4'];
    $trueAnswers=$_POST['Checkbox'];
    if (empty($trueAnswers)){
        $trueAnswers=['безысходность','безысходность','безысходность','безысходность'];
    }
    $trueAnswers=json_encode($trueAnswers);
    if (!$mysqli->query("INSERT INTO `questions`(`question`, `answer_1`, `answer_2`, `answer_3`, `answer_4`,`true_anser`)
                                VALUES('$question','$answer1','$answer2','$answer3','$answer4','$trueAnswers') "))  {
        echo "Что-то пошло не так!: (" . $mysqli->errno . ") " . $mysqli->error;
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h4>Добавим вопросов нашим тестам</h4>

            <form action="?id=addquestion" method="post">
                <div class="form-group">
                    <label for="question">Запишем вопрос</label>
                    <textarea class="form-control" name="question" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="answer1">Вариант ответа 1</label>
                    <textarea class="form-control" name="answer1" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="answer2">Вариант ответа 2</label>
                    <textarea class="form-control" name="answer2" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="answer3">Вариант ответа 3</label>
                    <textarea class="form-control" name="answer3" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="answer4">Вариант ответа 4</label>
                    <textarea class="form-control" name="answer4" rows="2"></textarea>
                    <hr>
                    <h5>Теперь выберем правильные ответы к данному вопросу</h5>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="Checkbox[]" value="var1">
                        <label class="form-check-label" for="inlineCheckbox1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="Checkbox[]" value="var2">
                        <label class="form-check-label" for="inlineCheckbox2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="Checkbox[]" value="var3">
                        <label class="form-check-label" for="inlineCheckbox2">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="Checkbox[]" value="var4">
                        <label class="form-check-label" for="inlineCheckbox2">4</label>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
<!--            <pre>--><?php //echo print_r($_REQUEST); ?><!--</pre>-->

            <hr>
            <h4>Существующие вопросы:</h4>
            <?php
            $res = $mysqli->query("SELECT * FROM questions ORDER BY id ASC");
            //исходный порядок
//            $res->data_seek(0);
//            while ($row = $res->fetch_assoc()) {
//                echo " Вопрос: " . $row['question'] . "<br>";
//                echo " Вариант ответа 1:  " . $row['answer_1'] . "<br>";
//                echo " Вариант ответа 2:  " . $row['answer_2'] . "<br>";
//                echo " Вариант ответа 3:  " . $row['answer_3'] . "<br>";
//                echo " Вариант ответа 4:  " . $row['answer_4'] . "<br>";
//                echo " Правильные ответы  " . $row['true_anser'] . "<br>";
//                echo '<hr>';
//
//            }

            //обратный порядок
            for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                $res->data_seek($row_no);
                $row = $res->fetch_assoc();
                echo " Вопрос: " . $row['question'] . "<br>";
                echo " Вариант ответа 1:  " . $row['answer_1'] . "<br>";
                echo " Вариант ответа 2:  " . $row['answer_2'] . "<br>";
                echo " Вариант ответа 3:  " . $row['answer_3'] . "<br>";
                echo " Вариант ответа 4:  " . $row['answer_4'] . "<br>";
                echo " Правильные ответы  " . $row['true_anser'] . "<br>";
                echo '<hr>';
            }
            ?>

        </div>
    </div>
</div>
