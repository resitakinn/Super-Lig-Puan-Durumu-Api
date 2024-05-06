<?php


if(!$_GET){
 
  header("Location:puanDurumu.php");
  exit;
}


?>

<!doctype html>
<html lang="tr">

<head>
    <title>Takım Bilgi</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <style>
         /* Kulüp bilgi tablo stil */
 table {
    width: 50%; /* Tablo genişliği ayarlanabilir */
    margin-left: auto;
    margin-right: auto;
    border-collapse: collapse;
  }
  th, td {
    padding: 8px;
    border: 1px solid #ddd;
  }
  th {
    background-color: #f2f2f2;
  }
  img {
    max-width: 100%;
    height: auto;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  a{
    color:red;
    font-weight: bold;
  }

   /* Resimlerin genel stilini ayarla */
   .gallery img {
    max-width: 100%;
    height: auto;
  }

  /* Tablo stilini ayarla */
  .gallery-table {
    width: 80%;
    margin: 0 auto;
    border-spacing: 10px; /* Tablo hücreleri arasındaki boşluğu ayarla */
  }

  /* Tablo hücrelerinin stilini ayarla */
  .gallery-cell {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
  }

 
    </style>
</head>

<body>


    <?php

  $link =  $_GET["kulupID"];



  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "https://www.tff.org/Default.aspx?pageId=28&kulupID=".$link);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $html = curl_exec($curl);
  curl_close($curl);
  // Karakter kodlaması
  $html_utf8 = mb_convert_encoding($html, 'UTF-8', 'Windows-1254');



  // İçeriğin içindeki istediğimiz bölümü düzenli ifade ile çek
  preg_match_all('@<article class="news-container">(.*?)</article>@si', $html_utf8, $matches);

  // Eğer eşleşme varsa işlem yap
  if (!empty($matches[0])) {

    // Her eşleşme için bir satır oluştur
    foreach ($matches[1] as $match) {
      // İçerikten istediğimiz kısımları çıkartmak için biraz daha düzenli ifade kullanabilirsiniz

      preg_match_all('/<img\s+[^>]*>/', $match, $takimLogo);
      preg_match_all('/<a id="(.*?)">(.*?)<\/a>/', $match, $takimResimler);
      preg_match_all('/<span id="(.*?)">(.*?)<\/span>/', $match, $takimBilgi);
    }
  } else {
    // Eşleşme bulunamazsa hata mesajı yazdır
    echo "Veri bulunamadı.";
  }
 
  // burda takimresimlerden gelen resimlerin her takım için farklı oldugu için döngüye alınıp son verinin değerini değişkene atayıp ve resimleri gösterme alanı başlangıç 
  
  $sira = 0;
  foreach ($takimResimler[0] as $resim) {
    $sira = ++$sira;
  }
  // burda takimresimlerden gelen resimlerin her takım için farklı oldugu için döngüye alınıp son verinin değerini değişkene atayıp ve resimleri gösterme alanı bitiş 
  ?>
    <div class="container text-center mt-5">
        <h1>Takım Bilgileri</h1>
    </div>
    <table class="container mt-5">
        <tr>
            <td style="width: 40%;">
                <?= $takimLogo[0][0] ?>
                <br>
                <div class="text-center">
                    <?php if ($takimResimler[0][0] == true) {
                      echo $takimResimler[0][0];
                   
                    } ?>
                </div>

            </td>
            <td style="vertical-align: top;">
                <table style="width:100%;">
                    <tr>
                        <td valign="top">
                            <b>Kulüp Kodu :</b>
                        </td>
                        <td valign="top">
                            <span
                                id="ctl00_MPane_m_28_190_ctnr_m_28_190_dtKulupBilgisi_Label3"><?= $takimBilgi[0][1] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <b>Adres :</b>
                        </td>
                        <td valign="top">
                            <span
                                id="ctl00_MPane_m_28_190_ctnr_m_28_190_dtKulupBilgisi_Label3"><?= $takimBilgi[0][3] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <b>Şehir :</b>
                        </td>
                        <td valign="top">
                            <span
                                id="ctl00_MPane_m_28_190_ctnr_m_28_190_dtKulupBilgisi_Label3"><?= $takimBilgi[0][5] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <b>Bölge :</b>
                        </td>
                        <td valign="top">
                            <span
                                id="ctl00_MPane_m_28_190_ctnr_m_28_190_dtKulupBilgisi_Label3"><?= $takimBilgi[0][7] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <b>Başkan :</b>
                        </td>
                        <td valign="top">
                            <span
                                id="ctl00_MPane_m_28_190_ctnr_m_28_190_dtKulupBilgisi_Label3"><?= $takimBilgi[0][13] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <b>Web Site :</b>
                        </td>
                        <td valign="top">
                            <span id="ctl00_MPane_m_28_190_ctnr_m_28_190_dtKulupBilgisi_Label3">
                                <?= $takimResimler[0][1] ?></span>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>


    <br><br>
    <hr>
    <div class="text-center">
        <a href="puanDurumu">Anasayfa Dön</a>
    </div>

    <hr>
    <h2 class="text-center">TAKIM FORMALARI</h2>
    <table class="gallery-table container-fluid">
        <tr>
            <?php
       for ($formaSay = 11; $formaSay <= 30; $formaSay++) {
        // Her 10 resimde bir yeni satır aç
        if (($formaSay - 10) % 5 == 1) {
            echo "<tr>";
        }
    
        echo '<td class="gallery-cell">';
        echo $takimLogo[0][$formaSay];
        echo '</td>';
    
        // Her 10 resimde bir satırı kapat
        if (($formaSay - 9) % 5 == 1 || $formaSay == 30) {
            echo "</tr>";
        }
    }
    

      ?>
        </tr>


    </table>
    <hr>
    <h2 class="text-center">KULÜP RESİMLERİ</h2>
    <table class="gallery-table">
        <tr>
            <?php
      
      for ($i = 3; $i < $sira; $i++) {
        // Her 3 resimde bir yeni satır aç
        if ($i % 3 == 0) {
          echo "<tr>";
        }

        echo '<td class="gallery-cell">';
        echo $takimResimler[0][$i];
        echo '</td>';

        // Her 3 resimde bir satırı kapat
        if (($i + 1) % 3 == 0) {
          echo "</tr>";
        }
      }
      ?>
        </tr>


    </table>

    <hr>
    <br><br>

    <script>
    // Sayfa yüklendiğinde çalışacak olan JavaScript kodu
    document.addEventListener('DOMContentLoaded', function() {
        // İlgili <a> etiketini seçme
        var linkElement = document.getElementById('ctl00_MPane_m_28_190_ctnr_m_28_190_dtKulupBilgisi_lnkKulup');

        // Eğer ilgili <a> etiketi bulundu ise
        if (linkElement) {
            // Yeni URL
            var yeniURL = "puanDurumu";

            // href özelliğini yeni URL ile güncelle
            linkElement.setAttribute('href', yeniURL);
        }
    });
    </script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>


</body>

</html>
