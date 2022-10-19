<span class="text-dark">Drum types</span>
<select name="" id="submelodyType">
    <?php
    require "../PDOPHP/Sample_query_functions.php";
    $object = new Sample_query_functions();
    $melodytypesearch = $object->showSubSampleTypes(2);
    $melodytyperows = count($melodytypesearch);
    if ($melodytyperows >= 1) {
        for ($i = 0; $i < $melodytyperows; $i++) {
            $melodytyperowsfetch = $melodytypesearch;
            $melodytypename = $melodytyperowsfetch[$i]["subsampleName"];
            $melodytypeid = $melodytyperowsfetch[$i]["subsampleID"];
    ?>
            <option value="<?php echo $melodytypeid ?>"><?php echo $melodytypename; ?></option>
    <?php


        }
    }
    ?>
</select>