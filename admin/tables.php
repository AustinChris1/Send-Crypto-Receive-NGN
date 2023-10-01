<?php
include "includes/header.php";
include "../db.php";
?>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Account name</th>
                                            <th>Account number</th>
                                            <th>Wallet Address</th>
                                            <th>Reference code</th>
                                            <th>USDT</th>
                                            <th>NGN</th>
                                            <th>Transaction Hash</th>
                                            <th>Transaction Status</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Account name</th>
                                            <th>Account number</th>
                                            <th>Wallet Address</th>
                                            <th>Reference code</th>
                                            <th>USDT</th>
                                            <th>NGN</th>
                                            <th>Transaction Hash</th>
                                            <th>Transaction Status</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                                                $trans = $db->query("SELECT * FROM check_data");
                                                                // $tx = $trans->fetch_array();
                                                                if ($trans->num_rows > 0) {
                                                                    foreach($trans as $tx){
                                        
                                        ?>
                                        <tr>
                                            <td><?=$tx['id'];?></td>
                                            <td><?=$tx['acct_name'];?></td>
                                            <td><?=$tx['acct_no'];?></td>
                                            <td><?=$tx['wallet_address'];?></td>
                                            <td><?=$tx['ref_code'];?></td>
                                            <td><?=$tx['usdt'];?></td>
                                            <td><?=$tx['ngn'];?></td>
                                            <td><?=$tx['tx_hash'];?></td>
                                            <td><?php if($tx['status'] == '1'){
                                                echo "Paid";
                                            }else{
                                                echo "UnPaid";
                                            };?></td>
                                            <td><?=$tx['date'];?></td>
                                            <td>
                                                    <a href="update?id=<?=$tx['id']?>" class="btn btn-info">Edit</a>
                                                </td>
                                                                                    </tr>
                                        <?php
                                                                    }
                                        }else{
                                            echo "No data available";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<?php
include "includes/footer.php";
?>