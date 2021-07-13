		 <?php cek_user() ?>
		 <div class="right_col" role="main">
		   <div class="">
		     <div class="page-title">
		       <div class="title_left">
		         <h3><?php echo $title ?></h3>
		       </div>
		     </div>
		     <div class="clearfix"></div>
		     <div class="row">
		       <div class="col-md-12 col-sm-12 col-xs-12">
		         <div class="x_panel">
		           <div class="x_title">
		             <?php include 'inputsatuan.php' ?>
		             <button type="button" class="btn btn-sm btn-primary" onclick="tambahsatuan()" title="Tambah Data" id="tambahkaryawan"><i class="fa fa-plus"></i> Tambah Data</button>
		             <ul class="nav navbar-right panel_toolbox">
		               <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		               </li>
		               <li><a class="close-link"><i class="fa fa-close"></i></a>
		               </li>
		             </ul>
		             <div class="clearfix"></div>
		           </div>
		           <div class="x_content">
		             <?php echo $this->session->flashdata('message'); ?>
		             <table id="datasatuan" width="100%" class="table table-striped table-bordered">
		               <thead>
		                 <tr>
		                   <th>Satuan</th>
		                   <th>Opsi</th>
		                 </tr>
		               </thead>
		             </table>
		           </div>
		         </div>
		       </div>
		     </div>
		   </div>
		 </div>
		 <?php include 'editsatuan.php' ?>
		 <?php include 'script.php' ?>