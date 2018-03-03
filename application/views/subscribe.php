<?php if (validation_errors()): ?>
<div class="alert alert-warning">
  <?php print validation_errors(); ?>
</div>
<?php endif; ?>
<?php echo form_open(current_url()); ?>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputFirstName">First Name</label>
      <input type="text" class="form-control" id="inputFirstName" placeholder="First Name" name="firstname" value="<?php print set_value('firstname', isset($stored_data['firstname'])?$stored_data['firstname']:''); ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputLastName">Last Name</label>
      <input type="text" class="form-control" id="inputLastName" placeholder="Last Name" name="lastname" value="<?php echo set_value('lastname')?set_value('lastname'):(isset($stored_data['lastname'])?$stored_data['lastname']:''); ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail">Email</label>
      <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?php echo set_value('email')?set_value('email'):(isset($stored_data['email'])?$stored_data['email']:''); ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPhone">Phone number</label>
      <input type="text" class="form-control" id="inputPhone" placeholder="Phone number" name="phone" value="<?php echo set_value('phone')?set_value('phone'):(isset($stored_data['phone'])?$stored_data['phone']:''); ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <div class="form-check form-check-inline">
        <?php print form_checkbox(array('class' => 'form-check-input', 'name' => 'speaker', 'id' => 'inputIsSpeaker', 'value' => 1, 'checked' => set_value('speaker', isset($stored_data['speaker'])?$stored_data['speaker']:NULL))); ?>
        <label class="form-check-label" for="inputIsSpeaker">Is speaker at the conference?</label>
      </div>
    </div>
    <div class="form-group col-md-6">
      <div class="form-check form-check-inline">
        <?php print form_checkbox(array('class' => 'form-check-input', 'name' => 'connect', 'id' => 'inputAvailableToConnect', 'value' => 1, 'checked' => set_value('connect', isset($stored_data['connect'])?$stored_data['connect']:NULL))); ?>
        <!--<input class="form-check-input" type="checkbox" id="inputAvailableToConnect" value="1" name="connect"<?php print (set_value('connect')?' checked':(isset($stored_data['connect']) && $stored_data['connect'])?' checked':''); ?>>-->
        <label class="form-check-label" for="inputAvailableToConnect">Is available to connect?</label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Place of stay</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address" value="<?php echo set_value('address', isset($stored_data['address'])?$stored_data['address']:NULL); ?>">
  </div>
  <div class="form-row">
    <div class="col-md-3">
      Dates attending
    </div>
    <div class="col-md-9">
      <?php foreach ($event['days'] as $day): ?>
      <div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inputDate<?php print $day; ?>" value="1" name="date_<?php print $day; ?>"<?php print set_value('date_' . $day)?' checked':''; ?>>
        <label class="form-check-label" for="inputDate<?php print $day; ?>"><?php print date('d. m. Y', strtotime($day)); ?></label>
      </div></div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputComment">Comment</label>
    <textarea class="form-control" id="inputComment" placeholder="Your comments..." name="comment"><?php echo set_value('comment', isset($stored_data['comment'])?$stored_data['comment']:NULL); ?></textarea>
  </div>
  <input type="hidden" name="id" value="<?php print isset($stored_data['id'])?$stored_data['id']:''; ?>" />
  <input type="hidden" name="username" value="<?php print isset($stored_data['username'])?$stored_data['username']:$this->session->userdata('username'); ?>" />
  <input type="hidden" name="eventid" value="<?php print $event['id']; ?>" />
  <button type="submit" class="btn btn-primary" name="subscribe">Save</button>
  <a href="<?php print site_url('events/show/' . $event['id']); ?>" role="button" class="btn btn-secondary" name="subscribe">Cancel</a>
</form>
