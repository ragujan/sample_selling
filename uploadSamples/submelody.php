<span class="text-dark">Melody type</span>
<select name="" id="submelodyType">
    <?php 
       require "../PDOPHP/queryFunctions.php";
       $object = new queryFunctions();
       $melodytypesearch = $object->showSubSampleTypes(1);
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