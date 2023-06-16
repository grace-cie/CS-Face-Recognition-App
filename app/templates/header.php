<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>
          <?php echo (isset($data['title']) ? $data['title'] : 'Login') ?>
     </title>
     <?php if (isset($css)): ?>
          <?php foreach ($css as $key => $new_css) { ?>
               <?php if (strpos($new_css, '.css')) { ?>
                    <link href="<?php echo $new_css ?>" rel="stylesheet">
               <?php } else { ?>
                    <?php if (strpos($new_css, 'face')) { ?>
                         <script defer src="<?php echo $new_css ?>"></script>
                    <?php } else { ?>
                         <script src="<?php echo $new_css ?>"></script>
                    <?php } ?>
               <?php } ?>
          <?php } ?>
     <?php endif; ?>
     <!-- <link rel="icon" href="assets/images/favicon.ico"> -->
</head>

<body>
     <?php if (isset($_SESSION['user']))
          require "templates/nav.php" ?>