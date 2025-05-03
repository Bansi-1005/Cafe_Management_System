<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site</title>

    <link rel = "icon" href ="/cafe_management_system/admin/assetsForSideBar/img/Logo.jpg" type = "image/x-icon">

    <link rel="stylesheet" href="/cafe_management_system/admin/assetsForSideBar/css/styles.css">
    <link rel="stylesheet" href="/cafe_management_system/admin/assetsForSideBar/css/responsive_admin.css">

    <style>
        .card {
            width: 80%; 
            margin: auto; 
        }

        /* html, body {
            max-width: 100%;
            overflow-x: hidden;
        } */

        /* iPad Pro 12.9" portrait (1024px width) */
        @media only screen 
        and (device-width: 1024px) 
        and (device-height: 1366px)
        and (orientation: portrait)
        and (-webkit-device-pixel-ratio: 2) {

            html, body {
                overflow: hidden;
                height: 100vh;
                margin: 0;
                padding: 0;
            }

            .container-fluid {
                padding-top: 15%;
                width: 80% !important;
            }

            .card {
                width: 100% !important;        /* Increased width */
                max-width: 700px;             /* Optional: keep it neat */
                height: auto !important;
                display: flex;
                flex-direction: column;
            }

            .card-header {
                padding: 10px;
                text-align: center;
            }

            .card-header h4 {
                font-size: 26px;
                margin: 0;
            }

            .card-body {
                flex: 1 1 auto;
                overflow-y: auto;
                padding: 25px;
            }

            .card-footer {
                padding: 20px;
                text-align: center;
            }

            .form-group {
                margin-bottom: 25px;
                width: 100%; 
            }

            .form-group label,
            .form-control {
                font-size: 18px;
                width: 100%; 
            }

            .btnupdate {
                font-size: 18px;
                padding: 14px 24px;
                width: 20%;  
            }
        }

        /* iPhone 14 Pro Max (430px width, high pixel ratio) */
        @media only screen 
        and (device-width: 430px) 
        and (device-height: 932px)
        and (-webkit-device-pixel-ratio: 3) {

            .card {
                width: 95% !important;
            }

            .form-group label,
            .form-control {
                font-size: 14px;
            }

            .btnupdate {
                font-size: 16px;
                padding: 10px;
                width: 30%;
            }

            .card-body {
                padding: 15px;
            }

            .card-header h4 {
                font-size: 18px;
            }
        }

    </style>    
</head>
<body style="background-color: #fdf8f3;">
    <?php
        $sql = "SELECT * FROM site";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        $systemName = $row['system_name'];
        $address = $row['address'];
        $email = $row['email'];
        $contact = $row['contact']; 
        
    ?>
    <div class="container-fluid" style="margin-top:98px;">
        <div class="card col-lg-6 p-0">
            <div class="card-header" style="background-color: rgb(99, 85, 78); color:white;font-weight:bold;">
                <h4 class="text-center" style="margin-top: 8px;"><?php echo $systemName; ?></h4>
            </div>
            <div class="card-body">
                <form action="partial/_siteManage.php" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">System Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $systemName; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact" class="control-label">Contact No.:</label>
                        <input type="tel" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
                    </div>
                    <div class="card-footer" style="background-color:rgb(99, 85, 78); ">
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <button name="updateDetail" class="btnupdate btn">Save</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>