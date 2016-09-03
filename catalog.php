<?php
$pageTitle = "Full Catalog";
$section = null; //Conditional for CSS class "on" set to null by default

if (isset($_GET["cat"])) {
    if ($_GET["cat"]=="books"){
      $pageTitle = "Books";
      $section = "books"; // Conditional for CSS Class "on"
    }else if($_GET["cat"]=="movies"){
      $pageTitle = "Movies";
      $section = "movies";
    }else if($_GET["cat"]=="music"){
      $pageTitle = "Music";
      $section = "music";
    }
}

?>

<?php include("inc/header.php"); ?>

<div class="section catalog pag">
  <div class="wrapper">
    <h1> <?php echo $pageTitle ?></h1>

    <ul>
      <?php
      foreach ($catalog as $item)
      {
        echo "<li> $item </li>";
      }
      ?>
    </ul>



  </div>

<?php include("inc/footer.php"); ?>
