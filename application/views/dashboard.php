<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>My Projects</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row btn-row">
          <div class="col-lg-2 col-xs-6">
            <form method="post" action="<?php echo base_url(); ?>project/addProject">
              <button class="btn btn-success btn-lg">Add Project</button>
            </form>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h4>IoT Weather</h4>
                  <p><i class="fa fa-user"></i> Dita Tri Rusnayanty</p>
                  <p><i class="fa fa-calendar"></i> 13 Juli 2019</p>
                  <p>
                    <?php
                      $num_char = 200;
                      $text = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
                      echo substr($text, 0, $num_char) . '...';
                    ?>
                  </p>
                </div>
                <a href="<?php echo base_url('project'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h4>IoT Weather</h4>
                  <p><i class="fa fa-user"></i> Dita Tri Rusnayanty</p>
                  <p><i class="fa fa-calendar"></i> 13 Juli 2019</p>
                  <p>
                    <?php
                      $num_char = 200;
                      $text = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
                      echo substr($text, 0, $num_char) . '...';
                    ?>
                  </p>
                </div>
                <a href="<?php echo base_url('project'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4>IoT Weather</h4>
                  <p><i class="fa fa-user"></i> Dita Tri Rusnayanty</p>
                  <p><i class="fa fa-calendar"></i> 13 Juli 2019</p>
                  <p>
                    <?php
                      $num_char = 200;
                      $text = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
                      echo substr($text, 0, $num_char) . '...';
                    ?>
                  </p>
                </div>
                <a href="<?php echo base_url('project'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h4>IoT Weather</h4>
                  <p><i class="fa fa-user"></i> Dita Tri Rusnayanty</p>
                  <p><i class="fa fa-calendar"></i> 13 Juli 2019</p>
                  <p>
                    <?php
                      $num_char = 200;
                      $text = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ';
                      echo substr($text, 0, $num_char) . '...';
                    ?>
                  </p>
                </div>
                <a href="<?php echo base_url('project'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
        </div>
    </section>
  </div>
</div>