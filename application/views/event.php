<dl class="row">
    <?php if (isset($event['description'])): ?>
        <dt class="col-sm-3">Description</dt>
        <dd class="col-sm-9"><?php print $event['description']; ?></dd>
    <?php endif; ?>
    <?php if (isset($event['location'])): ?>
        <dt class="col-sm-3">Location</dt>
        <dd class="col-sm-9"><?php print $event['location']; ?></dd>
    <?php endif; ?>
    <dt class="col-sm-3">Date</dt>
    <dd class="col-sm-9">
        <strong><?php print $event['start'] . ' - ' . $event['end']; ?></strong>
    </dd>
</dl>
<p>
    <a class="btn btn-primary <?php print ($this->session->userdata('username') && !$this->rsvp_model->user_subscribed($event['id'])) ? '' : 'disabled'; ?>"
       href="<?php print site_url('events/subscribe/' . $event['id']); ?>" role="button">I will attend</a>
    <?php if (!$this->session->userdata('username')): ?>
<span class="lead">You have to be logged in to be able to RSVP on this event.</span>
<?php endif; ?>
<?php if ($this->rsvp_model->user_subscribed($event['id'])): ?>
    <span class="lead">You did already RSVP on this event.</span>
<?php endif; ?>

</p>
<?php if ($rsvp): ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">E-mail</th>
            <th scope="col">Phone</th>
            <th scope="col">Speaker</th>
            <th scope="col">Connect</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rsvp as $key => $row): ?>
            <tr>
                <th scope="row"><?php print $key + 1; ?></th>
                <td><?php print $row->firstname; ?></td>
                <td><?php print $row->lastname; ?></td>
                <td><?php print $row->email; ?></td>
                <td><?php print $row->phone; ?></td>
                <td><?php print $row->speaker?"YES":"NO"; ?></td>
                <td><?php print $row->connect?"Available to connect":""; ?></td>
                <td><?php if (($this->rsvp_model->can_edit($row->id)) || spm_is_admin()): ?>
                        <a href="<?php print site_url('events/subscribe/' . $event['id'] . '/' . $row->id); ?>"><i
                                    class="fas fa-edit"></i></a>
                    <?php endif; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<hr>
<h3>Debug info</h3>
<pre><?php print_r($event); ?></pre>
