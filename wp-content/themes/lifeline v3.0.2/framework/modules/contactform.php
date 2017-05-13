
<div class="span8">
    <?php if( isset( $title ) && $title ): ?>
        <h3><?php echo $title; ?></h3>
    <?php endif; ?>
    <?php echo sh_contact_form_submit(); ?>
    <form method="post">
        <p>
            <label for="name"><?php _e('Name', SH_NAME); ?> *</label>
            <input type="text" class="span8" name="contact_name" id="name">
        </p>
        <p>
            <label><?php _e('Email', SH_NAME); ?> *</label>
            <input type="email" class="span8" name="contact_email" id="email">
        </p>
        <p>
            <label><?php _e('Message', SH_NAME); ?> *</label>
            <textarea rows="10" class="span8" name="contact_message" id="message"></textarea>
        </p>
        <button type="submit" class="btn btn-general"><?php _e('Submit', SH_NAME); ?></button>
    </form>
</div>
<!-- .span8 -->