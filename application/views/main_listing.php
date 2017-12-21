<html>
<?php
if($this->session->userdata('username') !=''){
$username = $this->session->userdata('username');
$email = $this->session->userdata('email');
} 
//print_r($user_id);die(); 
?>
<div id="w">

<div> item sku</div>
    <?php foreach($listings as $listing): ?>
        <li><?php echo $listing['item_sku']; ?></li>
    <?php endforeach; ?>
    </ul>

      


  </div><!-- @end #w -->
