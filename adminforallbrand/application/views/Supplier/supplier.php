<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/my_style.css">
	
<div id="content">
	<div class="well">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Supplier Control Panel</h1>
			</div>	
		</div>
	
		
		<section id="widget-grid" class="">
			<div class="row">
				<article  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					
					<div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">

						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h3 class="h2style">&nbsp;  Supplier Table </h3>
		
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
												<input aria-controls="datatable_col_reorder" placeholder="" style="max-width:170px" class="form-control" type="search">
											</label>
										</div>
									</div>
									<div class="col-sm-6 col-xs-6 customres but">
										<div class="ColVis">
											<button class="ColVis_Button ColVis_MasterButton"><span>Add New</span></button>
										</div>
									</div>
								</div>
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
									<thead>			                
										<tr>
											<th><i class="fa fa-language text-muted hidden-md hidden-sm hidden-xs"></i> Language</th>
											<th><i class="fa fa-code text-muted hidden-md hidden-sm hidden-xs"></i> Code</th>
											<th class="created" ><i class="fa fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Created</th>
											<th class="modified" ><i class="fa fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Modified</th>
											<th ><i class="fa fa-flag text-muted hidden-md hidden-sm hidden-xs"></i> Status</th>
											<th><i class="fa fa-gear text-muted hidden-md hidden-sm hidden-xs"></i> Option</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="hasinput" >
												<input class="form-control" placeholder="Language" type="text">
											</td>
											<td class="hasinput" >
												<input class="form-control" placeholder="Code" type="text">
											</td>
											<td class="hasinput created" ></td>
											<td class="hasinput modified" ></td>
											<td class="hasinput" ></td>
											<td>
												<i class="fa fa-save"> &nbsp;<i class="fa fa-times-circle"></i>
											</td>
										</tr>
										<tr>
											<td>1</td>
											<td>Jennifer</td>
											<td class="created">1-342-463-8341</td>
											<td class="modified">1-342-463-8341</td>
											<td></td>
											<td><i class="fa fa-edit"></i> &nbsp;<i class="fa fa-times-circle"></i></td>
										</tr>
										<tr>
											<td>2</td>
											<td>Clark</td>
											<td class="created">1-342-463-8341</td>
											<td class="modified">1-342-463-8341</td>
											<td></td>
											<td><i class="fa fa-edit"></i> &nbsp;<i class="fa fa-times-circle"></i></td>
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
