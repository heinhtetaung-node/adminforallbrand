<?php 
$user=$this->session->userdata('login_id');
$brandjson=$user['brand_ids'];
$brandids=json_decode($brandjson);

$host=$_SERVER['HTTP_HOST'];

$hostbrand_name="";
$hostbrand_id="";

$jnbk=strpos($host,'jnbk');
if($jnbk==""){
	foreach($brandids as $b){
		$brand=strpos($host,$b->brand_name);
		if($brand!=""){
			$hostbrand_name=$b->brand_name;
			$hostbrand_id=$b->brand_id;
		}
	}

	if($hostbrand_name==""){
		echo "You have no permission here";
		exit;
	}
}
//echo $hostbrand_id; exit;
?>
<style>
	.bannerbox{
		min-height:200px; 
		height:auto;
	}
	
</style>
<div id="content">
	<div class="well">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> JNBK Brand Websites</h1>
			</div>	
		</div>
	
		
		<div class="row" style="min-height:500px">
			
			<?php 
			$user=$this->session->userdata('login_id');
			$brandjson=$user['brand_ids'];
			$brandids=json_decode($brandjson);
			foreach($brandids as $b){ 
			if($b->brand_name=='jsfilter' || $b->brand_name=='nibk' || $b->brand_name=='jikiu' || $b->brand_name=='sbparts'){ 
			if($jnbk!="" || $hostbrand_name==$b->brand_name){ ?>
			<div class="col-md-3 bannerbox">
				<div class="well well-sm well-light">
					<div class="col-md-12" style="padding:0px; margin-left:10px; height:100px">
						<?php if($b->brand_name=='jsfilter'){ ?>
									<img src="<?php echo base_url(); ?>assets/img/myimg/JS-Asakashi.jpg" style="width:100px";>
						<?php } ?>
						<?php if($b->brand_name=='nibk'){ ?>
									<img src="<?php echo base_url(); ?>assets/img/myimg/Logo.png" style="width: 120px;margin-top: 15px;">
						<?php } ?>
						<?php if($b->brand_name=='jikiu'){ ?>
									<img src="<?php echo base_url(); ?>assets/img/myimg/img-footer-logo.png" style="width: 75px; margin-top: 10px">
						<?php } ?>
						<?php if($b->brand_name=='sbparts'){ ?>
									<img src="<?php echo base_url(); ?>assets/img/myimg/img-logo.png" style="width: 100px; margin-top: 10px;">
						<?php } ?>
					</div>
					<a href="<?php echo base_url(); ?>#/news/<?php echo $b->brand_id; ?>">
					<div class="btn btn-default" style="margin-left:10px;" title="News">
						<i class="fa fa-info-circle"></i>
					</div>
					</a>
					<a href="<?php echo base_url(); ?>#/post/<?php echo $b->brand_id; ?>">
					<div class="btn btn-default" title="Post">
						<i class="glyphicon glyphicon-pushpin"></i>
					</div>
					</a>
					<a href="<?php echo base_url(); ?>#/category/<?php echo $b->brand_id; ?>">
					<div class="btn btn-default" title="Category">
						<i class="fa fa-list-ul"></i>
					</div>
					</a>
					<a href="<?php echo base_url(); ?>#/language">
					<div class="btn btn-default" title="Language">
						<i class="fa fa-language"></i>
					</div>
					</a>
					<a href="<?php echo base_url(); ?>#/supplier/<?php echo $b->brand_id; ?>">
					<div class="btn btn-default" title="Supplier">
						<i class="fa fa-support"></i>
					</div>
					</a>
				</div>
			</div>
			<?php 
			}
			}
			}
			?>
		</div>
		
	</div>
</div>

