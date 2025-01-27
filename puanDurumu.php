<!DOCTYPE html>
<html lang="tr">

<head id="ctl00_Head">
    <title>
        Trendyol Süper Lig Fikstürü ve Puan Cetveli TFF
    </title>
    <meta charset="UTF-8">


    <!-- <link rel="stylesheet" type="text/css" href="https://www.tff.org/Css/custom.css?v=37"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Titillium Web' !important;
        /*font-family: 'Poppins', sans-serif; !important;*/
        font-size: 22px;
        background-image: none !important;
        width: 100%;
    }

    a:link,
    a:visited {
        color: #b20211;
    }

    table,
    div {
        font-family: 'Titillium Web' !important;
    }

    .griBG {
        background-color: #ada8a8;
    }
    </style>
    <script>
    function linkTiklamaYakalayici(event) {
        var hedefURL = event.target.href; // Tıklanan bağlantının hedef URL'si
        console.log("Tıklanan URL: " + hedefURL);
        // Burada hedefURL'yi istediğiniz şekilde işleyebilirsiniz, örneğin başka bir sayfaya yönlendirebilirsiniz.
        window.location.href = "hedef_sayfa?kulupID=" + hedefURL;
        
    }

    document.addEventListener('click', function(event) {
        if (event.target.tagName === 'A') { // Tıklanan öğe bir bağlantı mı?
            event.preventDefault(); // Bağlantıya varsayılan davranışı engelle
            linkTiklamaYakalayici(event); // Bağlantıyı yakala ve işle
        }
    });
    </script>



</head>

<body>


    <?php
    
    // cURL kullanarak URL'den içeriği al
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://www.tff.org/default.aspx?pageID=198");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($curl);
    curl_close($curl);
    // Karakter kodlamasını belirle
    // İçeriği Windows-1254'ten UTF-8'e dönüştür
    $html_utf8 = mb_convert_encoding($html, 'UTF-8', 'Windows-1254');

    // İçeriğin içindeki istediğimiz bölümü düzenli ifade ile çek
    preg_match_all('@<div class="s-content">(.*?)</div>@si', $html_utf8, $matches);

    // Eğer eşleşme varsa işlem yap
    if (!empty($matches[0])) {

        // Her eşleşme için bir satır oluştur
        foreach ($matches[1] as $match) {
            // İçerikten istediğimiz kısımları çıkartmak için biraz daha düzenli ifade kullanabilirsiniz

            preg_match_all('/<a id="(.*?)">(.*?)<\/a>/', $match, $details);
            preg_match_all('/<span id="(.*?)">(.*?)<\/span>/', $match, $detailss);

            

            // Tablonun bir satırını yazdır
         

        }
        
   

        echo "<hr>";
    } else {
        // Eşleşme bulunamazsa hata mesajı yazdır
        echo "Veri bulunamadı.";
    }

 
    

    // burası onemli 
    // Takımlar Gelecek for dongüsü  kac takım geldiği kontrol edilir
    $takim = [];
    
    for ($i = 0; $i < 20; $i++) {

        if (isset($details[0][$i])) {
            $takim[] = $details[0][$i];
            $details[0][$i] . "<br>";
        }
    }

    echo '<form id="myForm" action="hedef_sayfa" method="get">';

 
  
    echo "<table border='1'class=\"s-table container-fluid \" style=\"width:80%;\"> ";
    echo "<th colspan=\"9\" class=\"text-center\"><h3>PUAN DURUMU</h3></th>";
    echo "<tr class=\"griBG text-center\">";
    echo "<th>Takımlar</th>";

    for ($i = 0; $i < 8; $i++) {

        echo     "<th>" .  $detailss[0][$i] . "</th>"; // bu for dobgüsü halledecem


    }
    echo "</tr>";

    $detailssCount = count($detailss[0]);
    $details_index = 0;
    // 160 olan sayı 168 di ama 168 de hata veriyor
    for ($j = 8; $j < $detailssCount && $j < 160; $j++) {
        $say = $detailss[0][$j];

        // Her 8 sayıda bir yeni satır aç
        if (($j - 7) % 8 == 1) {

            echo "<tr class=\"griBG2\">";




            echo "<th>" . $details[0][$details_index] . "</th>";

            $details_index += 1; // Her döngüde 4 sayısını artır

        }

        echo "<td width=\"8%\" class=\"text-center\" >" . $say . "</td>";

        // Her 8 sayıda bir satırı kapat
        if (($j - 7) % 8 == 0) {

            echo "</tr>";
        }
    }

    echo "</table>";

    echo'  </form>';


    ?>


<br><br>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
