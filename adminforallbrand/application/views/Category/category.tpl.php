<?php 
$user=$this->session->userdata('login_id');
$brandjson=$user['brand_ids'];
$brandids=json_decode($brandjson);
// !important change in server session
?>
<input type="hidden" ng-init="checkurl()">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/my_style.css">
<script src="<?php echo base_url(); ?>assets/js/common_script.js"></script><!-- first common -->
	
	
<div id="content" class="bodylayout" style="display:none"><!-- second common-->
	<div class="well">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4" ng-init="brandidsjson = <?php echo htmlspecialchars(json_encode($brandids,JSON_NUMERIC_CHECK)); ?>">
				<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Category Control Panel <span style="color: #4C4F53 !important;  margin: 12px 0px 28px;  letter-spacing:-1px; font-size: 24px; margin: 10px 0px; text-transform:capitalize"  ng-show="b.brand_id==para_brand_id" ng-repeat="b in brandidsjson">{{b.brand_name}}</span></h1>
			</div>	
		</div>
		<section id="widget-grid" class="">
			<div class="row">
				<article  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					
					<div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">

						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h3 class="h2style">&nbsp;  Category Table </h3>
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
												<input ng-model="search" ng-change="filter()" placeholder="Filter" style="max-width:140px" class="form-control" type="search"><!-- third common -->
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
									
									<div class="col-sm-6 col-xs-6 customres but">
										<div class="ColVis">
											<button id="flip" class="ColVis_Button ColVis_MasterButton"><span>Add New</span></button>
										</div>
									</div>
									<!-- fourth common success warning and add new -->
									
								</div>
								
								
								<!-- fifth common form panel -->
								<div class="table-responsive" id="panel" >
									<table class="table table-hover">
										<tbody>
											<tr>	
												<td style="width:50%" ng-init="getlanguages('tbl_language')">
													<select ng-model="language_id" id="language_id" class="form-control">
														<option ng-selected="true">Select Language</option>
														<option ng-repeat="l in languages" value="{{l.language_id}}">{{l.language_name}}</option>
													</select>
												</td>
												<td style="width:50%">
													
													<select class="form-control" id="brand_id" placeholder="Select Brand" ng-model="brand_id">
														<option ng-selected="para_brand_id==''">Select Brand</option>
														<?php foreach($brandids as $b){ ?>
															<option value="<?php echo $b->brand_id; ?>" ng-hide="para_brand_id!='' && para_brand_id!=<?php echo $b->brand_id; ?>"><?php echo $b->brand_name; ?></option>
														<?php } ?>
													</select>
												</td>
											</tr>
											<tr>
												<td>
													<input type="text" class="form-control" id="category_name" ng-model="category_name" ng-keyup="checkenter($event)" placeholder="Category">
												</td>
												<td>
													<a class="btn btn-primary btn-sm" ng-click="savedata('tbl_category')">Add</a> 
													<a class="btn btn-default btn-sm" id="cancel">Cancel</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- common form panel -->
								
								
								
								<div ng-show="datas.length!=0"  class="table-responsive s1"> <!-- six common -->
								<!--
								SELECT `category_id`, `language_id`, `brand_id`, `category_name`, ``, ``, `status`, `` FROM `tbl_category` WHERE 1
								-->
								<table  id="tbl" ng-init="getdatas('tbl_category')" class="table table-striped table-bordered table-hover" width="100%">
									<thead>			                
										<tr>
											<th class="hideinsmall idrow" ng-click="sortField = 'category_id'; reverse = !reverse"> <a href="">ID</a></th>
											<th ng-click="sortField = 'category_name'; reverse = !reverse"> <a href="">Category</a></th>
											<th ng-click="sortField = 'language_name'; reverse = !reverse"><i class="fa fa-user text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Language</a></th>
											<th ng-click="sortField = 'brand_name'; reverse = !reverse"><i class="fa fa-key text-muted hidden-md hidden-sm hidden-xs"></i> Brand</th>
											<th ng-click="sortField = 'credated_date'; reverse = !reverse" class="hideinsmall"><i class="fa fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Created</a></th>
											<th ng-click="sortField = 'status'; reverse = !reverse" class=""><i class="fa fa-flag text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Status</a></th>
											<th class="option"><i class="fa fa-gear text-muted hidden-md hidden-sm hidden-xs"></i> Option</th>
										</tr>
									</thead>
									<tbody>
									
										<tr id="{{datas.category_id}}" tr-id="{{datas.category_id}}" ng-repeat="datas in filtered = (datas | filter:search | orderBy : sortField :reverse |  startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit)" ng-hide="para_brand_id !='' && para_brand_id!=datas.brand_id">
											<td class="hideinsmall idrow">{{datas.category_id}}</td>
											
											<td class="editable category_name">{{datas.category_name}}</td>
											<td class="hasinput"><input value="{{datas.category_name}}" class="form-control category_nametxt" type="text"></td>
											
											<td class="editable language_name">{{datas.language_name}}</td>
											<td class="hasinput">
												<select class="form-control language_idsel">
													<option ng-selected="l.language_id==datas.language_id" ng-repeat="l in languages" value="{{l.language_id}}">{{l.language_name}}</option>
												</select>
											</td>
											
											<td class="editable brand_name">{{datas.brand_name}}</td>
											<td class="hasinput">
												<select class="form-control brand_idsel">
												<?php foreach($brandids as $b){ ?>
													<option ng-selected="<?php echo $b->brand_id; ?>==datas.brand_id" value="<?php echo $b->brand_id; ?>"><?php echo $b->brand_name; ?></option>
												<?php } ?>
												</select>
											</td>
											
											<td class="hideinsmall">{{datas.credated_date}}</td>
											
											<td class="editable activetxt">
												<span class="{{(datas.status == 1) ? 'label label-success' : 'label label-danger'}}">
													{{(datas.status == 1) ? 'active' : 'disable'}}
												</span>
											</td>
											
											<td class="hasinput hideinsmall">
												<span class="onoffswitch">
													<input name="start_interval{{datas.category_id}}" class="onoffswitch-checkbox" id="st{{datas.category_id}}" type="checkbox" ng-checked="datas.status==1">
													<label class="onoffswitch-label" for="st{{datas.category_id}}">
														<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</span>
											</td>
											
											<td class="option">
												<a href="" class="fa fa-edit"></a><a href=""  class="fa fa-save"></a> &nbsp;
												<a href="" ng-click="deletedata(datas.category_id, 'tbl_category', 'category_id')" class="fa fa-times-circle"></a> 
												<a href="" class="fa fa-undo"></a> &nbsp;
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
			</div>
		</section>
		
	</div>
</div>



<script type="text/javascript">
$(document).ready(function() {
	pageSetUp();
})
</script>
