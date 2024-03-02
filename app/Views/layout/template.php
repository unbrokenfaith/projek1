<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title><?=$title;?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/icon/font-awesome/css/font-awesome.min.css" />
    <script src="https://kit.fontawesome.com/6d7da44072.js" crossorigin="anonymous"></script>


    <!-- Property Template Admin -->
    <!-- Custom fonts for this template-->
    <link href="<?=base_url();?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url();?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- FullCalendar CSS & JS -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/main.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/main.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js" integrity="sha256-8EcfIJRWyvnu/U0OsfCk05x1JGVmeC2a7sJQHrbWYSA=" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="<?=base_url();?>/assets/fullcalendar.css"> -->
    <!-- <link rel="stylesheet" href="<?=base_url();?>/assets/bootstrap.css"> -->
    <!-- <script src="assets/jquery.min.js"></script> -->


</head>

<body id="page-top">

    <?=$this->renderSection('content');?>


    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="<?=base_url('assets/js/');?>codeigniter.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


    <!-- Property Template Admin -->
    <!-- Bootstrap core JavaScript-->
    <!-- <script src="/vendor/jquery/jquery.min.js"></script> -->
    <script src="<?=base_url();?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url();?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url();?>/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="<?=base_url();?>/vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="<?=base_url();?>/js/demo/chart-area-demo.js"></script> -->
    <!-- <script src="<?=base_url();?>/js/demo/chart-pie-demo.js"></script> -->

    <!-- Sampul -->
    <script>
        function previewImg() {
            const Sampul = document.querySelector('#Sampul');
            const SampulLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');
    
            SampulLabel.textContent = Sampul.files[0].name;
    
            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(Sampul.files[0]);
    
            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

    </script>


    <!-- Sweetalert -->
    <script src="<?=base_url();?>/assets/js/sweetalert2.all.min.js"></script>
    <script src="<?=base_url();?>/assets/js/script.js"></script>



    <script src="<?=base_url();?>/assets/jquery-ui.min.js"></script>
    <script src="<?=base_url();?>/assets/moment.min.js"></script>
    <script src="<?=base_url();?>/assets/fullcalendar.min.js"></script>
</body>

</html>