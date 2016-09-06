<input type="hidden" ng-init="checkurl()">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/my_style.css">
<script>
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideDown("fast");
		return false;
    });
	$('#cancel').click(function(){
		$("#panel").slideUp("fast");
		return false;	
	});
	
	$('#tbl').delegate('a.fa-undo','click',function(e){
		var $tr = $(this).closest('tr');
		$tr.find('.hasinput').hide();
		$tr.find('.editable').show();
		
		$tr.find('.fa-save').hide();
		$tr.find('.fa-edit').show();
		
		$tr.find('.fa-undo').hide();
		$tr.find('.fa-times-circle').show();
	});
});
</script>
<style>.label-primary{ margin-right:1px; }</style>
	
<div id="content" class="bodylayout" style="display:none"><!-- second common-->
	<div class="well">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> User Control Panel</h1>
			</div>	
		</div>
		<section id="widget-grid" class="">
			<div class="row">
				<article  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					
					<div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">

						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h3 class="h2style">&nbsp;  User List </h3>
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
												<td style="width:50%"><input type="text" class="form-control" id="user_name" ng-model="user_name" ng-keyup="checkenter($event)" placeholder="Username"></td>
												<td style="width:50%"><input type="text" class="form-control" id="password" ng-model="password" ng-keyup="checkenter($event)" placeholder="Password"></td>
											</tr>
											
											<tr>
												<td>
													<select id="brand_ids" multiple placeholder="Select Brand" ng-model="brand_ids" class="select2" style="width:100%" ng-init="getdatasforselect('tbl_brand')">
														<option ng-repeat="brand in brands" value="{{brand.brand_id}}|{{brand.brand_name}}">{{brand.brand_name}}</option>
													</select>
												</td>
												<td><a id="addbtn" class="btn btn-primary btn-sm" ng-click="savedata()">Add</a> <a class="btn btn-default btn-sm" id="cancel">Cancel</a></td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- common form panel -->
								
								
								
								<div ng-show="datas.length!=0"  class="table-responsive s1"> <!-- six common -->
								<table  id="tbl" ng-init="getdatas('tbl_user')" class="table table-striped table-bordered table-hover" width="100%">
									<thead>			                
										<tr>
											<th class="hideinsmall idrow" ng-click="sortField = 'user_id'; reverse = !reverse"> <a href="">ID</a></th>
											<th ng-click="sortField = 'user_name'; reverse = !reverse"><i class="fa fa-user text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Username</th>
											<th ng-click="sortField = 'password'; reverse = !reverse"><i class="fa fa-key text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Password</th>
											<th><i class="glyphicon glyphicon-bold text-muted hidden-md hidden-sm hidden-xs"></i> Brands </th>
											<th ng-click="sortField = 'last_login'; reverse = !reverse"><i class="fa fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Last Login</a></th>
											<th ng-click="sortField = 'fail_attempt'; reverse = !reverse"><i class="fa fa-warning text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Fail attempt</a></th>
											<th ng-click="sortField = 'status'; reverse = !reverse"><i class="fa fa-flag text-muted hidden-md hidden-sm hidden-xs"></i> <a href="">Status</a></th>
											<th class="option"><i class="fa fa-gear text-muted hidden-md hidden-sm hidden-xs"></i> Option</th>
										</tr>
									</thead>
									<tbody>
										
										<tr id="{{datas.user_id}}" tr-id="{{datas.user_id}}" ng-repeat="datas in filtered = (datas | filter:search | orderBy : sortField :reverse |  startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit)">
										
											<td class="hideinsmall idrow">{{datas.user_id}}</td>
											
											<td style="width:12%" class="editable user_nametxt">{{datas.user_name}}</td>
											<td style="width:12%" class="hasinput"><input class="user_name" value="{{datas.user_name}}" class="form-control" class="user_name" type="text"></td>
											
											<td style="width:12%" class="editable passwordtxt"> ***** </td>
											<td style="width:12%" class="hasinput"><input class="password" placeholder="Password (Not Change)" class="form-control" class="password" type="text"></td>
											
											<td style="width:27%" class="editable brand_idstxt" ng-init="bs=getbs(datas.brand_ids)"><span class="label label-primary" ng-repeat="b in bs">{{b.brand_name}}</span></td>
											<td style="width:27%" class="hasinput">
												<select id="brand_ids{{datas.user_id}}" multiple style="width:100%" >
													<option ng-repeat="b in bs" value="{{b.brand_id}}|{{b.brand_name}}" selected>{{b.brand_name}}</option>
													<option ng-show="hide_dup(b.brand_id,bs)" ng-repeat="b in brands" value="{{b.brand_id}}|{{b.brand_name}}">{{b.brand_name}}</option>
												</select>											
											</td>
											
											<td>{{datas.last_login}}</td>
											<td>{{datas.fail_attempt}}</td>
											
											<td class="editable statustxt">
												
												<span class="{{(datas.status == 1) ? 'label label-success' : 'label label-danger'}}">
													{{(datas.status == 1) ? 'active' : 'disable'}}
												</span>

											</td>
											<td class="hasinput">
												<span class="onoffswitch">
													<input name="start_interval{{datas.user_id}}" class="onoffswitch-checkbox" id="st{{datas.user_id}}" type="checkbox" ng-checked="datas.status==1">
													<label class="onoffswitch-label" for="st{{datas.user_id}}">
														<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</span>
											</td>
											
											<td class="option">
												<a href="" class="fa fa-edit"></a><a href=""  class="fa fa-save"></a> &nbsp;
												<a href="" ng-click="deletedata(datas.user_id, 'tbl_user', 'user_id')" class="fa fa-times-circle"></a> 
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
