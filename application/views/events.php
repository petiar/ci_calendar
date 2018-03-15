
<ul class="nav navbar nav-pills">
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter') == 'month')?'active':''; ?>" href="<?php print site_url('events/filter/month'); ?>">This month</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter') == '3months')?'active':''; ?>" href="<?php print site_url('events/filter/3months'); ?>">Next 3 months</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter') == 'year')?'active':''; ?>" href="<?php print site_url('events/filter/year'); ?>">This year</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter') == 'nyear')?'active':''; ?>" href="<?php print site_url('events/filter/nyear'); ?>">Next year</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter') == 'all')?'active':''; ?>" href="<?php print site_url('events/filter/all'); ?>">All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter_conference') == 'on')?'active':''; ?>" href="<?php print site_url('events/filter/conference'); ?>">Only display conferences</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter_my_events') == 'on')?'active':''; ?>" href="<?php print site_url('events/filter/myevents'); ?>">My events</a>
    </li>
</ul>
<ul class="list-group list-group-flush">
  <?php foreach($data['events'] as $item): ?>
  <li id="<?php print $item['id']; ?>" class="list-group-item">
    <h3 class="display-4"><?php print $item['summary']; ?></h3>
    <div class="row">
      <div class="col-sm-9">
        <strong><?php print $item['start'] . ' - ' . $item['end']; ?></strong><br>
        <strong><?php print $item['location']; ?></strong>
        <p class="text-secondary"><?php print $item['description']; ?></p>
      </div>
      <div class="col-sm-3">
          <?php if (!$item['user_subscribed']): ?>
          <a class="btn btn-outline-warning btn-block" href="<?php print site_url('events/subscribe/' . $item['id']); ?>" role="button">I want to participate</a>
          <?php endif; ?>
        <a class="btn btn-outline-primary btn-block" href="<?php print site_url('events/show/' . $item['id']); ?>" role="button">More info</a>
          <p class="text-center"><small>
            <?php if ($item['user_subscribed'] && ($item['subscribed_count'] > 1)): ?>
                <strong>You</strong> and <?php print $item['subscribed_count'] - 1; ?> others subscribed.
            <?php elseif ($item['user_subscribed'] && ($item['subscribed_count'] = 1)): ?>
                Only you are subscribed.
            <?php elseif ($item['subscribed_count']): ?>
              <?php print $item['subscribed_count']; ?> users subscribed.
            <?php else: ?>
                No one is subscribed to this event.
            <?php endif; ?>
              </small></p>
        <!-- <a class="btn btn-outline-success float-right <?php print $this->session->userdata('username')?'':'disabled'; ?>" href="<?php print site_url('events/subscribe/' . $item['id']); ?>" role="button">Subscribe</a> -->
      </div>
    </div>
  </li>
  <?php endforeach; ?>
</ul>
