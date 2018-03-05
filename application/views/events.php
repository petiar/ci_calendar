<ul class="list-unstyled">
  <?php foreach($data['events'] as $item): ?>
  <li id="<?php print $item['id']; ?>">
    <h2><?php print $item['summary']; ?></h2>
    <div class="row">
      <div class="col-sm-10">
        <strong><?php print $item['start'] . ' - ' . $item['end']; ?></strong><br>
        <strong><?php print $item['location']; ?></strong>
        <p><?php print $item['description']; ?></p>
      </div>
      <div class="col-sm-2">
        <a class="btn btn-outline-primary float-right" href="<?php print site_url('events/show/' . $item['id']); ?>" role="button">More info</a><br>
        <!-- <a class="btn btn-outline-success float-right <?php print $this->session->userdata('username')?'':'disabled'; ?>" href="<?php print site_url('events/subscribe/' . $item['id']); ?>" role="button">Subscribe</a> -->
          <small class="float-right clearfix">(<?php print $this->rsvp_model->count($item['id']); ?> subscribed)</small>
      </div>
    </div>
  </li>
  <?php endforeach; ?>
</ul>
