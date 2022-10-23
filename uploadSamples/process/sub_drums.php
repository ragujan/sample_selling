<?php
$id = 2;
?>
<span class="text-dark">Drum types</span>
<select name="" id="submelodyType">
    <?php
    require "../query/sample_queries.php";
    $object = new SampleQueries();
    $melodytypesearch = $object->showSubSampleTypes($id);
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