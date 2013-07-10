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
						<input name="sentry_dsn" type="text" id="sentry-dsn" value="<?php echo $settings['dsn']; ?>" class="regular-text">
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="sentry_dsn">Error Reporting Level</label>
					</th>
					<td>
						<select name="sentry_reporting_level">
							<?php foreach ($error_levels as $level => $int): ?>
							<option value="<?php echo $level; ?>" <?php echo ($settings['reporting_level'] == $level) ? 'selected="selected"' : '';?>><?php echo $level; ?></option>
							<?php endforeach; ?>
						</select>
						 ("User Notices" is recommended)
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes">
		</p>

	</form>

</div>