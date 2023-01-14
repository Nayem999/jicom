<style type="text/css">.table td:nth-child(3) { text-align: right; }</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3> 
                </div>
                <div class="box-body">  
                <div class="table-responsive">
 					<div class="clearfix"></div>
                    </div>
                    <?php
                            $emptyvalue = '0.00';
                            $gtotal ='';
                            $pgtotal = '';
                            $sgtotal = '';
                            $i= 0; 
                            if($results !=''){
                           foreach ($results as $key => $part) {
                                   $sort[$key] = strtotime($part['datetime']); 
                              }
                              array_multisort($sort, SORT_ASC, $results); 

                              ?>
                    <div class="table-responsive">
                        <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>

                                <tr class="active">

                                    <th class="col-xs-2">Date & time </th>

                                    <th class="col-xs-2">Type</th>
                                    
                                    <th class="col-xs-2">Dr</th>

                                    <th class="col-xs-3">Cr</th>

                                    <th class="col-xs-2">Balance</th>

                                </tr>

                            </thead> 

                            <?php $url = base_url('merge/mergereport'); ?>

                            <tbody>

                                <?php 
                                foreach ($results as $key => $value) {
                                    $i++;
                                    $gtotal = $gtotal;
                                     echo '<tr>' ;
                                     echo '<td>'.$this->tec->hrld($value['datetime']) .'</td>' ;
                                     if(($value['type']=='collection') || ($value['type']=='payment') || ($value['type'] =='Advance Collection') || ($value['type'] =='Advance Payment') || ($value['type'] == 'Supplier Opening balance') || ($value['type'] == 'Customer Opening balance')){
                                        echo "<td>".$value['type'] .'</td>' ;
                                     } else {
                                     echo "<td>
                                        <a onclick=\"window.open('" . $url.'/'.$value['type'].'/'.$value['id'] . "', 'pos_popup', 'scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#'>".$value['type'] .'</a>
                                        </td>' ;
                                    }
                                     if(($value['type'] == 'purchases') ||($value['type'] =='collection') ||($value['type'] =='Advance Collection') || ($value['type'] == 'Supplier Opening balance') ) {  ;
                                         echo '<td style="text-align:center">'.$emptyvalue.'</td>' ;
                                         $pgtotal = $pgtotal + $value['total'];
                                     }

                                     echo '<td style="text-align:center">'.$value['total'] .'</td>' ;
                                     if(($value['type'] == 'sale') || ($value['type'] =='payment') || ($value['type'] =='Advance Payment') || ($value['type'] == 'Customer Opening balance')){
                                        echo '<td style="text-align:center">'.$emptyvalue.'</td>' ;
                                        $sgtotal = $sgtotal + $value['total'];
                                     }
                                       
                                     $gtotal = $sgtotal - $pgtotal;

                                     echo '<td style="text-align:center">'.$gtotal. '</td>' ;
                                     echo '</tr>' ;
                                  
                            } 

                         ?>
                            <tr>
                                <td></td>
                                <td> </td>
                                <td style="text-align:center"><?php echo $sgtotal; ?></td>
                                <td style="text-align:center"><?php echo $pgtotal;?></td>
                                <td></td>
                            </tr>

                            </tbody>

                        </table>


                    </div>
                    <?php } ?>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>

</section>
