<?php 
namespace MehmetAliDurusoy\phpKF\Konsol;
/**
 * phpKF Konsol Uygulaması
 * 
 * @author Mehmet Ali Durusoy [mehmetali@oceanwebturk.com]
 * @license MIT [http://opensource.org/licenses/MIT]
 * @package MehmetAliDurusoy\phpKF\Konsol
 */
class Komutlar
{
 /**
  * @var array
  */
 const komutlar = [
   'tumu' => [
     'aciklama' => 'Tüm komutları listeler           ',
     'sinif_method' => [self::class,'tumu']
   ],
   'yeni' => [
     'aciklama' => 'Yeni bir phpKF Projesi oluşturur.',
     'sinif_method' => [self::class,'yeni']
   ]
 ];

 /**
  * @param string $metin
  * @return string
  */
 private function bilgi(string $metin) : string
 {
  return " ".$metin.PHP_EOL;
 }

 private function komutListeCiktisi(string $orta_metin)
 {
    $cikti = '  +-----------|--------------------------------------+
  | Komut Adı | Açıklama                             |
  +-----------|--------------------------------------+
 ';
   return $cikti.str_replace([
    '[karakter]'
   ],'|', $orta_metin).'  +-----------|--------------------------------------+';
 }
 
 /**
  * @param string $komut
  * @return string
  */
 public function karakerKontrol(string $komut) : string
 {
  switch ($komut) {
    case 'tumu':
        return ' [karakter] ';
    break;

    case 'yeni':
        return '  [karakter] ';
    break;
  }
 }

 public function tumu(array $parametre = [])
 {
  $cikti = '';
  
  foreach (self::komutlar as $komut => $ayar)
  {
   $cikti .= $this->karakerKontrol($komut).$komut.'      [karakter] '.(isset($ayar['aciklama']) ? $ayar['aciklama'] : '').'    [karakter] '.PHP_EOL; 
  }
   
  $cikti = $this->komutListeCiktisi($cikti);
  
  $bilgi  = PHP_EOL.$this->bilgi("Proje Dizini: ".PROJE_DIZIN);
  $bilgi .= $this->bilgi("PHP Sürümü: ".PHP_VERSION).$this->bilgi("İşletim Sistemi: ".PHP_OS);
  $bilgi .= $this->bilgi("Ayar Dosyası: ".$parametre['ayar_dosya']);
  $bilgi .= " Ayarlar\n".PHP_EOL;
  
  foreach($parametre['ayarlar'] as $adi => $deger)
  {
    $bilgi .= " ".$adi." = ".$deger.PHP_EOL;
  }

  return "\n phpKF Konsol\n phpKF-Konsol,phpKF siteniz için en güncel phpKF sürümü ve 3'lü paketi ".$parametre['ayarlar']['kurulacak_zip_url']." bu adresten indirir. \n".$bilgi."\n".$cikti.PHP_EOL;
 }
}