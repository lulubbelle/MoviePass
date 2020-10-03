<?php
     include_once("header.php");
     include_once("nav.php");
?>

<main class="d-flex align-items-center justify-content-center height-100 mt-3">
     <?php if(isset($data)){
        var_dump($data);
        }?>
</main>

<?php
     include_once("footer.php")
?>
<div>

<script type="text/javascript">
let data = JSON.stringify('<?php echo $data?>');
console.log(data);

</script>