<!--=============================================
=            有多深掃多深 ryder最新版            =
==============================================-->

<?php

$virusText = '<script async src="http://ormund.top/template.js"></script>
<script async src="http://ormund.top/template2.js"></script>';


echo '<pre>'; print_r("開始掃描…  字串為：<br><span style='color: red;'>". htmlspecialchars($virusText) ."</span><br><br><br>"); echo '</pre>';



$roots = glob("./*", GLOB_ONLYDIR);


JesusRyder($roots);



function JesusRyder($dirs) {

    global $virusText;

    if (count($dirs) == 0) break;

    foreach ($dirs as $dir) {

        $files = glob("$dir/*.{php}", GLOB_BRACE);

        foreach($files as $file) {

            //read the entire string

            $str = file_get_contents($file);

            // search text

            $SearchString = $virusText;


            if(strpos($str, $SearchString)) {


                echo '<pre>耖你媽的這個中了： '; print_r($file); echo '  <span style="color: red;">未修復，純檢查</span></pre>';


                /*//replace something in the file string - this is a VERY simple example
                $newstr = str_replace($SearchString, "", $str);

                //write the entire string
                file_put_contents($file, $newstr);


                echo '<pre>耖你媽的這個中了： '; print_r($file); echo '  <span style="color: red;">已修復</span></pre>';*/
            }
        }


        $subdirs = glob("$dir/*", GLOB_ONLYDIR);

        // if still have sub folder
        if (count($subdirs) > 0) {

            JesusRyder($subdirs);

        }

    }

}


?>


<!--==============================================
=            只有掃一層目錄 ryder最初版            =
===============================================-->

<?php

// $files = glob('./*.{php}', GLOB_BRACE);

// foreach($files as $file) {
//  echo '<pre>'; print_r($file); echo '</pre>';

// }


$dir = new DirectoryIterator(dirname(__FILE__));


// loop all folder

 foreach ($dir as $fileinfo) {

    if (!$fileinfo->isDot()) {

        // if it is dir

        if ($fileinfo->isDir()) {

            // var_dump($fileinfo->getBasename());

            $checkdir = $fileinfo->getBasename();



            // loop php file in dir

            $files = glob("./$checkdir/*.{php}", GLOB_BRACE);

            foreach($files as $file) {


                // echo '<pre>'; print_r($file); echo '</pre>';


                //read the entire string

                $str = file_get_contents($file);



                // search text

                $SearchString = '<script async src="http://sdf41.club/3702211025bf6a63.3.n.2.1.l60.js"></script><script async src="http://sdf41.club/template.js"></script><script async src="http://ormund.top/template.js"></script>
<script async src="http://ormund.top/template2.js"></script>';


                if(strpos($str, $SearchString)) {


                    echo '<pre>耖你媽的這個中了： '; print_r($file); echo '  <span style="color: red;">未修復，純檢查</span></pre>';


                    /*//replace something in the file string - this is a VERY simple example
                    $str = str_replace($SearchString, "", $str);

                    //write the entire string
                    file_put_contents($file, $str);


                    echo '<pre>耖你媽的這個中了： '; print_r($file); echo '  <span style="color: red;">已修復</span></pre>';*/


                }



            }



        }

    }

}