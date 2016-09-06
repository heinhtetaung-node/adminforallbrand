<input type="hidden" ng-init="checkurl()">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/my_style.css">
<script src="<?php echo base_url(); ?>assets/js/common_script.js"></script><!-- first common -->


<div id="content" class="bodylayout" style="display:none"><!-- second common-->
	<div class="well">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Brands Control Panel</h1>
			</div>	
		</div>
		<section id="widget-grid" >
			<div class="row">
				<article  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					
					<div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">

						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h3 class="h2style">&nbsp;  Brands List </h3>
		
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
												<input ng-model="search" ng-change="filter()" placeholder="Filter" style="max-width:140px" class="form-control" type="search">
											</label>
										</div>
									</div>
									
									
									<!-- common success warning and add new -->
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
									<!-- common success warning and add new -->
									
								</div>
								
								
								
								<!-- common form panel -->
								<div class="table-responsive" style="width:100%; background-color:#F7F7F7" id="panel" >
									<table class="table table-hover" style="margin-bottom:0px; border-bottom:1px solid #ccc; ">
										<!--
										<tbody>
											<tr>	
												<td style="padding:5px; min-width:100px"><input type="text" class="form-control" placeholder="Brand Name"></td>
												<td style="padding:5px; min-width:100px"><input type="text" class="form-control" placeholder="Brand Name"></td>
												<td style="padding:5px; min-width:100px"><input type="text" class="form-control" placeholder="Brand Name"></td>
												<td style="padding:5px; min-width:100px"><input type="text" class="form-control" placeholder="Brand Name"></td>
												<td style="padding:5px; min-width:100px"><input type="text" class="form-control" placeholder="Brand Name"></td>
											</tr>


											<tr>	
												<td style="padding:4px; min-width:100px"><input type="text" class="form-control" placeholder="Brand Name"></td>
												<td style="padding:4px; min-width:100px"><input type="text" class="form-control" placeholder="Brand Name"></td>
												<td style="padding:4px; min-width:100px"><input type="text" class="form-control" placeholder="Brand Name"></td>
												<td style="padding:4px; min-width:100px"><input type="text" class="form-control" placeholder="Brand Name"></td>
												<td style="padding:4px; min-width:100px">
													<a class="btn btn-primary btn-sm">Add</a> 
													<a class="btn btn-default btn-sm" id="cancel">Cancel</a>
												</td>
											</tr>
										</tbody>
										-->
										<tbody>
											<tr>	
												<td style="padding:4px; min-width:100px"><input type="text" class="form-control" id="brand" ng-model="brand_name" ng-keyup="checkenter($event)" placeholder="Brand Name"></td>
												<td style="padding:4px; min-width:100px">
													<a class="btn btn-primary btn-sm" ng-click="savedata('tbl_brand')">Add</a> 
													<a class="btn btn-default btn-sm" id="cancel">Cancel</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- common form panel -->
								
								
									
								<div ng-show="datas.length!=0"  class="table-responsive" style="width:100%;" >
								<table  id="tbl" ng-init="getdatas('tbl_brand')" class="table table-striped table-bordered table-hover" width="100%">
									<thead>			                
										<tr>
											<th class="idrow" ng-click="sortField = 'brand_id'; reverse = !reverse"><a href="">ID</a></th>
											<th ng-click="sortField = 'brand_name'; reverse = !reverse"><i class="glyphicon glyphicon-bold text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Name</a></th>
											<th ng-click="sortField = 'status'; reverse = !reverse"><i class="fa fa-flag text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Status</a></th>
											<th class="option" style="width:5%"><i class="fa fa-gear text-muted hidden-md hidden-sm hidden-xs"></i> Option</th>
										</tr>
									</thead>
									<tbody>
										<tr id="{{datas.brand_id}}" tr-id="{{datas.brand_id}}" ng-repeat="datas in filtered = (datas | filter:search | orderBy : sortField :reverse |  startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit)">
											<td class="idrow">{{datas.brand_id}}</td>
											
											<td class="editable brand_nametxt">{{datas.brand_name}}</td>
											<td class="hasinput"><input class="brand_name" value="{{datas.brand_name}}" class="form-control" class="brand_name" type="text"></td>
											
											<td class="editable statustxt">
												
												<span class="{{(datas.status == 1) ? 'label label-success' : 'label label-danger'}}">
													{{(datas.status == 1) ? 'active' : 'disable'}}
												</span>

											</td>
											<td class="hasinput">
												<span class="onoffswitch">
													<input name="start_interval{{datas.brand_id}}" class="onoffswitch-checkbox" id="st{{datas.brand_id}}" type="checkbox" ng-checked="datas.status==1">
													<label class="onoffswitch-label" for="st{{datas.brand_id}}">
														<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</span>
											</td>
											<td class="option">
												<a href="" class="fa fa-edit"></a><a href=""  class="fa fa-save"></a> &nbsp;
												<a href="" ng-click="deletedata(datas.brand_id, 'tbl_brand', 'brand_id')" class="fa fa-times-circle"></a> 
												<a href="" class="fa fa-undo"></a> &nbsp;
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr style="border-top:1px solid #ccc">
										
											<td style="border:none" colspan="3">
												<a href=""><div pagination="" page="currentPage" on-select-page="setPage(page)" first-text="«" last-text="»" max-size="1" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="‹" next-text="›"></div></a>
											</td>
											<td class="option" style="border:none" >
												<div class="ColVis">
												<select ng-model="entryLimit" style="width: 70px;float: right; margin-top:17px" class="form-control">
													<option>5</option>
													<option>10</option>
													<option>20</option>
													<option>50</option>
													<option>100</option>
												</select>
												</div>
											</td>
										</tr>
									</tfoot>
								</table>
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
