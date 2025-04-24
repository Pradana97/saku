<?php

use app\models\Murid;
use app\models\Pegawai;
use yii\helpers\{Url, Html};

$base = Url::home(true);
$soundpath = $base . 'uploads/notif.mp3';
$this->registerJs('$("document").ready(function(){
    var notif1=0;
    var totalnotif1=0;
function play(){
    var audio = document.createElement("audio");
    audio.src = "' . $soundpath . '";
    audio.autoplay = true;
    audio.play();	
}
 function loadDoc() {
     $.ajax({
         url:baseurl+"site/notiftrans",
         method:"GET",
         dataType:"json",
         success:function(data){
             $("#count_notiftrans").html(data);
             if(notif1!=data){
                 totalnotif1+=data;
                }
            notif1=data;
         }
     })
 }
 $(document).on("click", ".dropdown-toggle", function(){
  $.ajax({
   url:baseurl+"site/lisnotiftrans",
   method:"GET",
   success:function(data){
        $(".dok").html(data);
   }
  })
 });
//  setInterval(function(){
//     loadDoc();
//     notifopname();
//     notifselesai();
//     notifproses();
//     if(totalnotif1!=notif1){
//         play();
//         totalnotif1=notif1;
//     }
//   },10000)
 function notifopname(){
     $.ajax({
         url:baseurl+"site/notiftransopname",
         method:"GET",
         dataType:"json",
         success:function(data){
            $("#notifopname").html(data);
         }
     })
 }
  $(document).on("click", ".dropdown-toggle", function(){
      $.ajax({
           url:baseurl+"site/lisnotiftransopneme",
           method:"GET",
           dataType:"json",
           success:function(data){
                $(".listopname").html(data);
           }
      })
 });
 function notifselesai() {
     $.ajax({
         url:baseurl+"site/notiftransselesai",
         method:"GET",
         dataType:"json",
         success:function(data){
         $("#notifselesai").html(data);
         }
     })
 }
  $(document).on("click", ".dropdown-toggle", function(){
      $.ajax({
           url:baseurl+"site/lisnotiftransselesai",
           method:"get",
           dataType:"json",
           success:function(data){
                $(".pangkat").html(data);
           }
      })
 });
 function notifproses() {
    $.ajax({
        url:baseurl+"site/notiftransproses",
        method:"GET",
        dataType:"json",
        success:function(data){
        $("#notifproses").html(data);
        }
    })
}
 $(document).on("click", ".dropdown-toggle", function(){
     $.ajax({
          url:baseurl+"site/lisnotiftransproses",
          method:"get",
          dataType:"json",
          success:function(data){
               $(".listproses").html(data);
          }
     })
});
 });');
?>
<header class="main-header">
    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' .  Html::img(Yii::getAlias('@web/img/logoapp.png'), ['style' => ['width' => '150px']]) . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- orderan masuk -->
                <!-- <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Orderan Masuk">
                        <i class="fa fa-bell"></i>
                        <span class="label label-success" id="count_notiftrans">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu dok" style="overflow: auto;">
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <!-- orderan di proses -->
                <!-- <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" title="lagi di kerjakan" data-toggle="dropdown">
                        <i class="fa fa-stethoscope"></i>
                        <span class="label label-warning" id="notifproses">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu listproses" style="overflow: auto">
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <!-- orderan di opname -->
                <!-- <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" title="lagi opname nih" data-toggle="dropdown">
                        <i class="fa fa-ambulance"></i>
                        <span class="label label-warning" id="notifopname">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu listopname" style="overflow: auto">
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <!-- orderan selesai -->
                <!-- <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Orderan Selesai">
                        <i class="fa fa-flag-checkered"></i>
                        <span class="label label-warning" id="notifselesai">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu pangkat" style="overflow: auto">
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= \Yii::getAlias('@web/img/BurgerMenu.gif') ?>" class="img-circle" alt="User Image" width="18px" />
                        <span class="hidden-xs"><?= (Yii::$app->user->isGuest) ? 'Guest' : Yii::$app->user->identity->username ?? ''; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <?php
                        $a = Yii::$app->user->identity->id ?? '';
                        $role = \Yii::$app->tools->getcurrentroleuser();
                        $roleValue = reset($role);

                        if ($roleValue == 'murid') {
                            $foto = Murid::find()->where(['user_id' => $a])->one();
                            if ($foto && $foto->foto) {
                                $imgSrc = \Yii::getAlias('@web/uploads/murid/' . $foto->id_murid . $foto->foto);
                            } else {
                                $imgSrc = \Yii::getAlias('@web/uploads/default.png');
                            }
                        } elseif ($roleValue == 'guru') {
                            $foto = Pegawai::find()->where(['id_user' => $a])->one();
                            if ($foto && $foto->foto) {
                                $imgSrc = \Yii::getAlias('@web/uploads/pegawai/' . $foto->id_pegawai . $foto->foto);
                            } else {
                                $imgSrc = \Yii::getAlias('@web/uploads/default.png');
                            }
                        } else {
                            $foto = Pegawai::find()->where(['id_user' => $a])->one();
                            if ($foto && $foto->foto) {
                                $imgSrc = \Yii::getAlias('@web/uploads/pegawai/' . $foto->id_pegawai . $foto->foto);
                            } else {
                                $imgSrc = \Yii::getAlias('@web/uploads/default.png');
                            }
                        }

                        ?>

                        <li class="user-header">
                            <img src="<?= $imgSrc ?>" class="img-circle" alt="User Image" />
                            <p><?= (Yii::$app->user->isGuest) ? 'Guest' : $foto->nama ?? ''; ?></p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'get', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
            </ul>
        </div>
    </nav>
</header>