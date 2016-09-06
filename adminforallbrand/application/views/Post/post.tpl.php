<?php 
$user=$this->session->userdata('login_id');
$brandjson=$user['brand_ids'];
$brandids=json_decode($brandjson);
?>
<input type="hidden" ng-init="checkurl()">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/my_style.css">

<style>
	@media (min-width: 1200px) {
		.editedres1{
			padding-right:3px;
		}
		.editedres2{
			padding-left:3px;
		}
	}
	.inputradio{
		vertical-align: middle; 
		margin-top:0px !important;
		cursor:pointer;
	}
	
	
</style>
<div id="content" class="bodylayout" style="display:none"><!-- second common-->
	
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4" ng-init="brandidsjson = <?php echo htmlspecialchars(json_encode($brandids,JSON_NUMERIC_CHECK)); ?>">
			<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Post Control Panel <span style="color: #4C4F53 !important;  margin: 12px 0px 28px;  letter-spacing:-1px; font-size: 24px; margin: 10px 0px; text-transform:capitalize"  ng-show="b.brand_id==para_brand_id" ng-repeat="b in brandidsjson">{{b.brand_name}}</span></h1>
		</div>	
	</div>
	<section id="widget-grid">
		<div class="row">
			<article  class="col-xs-12 col-sm-12 col-md-12 col-lg-6 editedres1">
				
				<div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">

					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h3 class="h2style">&nbsp;  Post List </h3>
					</header>
		
					<div>
						<div class="jarviswidget-editbox">
						</div>
						<div class="widget-body no-padding">
							<div class="dt-toolbar">
								<div class="col-xs-12 col-sm-6 customres">
									<div class="dataTables_filter" id="datatable_col_reorder_filter">
										<label>
											<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span> 
											<!-- today edit 19 Jan --><input ng-model="search1" ng-change="filter()" placeholder="Filter" style="max-width:140px" class="form-control" type="search"><!-- third common -->
										</label>
									</div>
								</div>
								
								<!-- fourth common success warning and add new -->
								<div id="successbox" style="display:none" class="alert alert-success alertbox">		
									<button class="close" data-dismiss="alert">
										×
									</button>
									<i class="fa-fw fa fa-check"></i>
									<strong>Success</strong> Data has been executed.
								</div>
								
								<div id="loadingbox" style="display:none" class="alert alert-warning alertbox">
									<button class="close" data-dismiss="alert">
										×
									</button>
									<i class="fa-fw fa fa-check"></i>
									<strong>Loading</strong> Please wait a little while...
								</div>
								
								<div id="removebox" style="display:none" class="alert alert-danger alertbox">
									<button class="close" data-dismiss="alert">
										×
									</button>
									<i class="fa-fw fa fa-check"></i>
									<strong>Success</strong> Data has been removed.
								</div>
								
								
								<!-- fourth common success warning and add new -->
								<!-- today edit 19 Jan -->
								<div class="ColVis">
									
									<div class="form-group">
										<select required  placeholder="Select Brand" ng-model="search2" class="form-control">
											<option value="" ng-selected="true">All Brand</option>
											<?php foreach($brandids as $b){ ?>
												<option ng-hide="para_brand_id !='' && para_brand_id!=<?php echo $b->brand_id; ?>" value="<?php echo $b->brand_id; ?>"><?php echo $b->brand_name; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<!-- today edit 19 Jan -->
								
							</div>
							
							
							
							<div ng-show="datas.length!=0"  class="table-responsive s1"> <!-- six common -->
							<table  id="tbl" ng-init="getdatas('tbl_post')" class="table table-hover" width="100%">
								<thead>			                
									<tr>
										<th class="hideinsmall idrow" ng-click="sortField = 'post_id'; reverse = !reverse"> <a href="">ID</a></th>
										<th class="" ng-click="sortField = 'brand_id'; reverse = !reverse"> <a href="">Brand</a></th>
										<th ng-click="sortField = 'post_title'; reverse = !reverse"><i class="fa fa-user text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Title</th>
										<th style="width:12%" ng-click="sortField = 'status'; reverse = !reverse"><i class="fa fa-flag text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Status</a></th>
										<th style="width:12%" ng-click="sortField = 'created_date'; reverse = !reverse"><i class="fa fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Date</a></th>
										<th class="option"><i class="fa fa-gear text-muted hidden-md hidden-sm hidden-xs"></i> Option</th>
									</tr>
								</thead>
								<tbody>
									
									<tr id="{{datas.post_id}}" tr-id="{{datas.post_id}}" ng-repeat="datas in filtered = (datas | filter:{brand_id:search2, post_title:search1, post_description:search1} | orderBy : sortField :reverse |  startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit)" ng-hide="para_brand_id !='' && para_brand_id!=datas.brand_id">
									
										<td class="hideinsmall idrow">{{datas.post_id}}</td>
										<td class="capitalized">{{datas.brand_name}}</td>
										<td  class="">{{datas.post_title}}</td>
									
										<td  class="">
											<span class="{{(datas.status == 1) ? 'label label-success' : 'label label-danger'}}">
												{{(datas.status == 1) ? 'active' : 'disable'}}
											</span>
										</td>

										<td class="">{{datas.created_date}}</td>
										
										<td class="option">
											<a href="" ng-click="prepareedit(datas.post_id)" class="fa fa-edit"></a> &nbsp;
											<a href="" ng-click="deletedata(datas.post_id, 'tbl_post', 'post_id')" class="fa fa-times-circle"></a> 
										</td>
									</tr>
									
								</tbody>
								<tfoot>
								<!--
									<tr>
										<td colspan="4" data-original-title="Add new row" title="" id="jqgrid_iladd" class="ui-pg-button ui-corner-all"><div class="btn btn-sm btn-primary"><span class="fa fa-plus"></span></div></td>
									</tr>
								-->
								</tfoot>
							</table>
							</div>
							
							<div class="dt-toolbar"><!-- eight common -->
								<div class="col-xs-12 col-sm-6 customres">
									<div class="dataTables_filter" id="">
										<a href=""><div pagination="" page="currentPage" on-select-page="setPage(page)" first-text="«" last-text="»" max-size="1" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="‹" next-text="›"></div></a>
									</div>
								</div>
								
								<div class="col-sm-6 col-xs-6 customres but">
									<div class="ColVis">
										<select ng-model="entryLimit" style="width: 70px;float: right; margin-top:17px" class="form-control">
											<option>5</option>
											<option>10</option>
											<option>20</option>
											<option>50</option>
											<option>100</option>
										</select>
									</div>
								</div>
							</div>
						</div>			
					</div>	
				</div>
			</article>
			
			
			<article  class="col-xs-12 col-sm-12 col-md-12 col-lg-6 editedres2">
				
				<div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-2" data-widget-deletebutton="false" data-widget-editbutton="false">

					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h3 class="h2style">&nbsp;  Post Form </h3>
					</header>
		
					<div>
						<div class="jarviswidget-editbox">
						</div>
						<div class="widget-body no-padding">
							<div class="col-md-12">
							<form id="myform" style="margin-top:10px;" enctype="multipart/form-data" action="<?php echo base_url().'Crud/uploadphoto'; ?>">
								<div style="background-color:#dedede; width:177px" class="imgarea" id="photoshow">
									<a href="<?php echo base_url().'userupload/'; ?>{{ post_img }}" target="_blank"><img id="imgid" src="<?php echo base_url().'userupload/'; ?>default.png" style="width:177px; height:125px"></a>
								</div>
								
								<input type="hidden" id="photoname" name="photoname">
								<input type="file" id="file_input1"  class="imgfile" name="photo"  style="display: none;">
								
								<div style="width:177px; margin-right:10px;margin-bottom:30px;" class="input-group">
								
									<input id="post_img"  ng-model="post_img"  type="text" class="form-control" placeholder="select file..." disabled="">
									
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" onclick="$('#file_input1').click();">
											<i class="glyphicon glyphicon-folder-open"></i>
										</button>
									</span>
								</div>
							</form>
								
							<form role="form" ng-submit="savedata()" >
								
								<!--
								SELECT `post_id`, `language_id`, `category_id`, `post_title`, `post_description`, `status`, `brand_id`, `created_date` FROM `tbl_post` WHERE 1
								-->
								<div class="form-group">
									<label>Select Brand</label>
									<select ng-change="changecat()" required id="brand_id" placeholder="Select Brand" ng-model="brand_id" class="form-control">
										<?php foreach($brandids as $b){ ?>
											<option ng-hide="para_brand_id !='' && para_brand_id!=<?php echo $b->brand_id; ?>" value="<?php echo $b->brand_id; ?>"><?php echo $b->brand_name; ?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="form-group" ng-init="getdatasforselect('tbl_language')">
									<label>Select Language</label>
									<select required ng-model="language_id" id="language_id" class="form-control">
										<option ng-repeat="l in languages" value="{{l.language_id}}">{{l.language_name}}</option>
									</select>
								</div>
								
								<div class="form-group" ng-init="getdatasforselect('tbl_category')">
									<label>Select Category</label>
									<select required ng-model="category_id" id="category_id" class="form-control">
										<option ng-hide="brand_id != l.brand_id" ng-repeat="l in categories" value="{{l.category_id}}">{{l.category_name}}</option>
									</select>
								</div>
								
								<div class="form-group">
									<label>Title</label>
									<input required ng-model="post_title" type="text" class="form-control" placeholder="Enter ...">
								</div>
								
								<div class="form-group">
									<label>Description</label>
									
									<textarea  required ng-model="post_description" id="editor1" name="editor1" rows="10" cols="80" class="form-control" style="width:100%; min-height:500px;" placeholder="Place some text here"></textarea>                      							
								</div>
								
								<div class="form-group">
									<label>Status : &nbsp; &nbsp; </label>
									
									<input ng-checked="'true'" class="inputradio" type="radio" value="1" ng-model="post_status.selectvalue"> Active &nbsp; &nbsp;  <input class="inputradio"  type="radio" value="0" ng-model="post_status.selectvalue"> Disable
									
								</div>
								
								<input type="hidden"  ng-model="post_id" >
								
								<div class="form-group">
									<button type="submit" class="btn btn-primary">
										Submit
									</button>
									<button type="button" class="btn btn-default" ng-click="canceldata()">
										Reset
									</button>
								</div>
							</form>
							</div>
							
						</div>		
					</div>	
				</div>
			</article>
		</div>
	</section>
		
	
</div>

<script type="text/javascript">
$(document).ready(function() {
	pageSetUp();
})
</script>

<div id="content" class="bodylayout" style="display:none"><!-- second common-->

<script src="<?php echo base_url();?>assets/app/imageupload.js" type="text/javascript"></script>

<script>

$(function(){
	
    $('#file_input1').change(function() {
	
		
		
		$("#imgid").attr("src", "<?php echo base_url(); ?>assets/img/myimg/loading.gif");
		
		$("#myform").ajaxForm({
			
			//target: '#photoshow1'  writing code in php
			success : function(data){
			
				var data=data.substr(1, data.length-2);
					
				$("#imgid").attr("src", "<?php echo base_url(); ?>userupload/"+data);
				
				$('#photoname').val(data);
				$('#post_img').val(data);
		
				//alert(data);
			}
		}).submit();
		
    });
	
});

</script>


<script type="text/javascript">
	$(function() {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace('editor1');
		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5();
	});
</script>