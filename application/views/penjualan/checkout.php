 <div class="modal fade" id="pembayaranModal">
   <div class="modal-dialog">
     <div class="modal-content">

       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
         </button>
         <h4 class="modal-title" id="inputKasModal">Pembayaran</h4>
       </div>
       <div class="modal-body">
         <form class="form-horizontal" method="post" action="<?php echo base_url('penjualan/simpanpenjualan') ?>">
           <div class="form-group">
             <input type="hidden" class="form-control" name="kasir" id="kasir" readonly>
             <input type="hidden" class="form-control" name="cus" id="cus" readonly>
             <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Total</label>
             <div class="col-md-9 col-sm-9 col-xs-12">
               <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
             </div>
           </div>
           <div class="form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">Diskon (Rp)</label>
             <div class="col-md-9 col-sm-9 col-xs-12">
               <input type="text" class="form-control" name="diskon1" id="diskon1" autocomplete="off" readonly>
             </div>
           </div>
           <div class="form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">Grand Total</label>
             <div class="col-md-9 col-sm-9 col-xs-12">
               <input type="text" class="form-control" name="grandtotal" id="grandtotal" readonly>
               <input type="hidden" class="form-control" name="nominal" id="nominal" readonly>
             </div>
           </div>
           <div class="form-group">
             <label class="control-label mb-1 col-md-3 col-sm-3 col-xs-12">Metode Pembayaran</label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <div class="checkbox">
                 <label>
                   <input type="radio" name="metode" id="cash" value="Cash" checked> Cash
                 </label>
                 <!-- <label>
                   <input type="radio" name="metode" id="kredit" value="Kredit"> Kredit
                 </label> -->
               </div>
             </div>
           </div>
           <div class="form-group jatuh-tempo">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">Jatuh Tempo</label>
             <div class="col-md-9 col-sm-9 col-xs-12">
               <input type="date" class="form-control" name="tempo" id="tempo" autocomplete="off">
             </div>
           </div>
           <div class="form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">Bayar</label>
             <div class="col-md-9 col-sm-9 col-xs-12">
               <input type="number" class="form-control" name="bayar" id="bayar" autocomplete="off" required>
             </div>
           </div>
           <div class="form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">Kembali</label>
             <div class="col-md-9 col-sm-9 col-xs-12">
               <input type="text" class="form-control" name="kembali" id="kembali" readonly autocomplete="off">
             </div>
           </div>
           <div class="modal-footer">
             <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
             <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak dan Simpan</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>