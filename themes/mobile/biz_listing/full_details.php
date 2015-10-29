<h2 class="helvetica18 float-left margin-top20" >Business Description</h2>
<p class="margin-bottom10"><?php echo $results[0]->description ?></p>
<h2 class="helvetica18 float-left margin-top20" >About the Business</h2>
<p class="margin-bottom5"><strong>Year Established:</strong> <?php echo $results[0]->year_established ?></p>
<p class="margin-bottom5"><strong>Number of Employees:</strong> <?php echo $results[0]->employees ?> </p>
<p class="margin-bottom5"><strong>Facilities:</strong> <?php echo $results[0]->facilities ?> </p>
<p class="margin-bottom5"><strong>Market Outlook/Competition:</strong> <?php echo $results[0]->mkt_outlook_cmp ?> </p>
<h2 class="helvetica18 float-left margin-top20" >About the Business</h2>
<p class="margin-bottom5"><strong>Reason For Selling:</strong> <?php echo $results[0]->selling_reason ?> </p>
<p class="margin-bottom5"><strong>Training/Support:</strong> <?php echo $results[0]->training_support ?> </p>
<p class="margin-bottom5"><strong>Seller Financing:</strong><?php echo $results[0]->seller_fincng_info ?> </p>
<h2 class="helvetica18 float-left margin-top20" >Attached Files <a href="#" class="global font13 fnt-ittalic">Attachment Disclaimer</a></h2>
<p class="float-left width100"> <img src="<?php echo $this->template->get_frontend_image()?>project.jpg" class="float-left" /><span class="float-left margin-left10 colr999 margin-top5 margin-right20"> needbiznow-seller.jpg</span> <a href="<?php echo base_url(); ?>biz_listing/download?file=<?php echo showImage($results[0]->image_information, 1,1,'bizlisting/business4sale.png')?>"  class="global font13 fnt-ittalic margin-top5 float-left margin-right20">Download</a>   

<?php 
  $img = showImage($results[0]->image_information, 2, 1,'bizlisting/business4sale.png');
  $i =0;
foreach($img as $imgvalue)
{
?>
<a href="<?php echo $this->template->get_frontend_image(isset($results[0]->image_information)?$imgvalue : 'bizlisting/no.jpg')?>" rel="lightbox[roadtrip]" title="<?php echo $results[0]->headline?> image" class="global font13 fnt-ittalic margin-top5 float-left" id="box_<?php echo $i ?>" data-reveal-id="myModal" style="display: none;">View</a>
<?php
$i++;
}
?>
 </p>

<a href="javascript:void(0)" target="_self" class="global3 margin-top20 padding-bottom5 padding-top5 padding-left20 padding-right20 float-left font14" id="clk">Contact Seller</a>
<p class="width100 float-left brdr-top-dot padding-bottom20 margin-top25"><?php echo anchor( 'biz_listing/', _e( 'Sell Your Business' ), array( 'title' => _e( 'Sell Your Business' ) ) )?> | This listing has been viewed <?php echo $biz_hit_count ?> times </p>


<div class="float-left margin-top25 pos-rel">
 
      <?php echo $details_slider ?>
  
  <p>The information on this listing has been provided by either the seller or a business user_category representing the seller. BizQuest has no interest or stake in the sale of this business and has not verified any of the information and assumes no responsibility for its accuracy, veracity, or completeness.Please review our full Terms & Conditions here.</p>
</div>




</div>
<div class="width206 float-right margin-left25">
   <?php echo $get_popular_search_sidebar; ?>

   <?php echo $get_popular_county_search_sidebar; ?>
  <div class="bg-grey float-left">
    <h2 class="bg-seperator helvetica14 text-center padding-bottom5">Search Florida Auto Dealers Sold or Off-Market Business</h2>
    <div class="right-listing-type1 float-left">
      <ul>
        <li>Florida Auto Dealers Off-Market Businesses</li>
      </ul>
    </div>
  </div>
  <div class="float-left margin-top30 margin-left5"><a href="#" target="_self"><img src="<?php echo $this->template->get_frontend_image()?>24v.png" /></a></div>
</div>
</div>
</div>
</div>
</div>
<!--body end--> 
<?php 
	$js = $this->template->frontend_view( 'details_js', '', true, "biz_listing");
	$this->template->embed_asset_code('frontend', 'js', 'details-js', $js);
	?>