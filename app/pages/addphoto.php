<?php
parse_str($page, $params);
$id = $params['addphoto?id'] ?? '';
echo $id;



?>
<form id="uploadForm" action="utils/addphotos.php" method="POST" enctype="multipart/form-data">
     <input type="text" name="id" value="<?php echo $id ?>" hidden>
     <input type="file" name="images[]" multiple accept="image/png" max="4" required>
     <input type="submit" value="Upload">
</form>