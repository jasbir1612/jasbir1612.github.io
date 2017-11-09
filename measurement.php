<?php

$bid = $_POST['id'];
$lenght=$_POST['len'];
$cc=$_POST['cc'];
$chest=$_POST['chest'];
$waist=$_POST['waist'];
$hipp=$_POST['hipp'];
$armhole=$_POST['armhole'];
$shoulder=$_POST['shoulder'];
$neck=$_POST['neck'];
$sleeves=$_POST['sleeves'];
$salwar=$_POST['salwar'];
$mori=$_POST['mori'];
$knee=$_POST['knee'];
$calf=$_POST['calf'];
$theigh=$_POST['theigh'];
$blenght=$_POST['blenght'];
$bchest=$_POST['bchest'];
$bwaist=$_POST['bwaist'];
$bshoulder=$_POST['bshoulder'];
$bneck=$_POST['bneck'];
$bsleeves=$_POST['bsleeves'];
$bdaatpoint=$_POST['bdaatpoint'];

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {


        if(empty($bid))
            {

              header("Location: forms/measurementform.html");

            }

     else
     {
        $conn=mysql_connect('localhost','u920426802_bindy','Kawal_2167');
        mysql_select_db('u920426802_bindy');
        if($conn)
        {
         $filenam="Bindya Boutique .xlsx";
			   $string="$bid,$lenght,$cc,$chest,$waist,$hipp,$armhole,$shoulder,$neck,$sleeves,$salwar,$mori,$knee,$calf,$theigh,$blenght,$bchest,$bwaist,$bshoulder,$bneck,$bsleeves,$bdaatpoint ,\n";
			   $file1 = fopen($filenam, "a");
         fwrite($file1, $string);
         fclose($file1);
         $sql = "UPDATE details set lenght='$lenght',crosschest='$cc',chest='$chest',waist='$waist',hipp='$hipp',armhole='$armhole',shoulder='$shoulder',neck='$neck',seelves='$sleeves',salwar='$salwar',mori='$mori',knee='$knee',calf='$calf',theigh='$theigh',
         blenght='$blenght',bchest='$bchest',bwaist='$bwaist',bshoulder='$bshoulder',bneck='$neck',bsleeves='$bsleeves',bdaatpoint='$bdaatpoint' WHERE sid = $bid ";
         $res = mysql_query($sql);

         if($res)
         {
             header("Location: forms/measurementform.html");
         }

       }

    }
  }

?>
