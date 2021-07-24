<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';
?>

<input type="hidden" id="school-year" value="<?php echo $_SESSION['SCHOOL_YEAR'];?>">
<input type="hidden" id="semester" value="<?php echo $_SESSION['SEMESTER'];?>">

<div class="container-fluid pb-3">
    <div class="card-container mt-3">
        <p class="mb-0 title">On Process Payments</p>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Payment Mode</th>
                        <th>Bank</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody id="on-process-payments">
                </tbody>
            </table>
        </div>
    </div>


    <div class="card-container mt-3">
        <p class="mb-0 title">Approved Payments</p>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Payment Mode</th>
                        <th>Bank</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody id="approved-payments">
                </tbody>
            </table>
        </div>
    </div>


    <div class="card-container mt-3">
        <p class="mb-0 title">Rejected Payments</p>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Payment Mode</th>
                        <th>Bank</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody id="rejected-payments">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-payment-info">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

<script src="../js/adm.bur.downpayment-list.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>