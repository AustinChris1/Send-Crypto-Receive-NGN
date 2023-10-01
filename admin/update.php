<?php
include "includes/header.php";
include "../db.php";
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $postquery = $db->query("SELECT * FROM check_data WHERE id= '$post_id' LIMIT 1");
    if ($postquery->num_rows > 0) {
        $postrow = $postquery->fetch_array();
?>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
            </div>
            <div class="card-body">

                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6 mb-3">
                        <input type="hidden" name="id" value="<?= $postrow['id'] ?>">
                        <label for="">Account Name</label>
                        <input type="text" name="acct_name" value="<?= $postrow['acct_name'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Account Number</label>
                        <input type="text" name="acct_no" value="<?= $postrow['acct_no'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="text" name="email" value="<?= $postrow['email'] ?>" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for=""><?php if ($postrow['id'] == '2') {
                                            echo 'Base Wallet Address';
                                        } else {
                                            echo 'Wallet Address';
                                        } ?></label>
                        <input name="address" class="form-control" value="<?= $postrow['wallet_address'] ?>" type="text">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Reference Code</label>
                        <input type="text" name="ref_code" value="<?= $postrow['ref_code'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">USDT</label>
                        <input name="usdt" type="text" value="<?= $postrow['usdt'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for=""><?php if ($postrow['id'] == '2') {
                                            echo 'Contract Address';
                                        } else {
                                            echo 'Transaction hash';
                                        } ?></label>
                        <input name="tx_hash" type="text" class="form-control" value="<?= $postrow['tx_hash'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">NGN</label>
                        <input type="text" name="ngn" value="<?= $postrow['ngn'] ?>" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Status</label><br>
                        <input type="checkbox" name="status" <?= $postrow['status'] == '1' ? 'checked' : ''; ?> width="70px" height="70px" />
                        Checked = Paid, UnChecked = Unpaid
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" name="update">Update Details</button>
                    </div>
                </form>

            <?php
        } else {
            ?>
                <h4>No Record Found</h4>

        <?php
        }
    }
        ?>
            </div>
        </div>
        <?php
        include "includes/footer.php";
        ?>



