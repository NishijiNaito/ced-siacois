<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<!-- Html Address -->
<div class="row justify-content-center">
    <div class="col-md-11">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=".">Home</a></li>
                <?php if (isset($nav)) {

                    foreach ($nav as $page) :
                        if (!isset($page[1])) {
                ?>

                            <li class="breadcrumb-item active" aria-current="page"><?php echo $page[0]; ?></li>
                        <?php } else {
                        ?>
                            <li class="breadcrumb-item"><a href="<?php echo base_url() . $page[1]; ?>"><?php echo $page[0]; ?></a></li>

                <?php
                        }

                    endforeach;
                } ?>

            </ol>
        </nav>

    </div>
</div>