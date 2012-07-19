<div class="wrap">
	<h2>Sentry Error Reporting Settings</h2>
	
	<form action="" method="post">
		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="sentry_dsn">Sentry DSN</label>
					</th>
					<td>
						<input name="sentry_dsn" type="text" id="sentry-dsn" value="<?php echo $dsn; ?>" class="regular-text">
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
						<label for="sentry_dsn">Error Reporting Level</label>
					</th>
					<td>
						<select name="sentry_reporting_level">
							<option value="E_NONE" <?php echo ($reporting_level == 'E_NONE') ? 'selected="selected"' : '';?>>None</option>
							<option value="E_WARNING" <?php echo ($reporting_level == 'E_WARNING') ? 'selected="selected"' : '';?>>Warnings</option>
							<option value="E_NOTICE" <?php echo ($reporting_level == 'E_NOTICE') ? 'selected="selected"' : '';?>>Notices</option>
							<option value="E_USER_ERROR" <?php echo ($reporting_level == 'E_USER_ERROR') ? 'selected="selected"' : '';?>>User Errors</option>
							<option value="E_USER_WARNING" <?php echo ($reporting_level == 'E_USER_WARNING') ? 'selected="selected"' : '';?>>User Warnings</option>
							<option value="E_USER_NOTICE" <?php echo ($reporting_level == 'E_USER_NOTICE') ? 'selected="selected"' : '';?>>User Notices</option>
							<option value="E_RECOVERABLE_ERROR" <?php echo ($reporting_level == 'E_RECOVERABLE_ERROR') ? 'selected="selected"' : '';?>>Recoverable Errors</option>
							<option value="E_ALL" <?php echo ($reporting_level == 'E_ALL') ? 'selected="selected"' : '';?>>All Errors</option>
						</select>
					</td>
				</tr>				
			</tbody>
		</table>
		
		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes">
		</p>

	</form>
	
</div>