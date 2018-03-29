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
        <small>Will not be displayed if you do not want to connect.</small>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPhone">Phone number</label>
      <input type="text" class="form-control" id="inputPhone" placeholder="Phone number" name="phone" value="<?php echo set_value('phone')?set_value('phone'):(isset($stored_data['phone'])?$stored_data['phone']:''); ?>">
        <small>Will not be displayed if you do not want to connect.</small>
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
    <label for="inputAddress">Hotel</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address" value="<?php echo set_value('address', isset($stored_data['address'])?$stored_data['address']:NULL); ?>">
      <small>Will not be displayed if you do not want to connect.</small>
  </div>
  <div class="form-row">
    <div class="col-md-3">
      Dates attending
    </div>
    <div class="col-md-9">
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="date_from">Date from </label>
            <?php print form_dropdown('date_from', $event['days'], array(set_value('date_from',isset($stored_data['date_from'])?$stored_data['date_from']:NULL)), array('class' => 'form-check-input', 'id' => 'date_from')); ?>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="date_to">Date to </label>
          <?php print form_dropdown('date_to', $event['days'], array(set_value('date_to',isset($stored_data['date_to'])?$stored_data['date_to']:NULL)), array('class' => 'form-check-input', 'id' => 'date_to')); ?>
        </div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputComment">Comment</label>
    <textarea class="form-control" id="inputComment" placeholder="Your comments..." name="comment" onkeyup="countChar(this)"><?php echo set_value('comment', isset($stored_data['comment'])?$stored_data['comment']:NULL); ?></textarea>
      <small><span id="charNum">100</span> characters remaining.</small>
  </div>
  <input type="hidden" name="id" value="<?php print isset($stored_data['id'])?$stored_data['id']:''; ?>" />
  <input type="hidden" name="username" value="<?php print isset($stored_data['username'])?$stored_data['username']:$this->session->userdata('username'); ?>" />
  <input type="hidden" name="eventid" value="<?php print $event['id']; ?>" />
<button type="submit" class="btn btn-primary" name="subscribe"><i class="fas fa-check-circle"></i> Save</button>
  <a href="<?php print site_url('events/show/' . $event['id']); ?>" role="button" class="btn btn-secondary" name="cancel"><i class="fas fa-ban"></i> Cancel</a>
<?php if (isset($stored_data['id'])): ?>
  <a href="<?php print site_url('events/confirm/' . $event['id'] . '/' . $stored_data['id']) ?>" role="button" class="btn btn-danger" name="cancel"><i class="fas fa-trash-alt"></i> Delete</a>
<?php endif; ?>
</td>
</form>
