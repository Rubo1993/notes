<?php
use yii\helpers\Url;
//?>
<?php
if (isset($student)){
?>
    <ul class="navbar-nav navbar-right nav">

  <li>
<a class="col_white" href="<?= Url::to(['/']).'student/profile/'.$student['slug']?>">Իմ էջ</a>
  </li>
    </ul>
<?php
}
    ?>