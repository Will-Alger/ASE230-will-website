<?php
require_once 'data.php';

// calculates age from dob in the form mm/dd/yy
function calculateAge($dob)
{
    $birthdate = date_create($dob);
    if ($birthdate === false) {
        return "[ERROR: Date of birth not valid]";
    }

    $age = date_diff($birthdate, date_create('now'))->y;
    return $age;
}


function displayCard(&$data, $index)
{
    ob_start();
?>
    <header class="resume-header mt-4 pt-4 pt-md-0">
        <div class="row">
            <div class="col-block col-md-auto resume-picture-holder text-center text-md-start">
                <img class="picture" src="<?= $data[$index]['personal_info']['img'] ?>" alt="">
            </div><!--//col-->
            <div class="col">
                <div class="row p-4 justify-content-center justify-content-md-between">
                    <div class="primary-info col-auto">
                        <h1 class="name mt-0 mb-1 text-white text-uppercase text-uppercase"><?= $data[$index]['personal_info']['name']; ?></h1>
                        <div class="title mb-1"><?php echo $data[$index]['personal_info']['job_title']; ?></div>
                        <h6 class="mt-0 mb-3 text-white"><i><?= calculateAge($data[$index]['personal_info']['dob']) ?> years old</i></h6>
                        <a href="detail.php?id=<?= $index; ?>" class="btn btn-secondary">See full profile</a>
                    </div>
                    <div class="secondary-info col-auto mt-2">
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php
    return ob_get_clean();
}
