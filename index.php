<?php
  session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Galeria de Imagens</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- References: https://github.com/fancyapps/fancyBox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


</head>
<body>


<div class="container">


    <h3>Galeria</h3>
    <form action="imagemUpload.php" class="form-image-upload" method="POST" enctype="multipart/form-data">


        <?php if(!empty($_SESSION['error'])){ ?>
            <div class="alert alert-danger">
                <strong>Ops!</strong><br><br>
                <ul>
                    <li><?php echo $_SESSION['error']; ?></li>
                </ul>
            </div>
        <?php unset($_SESSION['error']); } ?>


        <?php if(!empty($_SESSION['success'])){ ?>
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $_SESSION['success']; ?></strong>
        </div>
        <?php unset($_SESSION['success']); } ?>


        <div class="row">
            <div class="col-md-5">
                <strong>Título</strong>
                <input type="text" name="titulo" class="form-control" placeholder="Título">
            </div>
            <div class="col-md-5">
                <strong>Imagem:</strong>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>


    </form> 


    <div class="row">
    <div class='list-group gallery'>


            <?php
            require_once('conexao.php');


            $sql = "SELECT * FROM imagem_galeria";
            $images = $mysqli->query($sql);


            while($imagem = $images->fetch_assoc()){


            ?>
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                    <a class="thumbnail fancybox" rel="ligthbox" href="uploads/<?php echo $imagem['imagem'] ?>">
                        <img class="img-responsive" alt="" src="uploads/<?php echo $imagem['imagem'] ?>" />
                        <div class='text-center'>
                            <small class='text-muted'><?php echo $imagem['titulo'] ?></small>
                        </div> 
                    </a>
                    <form action="imagemDelete.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $imagem['id'] ?>">
                    <button type="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                    </form>
                </div> 
            <?php } ?>


        </div> 
    </div> 
</div>


</body>


<script type="text/javascript">
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
</script>
</html>
