
<ul class="nav navbar nav-pills">
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter') == 'month')?'active':''; ?>" href="<?php print site_url('events/filter/month'); ?>">This month (<?php print $this->googlecalendar->getEventsCount('month'); ?>)</a>
    </li>
    <li class="nav-item">

        <a class="nav-link <?php print ($this->session->userdata('filter') == '3months')?'active':''; ?>" href="<?php print site_url('events/filter/3months'); ?>">Next 3 months (<?php print $this->googlecalendar->getEventsCount('3months'); ?>)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter') == 'year')?'active':''; ?>" href="<?php print site_url('events/filter/year'); ?>">This year (<?php print $this->googlecalendar->getEventsCount('year'); ?>)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter') == 'nyear')?'active':''; ?>" href="<?php print site_url('events/filter/nyear'); ?>">Next year (<?php print $this->googlecalendar->getEventsCount('nyear'); ?>)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php print ($this->session->userdata('filter') == 'all')?'active':''; ?>" href="<?php print site_url('events/filter/all'); ?>">All (<?php print $this->googlecalendar->getEventsCount('all'); ?>)</a>
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
          <?php if (!$item['user_subscribed'] && $this->session->userdata('username')): ?>
          <a class="btn btn-success btn-block" href="<?php print site_url('events/subscribe/' . $item['id']); ?>" role="button"><i class="fas fa-comments"></i> I want to meet up</a>
          <?php endif; ?>
        <a class="btn btn-primary btn-block" href="<?php print site_url('events/show/' . $item['id']); ?>" role="button"><i class="fas fa-info-circle"></i> Who's attending?</a>
          <p class="text-center"><small>
            <?php if ($item['user_subscribed'] && ($item['subscribed_count'] > 1)): ?>
                <strong>You</strong> and <?php print $item['subscribed_count'] - 1; ?> SPM member(s) are participating.
            <?php elseif ($item['user_subscribed'] && ($item['subscribed_count'] = 1)): ?>
                Only you are participating.
            <?php elseif ($item['subscribed_count']): ?>
              <?php print $item['subscribed_count']; ?> SPM member(s) are participating.
            <?php else: ?>
                No SPM members are participating.
            <?php endif; ?>
              </small></p>
        <!-- <a class="btn btn-outline-success float-right <?php print $this->session->userdata('username')?'':'disabled'; ?>" href="<?php print site_url('events/subscribe/' . $item['id']); ?>" role="button">Subscribe</a> -->
      </div>
    </div>
  </li>
  <?php endforeach; ?>
</ul>
