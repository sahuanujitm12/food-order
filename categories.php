 <?php include("partials-front/menu.php"); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //display all the categories that are active
                //sql query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count row
                $count = mysqli_num_rows($res);

                //check whether category available or not
                

            ?>

            
            <div class="box-3 float-container">
                <img src="http://localhost/Food_order/images/Food-Name-5989.jpg" alt="" width="400px" height="300px" class="img-responsive img-curve">
                <h3 class="float-text text-white">North Indian</h3>
            </div>

            <div class="box-3 float-container">
                <img src="http://localhost/Food_order/images/south indian dosa.jpg" alt="" width="400px" height="300px" class="img-responsive img-curve">
                <h3 class="float-text text-white">South Indian</h3>
            </div>
            <div class="box-3 float-container">
                <img src="http://localhost/Food_order/images/chinese.jpg" alt="" width="400px" height="300px"  class="img-responsive img-curve">
                <h3 class="float-text text-white">Chinese</h3>
            </div>


     

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

 <?php include("partials-front/footer.php"); ?>