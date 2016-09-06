<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/my_style.css">
<script src="<?php echo base_url(); ?>assets/js/common_script.js"></script><!-- first common -->


<div id="content" class="bodylayout" style="display:none"><!-- second common-->
	<div class="well">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Language Control Panel</h1>
			</div>	
		</div>
		<section id="widget-grid" class="">
			<div class="row">
				<article  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					
					<div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">

						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h3 class="h2style">&nbsp;  Language Table </h3>
		
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
									<!-- common success warning and add new -->
									
								</div>
								
								
								
								<!-- fifth common form panel -->
								<div class="table-responsive" id="panel" >
									<table class="table table-hover">
										
										<tbody>
											<tr>	
												<td><input type="text" class="form-control" id="language_name" ng-model="language_name" ng-keyup="checkenter($event)" placeholder="Language Name"></td>
												<td><input type="text" class="form-control" id="language_code" ng-model="language_code" ng-keyup="checkenter($event)" placeholder="Language Code"></td>
												
												<td>
													<a class="btn btn-primary btn-sm" ng-click="savedata('tbl_language')">Add</a> 
													<a class="btn btn-default btn-sm" id="cancel">Cancel</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- common form panel -->
								
								
								
								<div ng-show="datas.length!=0"  class="table-responsive s1"> <!-- six common -->
								<table  id="tbl" ng-init="getdatas('tbl_language')" class="table table-striped table-bordered table-hover" width="100%">
									<thead>			                
										<tr>
											<th class="hideinsmall idrow" ng-click="sortField = 'language_id'; reverse = !reverse"><a href="">ID</th>
											<th ng-click="sortField = 'language_name'; reverse = !reverse"><i class="fa fa-language text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Language</a></th>
											<th ng-click="sortField = 'language_code'; reverse = !reverse"><i class="fa fa-code text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Code</a></th>
											<th ng-click="sortField = 'created_date'; reverse = !reverse" class="created" ><i class="fa fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Created</a></th>

											<th ng-click="sortField = 'language_status'; reverse = !reverse" ><i class="fa fa-flag text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Status</a></th>
											<th class="option"><i class="fa fa-gear text-muted hidden-md hidden-sm hidden-xs"></i> Option</th>
										</tr>
									</thead>
									<tbody><!-- seven common -->
										
										<tr id="{{datas.language_id}}" tr-id="{{datas.language_id}}" ng-repeat="datas in filtered = (datas | filter:search | orderBy : sortField :reverse |  startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit)">
											<td class="hideinsmall idrow">{{datas.language_id}}</td>
											
											<td class="editable language_nametxt">{{datas.language_name}}</td>
											<td class="hasinput"><input class="language_name" value="{{datas.language_name}}" class="form-control" class="language_name" type="text"></td>
											
											<td class="editable language_codetxt">{{datas.language_code}}</td>
											<td class="hasinput"><input class="language_code" value="{{datas.language_code}}" class="form-control" class="language_code" type="text"></td>
											
											<td class="created">{{datas.created_date}}</td>
										
											
											<td class="editable language_statustxt">
												
												<span class="{{(datas.language_status == 1) ? 'label label-success' : 'label label-danger'}}">
													{{(datas.language_status == 1) ? 'active' : 'disable'}}
												</span>

											</td>
											<td class="hasinput">
												<span class="onoffswitch">
													<input name="start_interval{{datas.language_id}}" class="onoffswitch-checkbox" id="st{{datas.language_id}}" type="checkbox" ng-checked="datas.language_status==1">
													<label class="onoffswitch-label" for="st{{datas.language_id}}">
														<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</span>
											</td>
											
											<td class="option">
												<a href="" class="fa fa-edit"></a><a href=""  class="fa fa-save"></a> &nbsp;
												<a href="" ng-click="deletedata(datas.language_id, 'tbl_language', 'language_id')" class="fa fa-times-circle"></a> 
												<a href="" class="fa fa-undo"></a> &nbsp;
											</td>
										</tr>
										
									</tbody>
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
