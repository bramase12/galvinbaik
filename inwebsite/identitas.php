<?php include "databases/dataadmin.php"?>
<div class="card-container" style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content:center;padding-top: 5rem; text-align: center;">
  <div class="card" style="width: 18rem; padding: 1rem;">
      <img src="#" class="card-img-top" alt="#">
      <div class="card-body">
          <h5 class="card-title"><?php echo $dataadmin[0]["nama"]?></h5>
          <p class="card-text"><?php echo $dataadmin[0]["role"]?></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
  </div>
  <div class="card" style="width: 18rem; padding: 1rem;">
      <img src="assets/BramaNahida.png" class="card-img-top" alt="#">
      <div class="card-body">
          <h5 class="card-title"><?php echo $dataadmin[1]["nama"]?></h5>
          <p class="card-text"><?php echo $dataadmin[1]["role"]?></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
  </div>
  <div class="card" style="width: 18rem; padding: 1rem;">
      <img src="#" class="card-img-top" alt="#">
      <div class="card-body">
          <h5 class="card-title"><?php echo $dataadmin[2]["nama"]?></h5>
          <p class="card-text"><?php echo $dataadmin[2]["role"]?></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
  </div>
  <div class="card" style="width: 18rem; padding: 1rem;">
      <img src="assets/FaizPP.jpeg" class="card-img-top" alt="faiz.jpg">
      <div class="card-body">
          <h5 class="card-title"><?php echo $dataadmin[3]["nama"]?></h5>
          <p class="card-text"><?php echo $dataadmin[3]["role"]?>r</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
  </div>
  <div class="card" style="width: 18rem; padding: 1rem;">
      <img src="#" class="card-img-top" alt="#">
      <div class="card-body">
          <h5 class="card-title"><?php echo $dataadmin[4]["nama"]?></h5>
          <p class="card-text"><?php echo $dataadmin[4]["role"]?></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
  </div>
</div>