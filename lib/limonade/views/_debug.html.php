<?php if(option('env') > ENV_PRODUCTION && option('debug')): ?>
  <?php if(!$is_http_error): ?>
  <p>[<?php echo error_type($errno)?>]
  	<?php echo $errstr?> (in <strong><?php echo $errfile?></strong> line <strong><?php echo $errline?></strong>)
  	</p>
  	<?php endif; ?>

  <?php if($debug_args = set('_lim_err_debug_args')): ?>
  <p><strong>Debug arguments</strong></p>
  	<pre><code><?php echo h(print_r($debug_args, true))?></code></pre>
  <?php endif; ?>

  <p><strong>Debug Trace</strong></p>
  <pre><code><?php echo h(print_r(debug_backtrace(), true))?></code></pre>

  <p><strong>Limonade options</strong></p>
  <pre><code><?php echo h(print_r(option(), true))?></code></pre>
<?php endif; ?>