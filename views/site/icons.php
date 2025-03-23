<?php
use yii\helpers\Html;
?>
<div class="row">
<?
foreach($icons as $icon){
        echo '<div class="col-sm-4">';
        echo Html::a($icon['value'], ['#'], ['class'=>'glyphicon'.' '.$icon['value']]).'<br>';
        echo '</div>';
}?>
</div>
