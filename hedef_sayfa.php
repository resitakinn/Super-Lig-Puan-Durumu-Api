
<!-- burda puandurumu Sayfasından alınan deger işlenip ayrıştırılıp api.php sayfasına yönlendirme yapılır -->
<?php

if(!$_GET){
  //* hiç bir deger gelmezse direk anasayfa yönlendirme yapılır
    header("Location:puanDurumu.php");
}else {
  
    $url = $_GET['kulupID'];
header("Location:apiDurum?kulupID=".$url);

}

?>