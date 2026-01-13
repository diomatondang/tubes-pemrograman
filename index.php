<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Laundry Ibu</title>
    <link rel="icon" type="image/x-icon" href="images/icon.png">
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
       <div class="row border rounded-5 p-3 bg-white shadow box-area">

       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
           <div class="featured-image mb-3">
            <img src="images/icon.png" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Laundry Apps</p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Kepercayaan Adalah Prioritas Kami.</small>
       </div> 

       <div class="col-md-6 right-box">
          <div class="row align-items-center p-4">
                <div class="header-text mb-4">
                     <h2>Selamat Datang!</h2>
                     <p>Klik tombol di bawah untuk masuk ke dashboard.</p>
                </div>

                <form action="main_pages .php" method="POST">
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Masuk ke Sistem</button>
                    </div>
                </form>
                
          </div>
       </div> 

      </div>
    </div>

</body>
</html>