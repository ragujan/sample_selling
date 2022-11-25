     <?php
     $unique_id = $_POST["unique_id"] ;
     $dnt = $_POST["dnt"];
     
     ?>
      
      <form action="authorize_download_process.php" onsubmit="return downloadConfirm('sdd');" method="post">
              <input type="text" name="unique_id" value="<?php echo $unique_id ?>">
              <input type="text" name="dnt" value="<?php echo $dnt ?>">
              <button type="submit">Download the product</button>
          </form>