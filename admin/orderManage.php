<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YOUR ORDER</title>
    <link rel = "icon" href ="/cafe_management_system/admin/assetsForSideBar/img/Logo.jpg" type = "image/x-icon">

    <!--CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/cafe_management_system/admin/assetsForSideBar/css/styles.css">
    <link rel="stylesheet" href="/cafe_management_system/admin/assetsForSideBar/css/responsive_admin.css">

    <style>
        /* iPad Pro - Tablets and medium screens (up to 1024px) */
        @media (min-width: 432px) and (max-width: 1024px) {
            html, body {
            overflow-x: hidden; /* prevent vertical scroll */
            }
            .container {
                margin-top: 80px;
                padding: 20px;
            }

            .table-title {
                position: static; 
                width: 100%;      /* Optional: take full width */
                margin-left: 0;   /* Reset if needed */
                padding-top : 80px;

            }

            .table-wrapper {
                overflow-x: auto;
            }

            .table-title .row {
                flex-wrap: wrap;
                padding-bottom: 0;
                padding: 20px;
            }
            
            .btn {
                margin: 5px;
                display: inline-block;
            }

            table {
                margin-top:10% !important;
                font-size: 24px;
            }

            .sidebar .l-navbar {
                width: 20%;
            }
        }
        /* iPhone 14 Pro Max - 430px */
        @media (max-width: 431px) {
            body, html {
                overflow-x: hidden;
            }

            .sidebar .l-navbar {
                width: 30px; /* reduce sidebar width */
            }

            .container {
                padding: 10px;
                margin-left: 20px; /* match sidebar width */
                margin-right: 0;
            }

            .table-title {
                position: static; 
                width: 100%;      /* Optional: take full width */
                margin-left: 0;   /* Reset if needed */
                top: auto;        /* Reset */
            }

            .table-wrapper {
                overflow-y: hidden;
                overflow-x: auto;
                width: 100%;
                padding-top: 60px; /* adjust to match height of fixed title */

            }

            table {
                font-size: 14px; /* reduce font size */                
            }

            .table-title .row {
                gap: 10px;
                font-family: 10px;
                flex-wrap: wrap; /* wrap when needed */

            }
            .table-title h2 {
                font-size: 18px; 
            }
            .btn {
                font-size: 14px;
                display: inline-block;
                width: 40%;
                align-items: left;
            }
        }
    </style>
</head>

<body style="background-color: #fdf8f3;">
    <?php 
        include("partial/_dbconnect.php");
    ?>
    <div class="container" style="margin-top: 98px;">
        <div class="table-wrapper">
            <div class="table-title" style="border-radius: 10px;">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Order <b>Details</b></h2>
                    </div>
                    <div class="col-sm-8">
                        <a href="" class="btn btn-primary">
                            <i class="fa-solid fa-arrows-rotate"></i>
                            <span>Referesh List</span>
                        </a>
                        <a href="#" onclick="window.print();" class="btn">
                            <i class="fa-solid fa-print"></i>
                            <span>Print</span>
                        </a>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover text-center" id="NoOrder" style="background: rgb(225, 221, 220);">
                <thead style="background: rgb(99, 85, 78);color:white;">
                    <tr>
                        <th>Order Id</th>
                        <th>User Id</th>
                        <th>Address</th>
                        <th>Phone no.</th>
                        <th>Amount</th>
                        <th>Payment Mode</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Items</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT * FROM orders";
                        $result=mysqli_query($conn,$sql);

                        $counter=0;

                        while($row=mysqli_fetch_array($result))
                        {
                            $userid = $row['user_id']; 
                            $orderid=$row['order_id'];
                            $address=$row['address'];
                            $zipcode=$row['zip_code'];
                            $phoneno=$row['phone_no'];
                            $amount=$row['amount'];
                            $orderdate=$row['order_date'];
                            $payment_mode=$row['payment_mode'];

                            $orderststus=$row['order_status'];
                            $counter++;

                            echo'<tr>
                                    <td>'.$orderid.'</td>
                                    <td>'.$userid.'</td>
                                    <td data-toggle="tooltip" title="'.$address.'">'.substr($address,0,20).'...</td>
                                    <td>'.$phoneno.'</td>
                                    <td>'.$amount.'</td>
                                    <td>'.$payment_mode.'</td>
                                    <td>'.$orderdate.'</td>
                                    <td><a href="#" data-toggle="modal" data-target="#orderStatus'.$orderid.'" class="view"><i class="fa-solid fa-arrow-right"></i></a></td>
                                    <td><a href="#" data-toggle="modal" title="viewDetails" data-target="#orderItem'.$orderid.'" class="view"><i class="fa-solid fa-arrow-right"></i></a></td> 
                                </tr>';
                        }

                        if($counter==0)
                        {
                            ?><script> document.getElementById("NoOrder").innerHTML='<div class="alert alert-dismissible fade show" role="alert" style="width:100%;background-color:rgb(250, 250, 250);">You Have Not Receive Any Order! </div>'</script>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
        include("partial/_orderItemModal.php");
        include("partial/_orderStatusModal.php");
    ?>

</body>

<script>
    $(document).ready(function(){
        $('[data-toggle = "tooltip"]').tooltip();
    });
</script>
</html>