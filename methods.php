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

/*
   Input -> This function takes the reference to the data array, as well as the index of the card to display for a person
   Output <- this function returns the html for a person card with their respective data
*/
function displayCard(&$data, $index)
{
    ob_start(); ?>
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
<?php return ob_get_clean();
}


/*
   Input -> This function takes an array of work experience data
   Output <- this function returns the html for a work experience with their respective data
*/
function displayWorkExperience(&$experience)
{
    ob_start(); ?>
    <article class="resume-timeline-item position-relative pb-5">
        <div class="resume-timeline-item-header mb-2">
            <div class="d-flex flex-column flex-md-row">
                <h3 class="resume-position-title font-weight-bold mb-1"><?= $experience['position'] ?></h3>
                <div class="resume-company-name ms-auto"><?= $experience['company'] ?></div>
            </div>
            <div class="resume-position-time"><?= $experience['time'] ?></div>
        </div>
        <div class="resume-timeline-item-desc">
            <p><?= $experience['desc'] ?></p>
            <?php if (!empty($experience['achievements'])) : ?>
                <h4 class="resume-timeline-item-desc-heading font-weight-bold">Achievements:</h4>
            <?php endif; ?>
            <ul>
                <?php foreach ($experience['achievements'] as $achievement) : ?>
                    <li><?= $achievement ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if (!empty($experience['technologies'])) : ?>
                <h4 class="resume-timeline-item-desc-heading font-weight-bold">Technologies used:</h4>
            <?php endif; ?>

            <ul class="list-inline">
                <?php foreach ($experience['technologies'] as $technology) : ?>
                    <li class="list-inline-item"><span class="badge bg-secondary badge-pill"><?= $technology ?></span></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </article>
<?php return ob_get_clean();
}
