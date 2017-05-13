<?php //printr($section ); ?>


<li class="<?php echo sh_set( $section, 'children' ) ? 'toggle' : ''; ?>"><a class="" href="#<?php echo sh_set( $section, 'id' ); ?>"><?php echo sh_set($section, 'title' ); ?></a>				
<?php if( $child = sh_set( $section, 'children' ) ): //printr($child);?>
    <ul>
        <?php foreach( $child as $k => $v ): ?>
        	<li><a class="<?php echo sh_set( $v, 'id' ); ?> dropdown" href="#<?php echo sh_set( $v, 'id' ); ?>"><?php echo sh_set($v, 'title' ); ?></a></li>
        <?php endforeach; ?>
    </ul>
</li>
<?php endif; ?>
