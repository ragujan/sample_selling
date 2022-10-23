<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT."/sampleSelling-master/util/path_config/global_link_files.php";
$style_path = GlobalLinkFiles::getDirectoryPath("style");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?=$style_path?>bootstrap.css"> 

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css"> -->

    <title>Upload_Samples</title>
</head>

<body>
    <span class="text-dark">SampleName</span>
    <input type="text" id="sampleName">
    <span class="text-dark">SamplePrice</span>
    <input type="text" id="samplePrice">
    <br>
    <span class="text-dark">SampleType</span>
    <select name="" id="sampleType">
        <option value="null">"   " </option>

        <?php
        require "../query/sample_queries.php";
        $object = new SampleQueries();
        $sampleDB = $object->showSampleTypes();
        print_r($sampleDB); 
        echo "hllo";
        $typenum_rows = count($sampleDB);
        if ($typenum_rows > 0) {
            for ($i = 0; $i < $typenum_rows; $i++) {
                $typenamerow =$sampleDB;
                $typename = $typenamerow[$i]["typeName"];
                $typenameID = $typenamerow[$i]["sampleTypeID"];
        ?>
                <option value="<?php echo $typenameID; ?>"><?php echo $typename; ?></option>
        <?php
            }
        }
        ?>




    </select>
    <br>
    <div id="mtDIV" class="d-none">


    </div>

     <div>
         <textarea name="" id="sampleDescription" cols="30" rows="10"></textarea>
     </div>

    <br>
    <span class="text-dark">File</span>
    <input type="file" id="sampleFile"> <button id="uploadFileOnly">UploadZipFile</button>
    <br>
    <span class="text-dark">SampleAudio</span>
    <input type="file" id="sampleAudio"> <button id="uploadAudioOnly">UploadAudioSample</button>
    <br>
    <span class="text-dark">Image</span>
    <input type="file" id="sampleImage"> <button id="uploadImageOnly">UploadImage</button>
    <br>
    <button class="text-dark" id="uploadbutton">Upload</button>
    <div id="showmessage">

</div>
    <script src="script.js"></script>
</body>

</html>