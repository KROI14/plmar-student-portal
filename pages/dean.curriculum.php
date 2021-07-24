<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';
    
    $firstFirst = $selectObj->getSubjectByAcademicInfo($_GET['cid'], "1st Year", "1st Semester");
    $firstSecond = $selectObj->getSubjectByAcademicInfo($_GET['cid'], "1st Year", "2nd Semester");

    $secondFirst = $selectObj->getSubjectByAcademicInfo($_GET['cid'], "2nd Year", "1st Semester");
    $secondSecond = $selectObj->getSubjectByAcademicInfo($_GET['cid'], "2nd Year", "2nd Semester");

    $thirdFirst = $selectObj->getSubjectByAcademicInfo($_GET['cid'], "3rd Year", "1st Semester");
    $thirdSecond = $selectObj->getSubjectByAcademicInfo($_GET['cid'], "3rd Year", "2nd Semester");

    $fourthFirst = $selectObj->getSubjectByAcademicInfo($_GET['cid'], "4th Year", "1st Semester");
    $fourthSecond = $selectObj->getSubjectByAcademicInfo($_GET['cid'], "4th Year", "2nd Semester");
?>

<div class="container-fluid py-3">
    <div class="card-container">
        <div class="row">
            <div class="col-12 col-xl-6">
                <p class="title mb-0 text-center">1st Year</p>
                <p class="phar text-center">1st Semester</p>
                <div class="table-container">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Total Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($firstFirst as $key => $subject): ?>
                                <tr>
                                    <td><?php echo $subject['SubjectCode']?></td>
                                    <td><?php echo $subject['Description']?></td>
                                    <td><?php echo $subject['Units']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <p class="title mb-0 text-center">1st Year</p>
                <p class="phar text-center">2nd Semester</p>
                <div class="table-container">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Total Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($firstSecond as $key => $subject): ?>
                                <tr>
                                    <td><?php echo $subject['SubjectCode']?></td>
                                    <td><?php echo $subject['Description']?></td>
                                    <td><?php echo $subject['Units']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-container mt-3">
        <div class="row">
            <div class="col-12 col-xl-6">
                <p class="title mb-0 text-center">2nd Year</p>
                <p class="phar text-center">1st Semester</p>
                <div class="table-container">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Total Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($secondFirst as $key => $subject): ?>
                                <tr>
                                    <td><?php echo $subject['SubjectCode']?></td>
                                    <td><?php echo $subject['Description']?></td>
                                    <td><?php echo $subject['Units']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <p class="title mb-0 text-center">2nd Year</p>
                <p class="phar text-center">2nd Semester</p>
                <div class="table-container">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Total Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($secondSecond as $key => $subject): ?>
                                <tr>
                                    <td><?php echo $subject['SubjectCode']?></td>
                                    <td><?php echo $subject['Description']?></td>
                                    <td><?php echo $subject['Units']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-container mt-3">
        <div class="row">
            <div class="col-12 col-xl-6">
                <p class="title mb-0 text-center">3rd Year</p>
                <p class="phar text-center">1st Semester</p>
                <div class="table-container">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Total Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($thirdFirst as $key => $subject): ?>
                                <tr>
                                    <td><?php echo $subject['SubjectCode']?></td>
                                    <td><?php echo $subject['Description']?></td>
                                    <td><?php echo $subject['Units']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-12 col-xl-6">
                <p class="title mb-0 text-center">3rd Year</p>
                <p class="phar text-center">2nd Semester</p>
                <div class="table-container">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Total Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($thirdSecond as $key => $subject): ?>
                                <tr>
                                    <td><?php echo $subject['SubjectCode']?></td>
                                    <td><?php echo $subject['Description']?></td>
                                    <td><?php echo $subject['Units']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-container mt-3">
        <div class="row">
            <div class="col-12 col-xl-6">
                <p class="title mb-0 text-center">4th Year</p>
                <p class="phar text-center">1st Semester</p>
                <div class="table-container">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Total Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($fourthFirst as $key => $subject): ?>
                                <tr>
                                    <td><?php echo $subject['SubjectCode']?></td>
                                    <td><?php echo $subject['Description']?></td>
                                    <td><?php echo $subject['Units']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <p class="title mb-0 text-center">4th Year</p>
                <p class="phar text-center">2nd Semester</p>
                <div class="table-container">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Total Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($fourthSecond as $key => $subject): ?>
                                <tr>
                                    <td><?php echo $subject['SubjectCode']?></td>
                                    <td><?php echo $subject['Description']?></td>
                                    <td><?php echo $subject['Units']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.inc.php';
?>