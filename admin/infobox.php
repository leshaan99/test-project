  
  <?php

$infobox = array(
  '1' => array(
      'caption' => 'Applications',
      'icon' => 'fas fa-book',
      'bg' => 'bg-info',
      'value'=>10,
      'url' => 'application_list',
  ),
  '2' => array(
      'caption' => 'Courses',
      'icon' => 'fas fa-book',
      'bg' => 'bg-danger',
      'value'=>20,
      'url' => 'course_list',
  ),
  '3' => array(
      'caption' => 'Users',
      'icon' => 'fas fa-users ',
      'bg' => ' bg-warning',
      'value'=>10,
      'url' => 'user_list',
  ),

);


?>
  
  
  
  
  <!-- Info boxes -->
  <div class="container">
    <div class="row">

      <div class="row">
        <?php foreach ($infobox as $key => $info) : ?>
          <div class="col">
            <div class="info-box">
              <span class="info-box-icon <?= $info['bg'] ?> elevation-1"><i class="<?= $info['icon'] ?>"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><?= $info['caption'] ?></span>
                <a href="<?= $info['url'] ?>"><span class="info-box-number"><?= $info['value'] ?></span></a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>