<span class="text-dark">Drum types</span>
<select name="" id="submelodyType">
    <?php 
    require "DB\DB.php";
    $melodytypesearch = DB::forsearch("SELECT * FROM `subsampletype` WHERE `sampleTypeID` IN (SELECT `sampleTypeID` FROM sampletype WHERE `sampleTypeID`='2') ;");
    $melodytyperows = $melodytypesearch->num_rows;
    if ($melodytyperows >= 1) {
        for ($i = 0; $i < $melodytyperows; $i++) {
            $melodytyperowsfetch = $melodytypesearch->fetch_assoc();
            $melodytypename = $melodytyperowsfetch["subsampleName"];
            $melodytypeid = $melodytyperowsfetch["subsampleID"];
    ?>
            <option value="<?php echo $melodytypeid ?>"><?php echo $melodytypename; ?></option>
    <?php


        }
    }
    ?>
</select>