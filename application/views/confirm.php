Do you really want to delete the RSVP on event <?php print $event['summary']; ?>?

<?php echo form_open(current_url()); ?>
<button type="submit" class="btn btn-warning" name="confirm" value="1">Confirm</button>
<a href="<?php print site_url('events/show/' . $event['id']); ?>" role="button" class="btn btn-secondary" name="subscribe">Cancel</a>
<?php echo form_close(); ?>
