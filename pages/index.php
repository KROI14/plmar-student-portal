<?php
    include '../includes/header.inc.php';
    include '../includes/nav.outside-nav.php';
?>

<link rel="stylesheet" href="../css/index.css?v=<?php echo time()?>">

<img src="../img/gwt-banner-19.png" width="100%">

<div class="container pb-5">
    <div class="history-container">
        <h1 class="sub-header">History</h1>
        <p class="phar history">The Pamantasan ng Lungsod ng Marikina (simply known as PLMar) 
            is the first city government-funded university in Marikina, Philippines. 
            It was established by Ordinance No. 015 Series of 2003. The effort 
            was spearheaded by Mayor Marides C. Fernando, Cong. Marcelino Teodoro, 
            and Dr. Jerome Mendoza. Enrollment in 2003 was 1,424 students and has 
            successively increased; the 2012-2016 enrollment is 12,051. PLMar surpasses 
            the national rate of graduates who pass the Professional Regulation Commission 
            National Board Examinations for Nurses, Teachers and Criminologist.</p>
    </div>


    <div class="card-container mt-5">
        <label class="sub-header">School Announcements</label>
        <?php $announcement = $selectObj->getAnnouncementByType('school', ""); ?>
        <div class="overflow-auto" style="height: 500px;">
            <div class="list-group mt-2 school-announce">
                <?php foreach($announcement as $num => $announce): ?>
                    <a href="#" class="list-group-item list-group-item-action" data-announce-id="<?php echo $announce['AnnounceID']?>">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo $announcement[$num]['Title']?></h5>
                            <small><?php echo date('F d, Y h:ia', strtotime($announcement[$num]['CreatedAt']))?></small>
                        </div>
                        <p class="mb-1"><?php echo $announcement[$num]['Content']?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card-container mt-5">
        <label class="sub-header">Course Offering for First Semester, 2020 - 2021</label>
        <?php $course = $selectObj->getCourses(); ?>
        <table class="plmar-table">
            <tbody>
                <?php for($i = 0; $i < count($course); $i++): ?>
                    <tr>
                        <td class="text-center title"><?php echo $course[$i]['Course']?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="index-footer container-fluid">
    <div class="content">
        <div class="row">
            <div class="col-12 col-lg-6 about">
                <h2>ABOUT PLMAR</h2>
                <p>The Pamantasan ng Lungsod ng Marikina (simply known as PLMar) is the first city government-funded
                    university in Marikina City, Philippines. It was established to provide quality but affordable
                    tertiary education to the residents of Marikina through Ordinance No. 015 Series of 2003.</p>

                <p>The university provides a wide range of undergraduate and graduate programs. Aside from
                    tertiary level courses, the school also has a Senior High School (SHS) program featuring
                    strands under the Academic track.</p>

                <p>As an academic institution, PLMar has been consistently equipping its students with affordable
                    and high-quality education and molding them into well-rounded and service-oriented graduates who
                    will contribute to the development of their respective communities.</p>
            </div>

            <div class="col-12 col-lg-6 contact">
                <h2>Social Media</h2>
                <p>To stay updated, follow us on our social media:</p>

                <a href="https://web.facebook.com/cpaips/?_rdc=1&_rdr"><i class="fab fa-facebook"></i></a>
                <a href="https://www.youtube.com/channel/UCz7GtBK1hzFv7eEyZD2Y7hw"><i class="fab fa-youtube-square"></i></a>
                <a href="https://twitter.com/cpaipsplmar"><i class="fab fa-twitter-square"></i></a>

                <p>© 2020 Pamantasan ng Lungsod ng Marikina | MISC</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-announcement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>

<script>
    $(function(){
        let schoolAnnounce = $('.school-announce a');
        for(let i = 0; i < schoolAnnounce.length; i++){
            $(schoolAnnounce[i]).on('click', function(){
                $('#modal-announcement').modal('show');
                $('#modal-announcement .modal-content').load('../ajax-pages/ajax.view-announcement.php', {
                    'announce-id': $(schoolAnnounce[i]).data('announceId')
                })
            })
        }
    })
</script>
<?php
    include '../includes/footer.inc.php';
?>