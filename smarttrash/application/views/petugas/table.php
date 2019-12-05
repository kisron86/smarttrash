<div class="col-md-12">
  <div class="block block-themed">
    <div class="block-header bg-gd-sea">
      <h3 class="block-title"><span class="si si-info"></span> Lokasi <?php echo $nama ?></h3>
    </div>
    <div class="block-content">
      <div class="block">
        <div class="block-content block-content-full">
          <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
          <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="dataTables_length" id="DataTables_Table_1_length">
                  <div class="row">
                    <div class="col-sm-12">
                      <table class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                        <thead>
                          <tr role="row">
                            <th><center>No</center></th>
                            <th><center>Lokasi</center></th>
                            <th><center>Ketinggian (%)</center></th>
                            <th><center>Keterangan</center></th>
                            <th><center>Log</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $this->load->helper('date_helper');
                          $no=1;foreach($data_realtime as $row){if($no < 11){?>
                          <tr role="row" class="odd">
                            <td class=""><center><?=$no++?></center></td>
                            <td class=""><?=$row['lokasi']?></td>
                            <td class=""><center><strong><?=$row['ketinggian']." %";?></strong></center></td>
                            <td class="">
                              <center>
                                <?php if($row['ketinggian']>80){
                                  echo "<span class='badge badge-danger'>Penuh</span>";
                                }else{
                                  echo"<span class='badge badge-success'>Aman</span>";
                                }?>


                              </center>
                            </td>
                            <td class=""><?=DateToIndo(substr($row['log'],0,10))." pukul ".substr($row['log'],11,8)?></td>
                          </tr>
                          <?php } }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
