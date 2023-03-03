<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
 
class User {

    public static function Bulan_tahun($Carbon,$tahun=false)
    {
        $dt = new Carbon($Carbon);
        setlocale(LC_TIME, 'IND');

        $show[0]='%B';
        if($tahun==true)
        {
            $show[1]='%Y';
        }
        $date=implode(' ',$show);
        $dt_=str_replace('Pebruari', 'Februari', $dt->formatLocalized($date));
        return $dt_;
    }

    public static function send_email($data){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://email.hayweb.id/send/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $curl = curl_init();
        return $response;
    }
    public static function tanggal_indo($tanggal, $waktu = false)
    {
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );

        if($waktu == false){
            $split = explode('-', $tanggal);
            return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        }
        else {
            $split = explode(' ', $tanggal);
            $split2 = explode('-', $split[0]);
            return $split2[2] . ' ' . $bulan[ (int)$split2[1] ] . ' ' . $split2[0].' '.$split[1];
        }
    }

    public static function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public static function rupiah($rp)
    {
        return $rp!=0?'Rp '.number_format($rp,0,'.','.').',-':'Rp 0,-';
        
    }

    public static function slugify($text, string $divider = '-')
    {
      // replace non letter or digits by divider
      $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, $divider);

      // remove duplicate divider
      $text = preg_replace('~-+~', $divider, $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }
    public static function waktu_history($date){
      $awal  = date_create($date);
      $akhir = date_create(); // waktu sekarang
      $diff  = date_diff( $awal, $akhir );
      $waktu = '';

      if($diff->m < 1 && $diff->d < 1 && $diff->h < 1){
        $waktu = $diff->i.' Menit yang lalu';
      }
      else if($diff->m < 1 && $diff->d < 1 ){
        $waktu = $diff->h.' Jam yang lalu';
      }
      else {
            if($diff->d<7)
            {
              $waktu=$diff->d.' Hari yang Lalu';

            }
            else {
             $waktu = tanggal_indo($date);
           }
      }

      // if($diff->y < 24){
      //   if($diff->h < 1){
      //     $waktu = $diff->i.' Menit yang lalu';
      //   }
      //   else {
      //     $waktu = $diff->h.' Jam yang lalu';
      //   }
      // }
      // else {
      //   $hari=ceil($diff->d/24);
      //       if($hari<7)
      //       {
      //         $waktu=$hari.' Hari yang Lalu';

      //       }
      //       else {
      //         $waktu = tanggal_indo($date);
      //       }
      // }
      return $waktu;
    }
}