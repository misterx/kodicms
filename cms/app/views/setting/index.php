<?php echo form::open('setting', array(
	'id' => 'settingForm', 'class' => 'form-horizontal'
)); ?>
	<?php echo Form::hidden('token', Security::token()); ?>
	
	<div class="widget">
		<div class="widget-header">
			<h3><?php echo __( 'Site options' ); ?></h3>
		</div>
		
		<div class="widget-content">
			<div class="control-group">
				<label class="control-label title" for="settingTitle"><?php echo __( 'Site title' ); ?></label>
				<div class="controls">
					<?php
					echo Form::input( 'setting[admin_title]', Setting::get( 'admin_title' ), array(
						'class' => 'input-title', 'id' => 'settingTitle'
					) );
					?>

					<p class="help-block"><?php echo __( 'This text will be bresent at backend and can be used in themes.' ); ?></p>
				</div>
			</div>

			<div class="control-group">
				<?php echo Form::label('setting_date_format', __('Date format'), array('class' => 'control-label')); ?>
				<div class="controls">
					<?php
					echo Form::select('setting[date_format]', array(
						'Y-m-d' => '2011-12-14',
						'd.m.Y' => '14.12.2011',
						"Y/m/d" => "2011/12/14",
						"m/d/Y" => "12/14/2011",
						"d/m/Y" => "14/12/2011",
						"d F Y" => '14 декабря 2011'
					), Setting::get('date_format'), array('id' => 'setting_date_format'));
					?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="settingSection"><?php echo __( 'Default backend section' ); ?></label>
				<div class="controls">
					<select id="settingSection" name="setting[default_tab]">
						<?php $current_default_nav = Setting::get( 'default_tab' ); ?>
						<?php foreach ( Model_Navigation::get() as $section ): ?>
							<optgroup label="<?php echo $section->name(); ?>">
								<?php foreach ( $section->get_pages() as $item ): ?>
								<?php $tab = trim(str_replace(ADMIN_DIR_NAME, '', $item->url()), '/'); ?>
								<option value="<?php echo $tab; ?>" <?php if ( $tab == $current_default_nav ) echo 'selected="selected"'; ?> ><?php echo $item->name(); ?></option>
								<?php endforeach; ?>
							</optgroup>
						<?php endforeach; ?>
					</select>

					<p class="help-block"><?php echo __( 'This allows you to specify which section you will see by default after login.' ); ?></p>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="settingFindSimilar"><?php echo __( 'Find similar pages' ); ?></label>
				<div class="controls">
					<?php
					echo Form::select( 'setting[find_similar]', array( 'yes' => __( 'Yes' ), 'no' => __( 'No' ) ), Setting::get( 'find_similar' ), array(
						'id' => 'settingFindSimilar'
					) );
					?>

					<p class="help-block"><?php echo __( 'If requested page url is incorrect, then find similar page.' ); ?></p>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="settingProfiling"><?php echo __( 'Profiling' ); ?></label>
				<div class="controls">
					<?php
					echo Form::select( 'setting[profiling]', array( 'yes' => __( 'Yes' ), 'no' => __( 'No' ) ), Setting::get( 'profiling' ), array(
						'id' => 'settingProfiling'
					) );
					?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="settingDebugMode"><?php echo __( 'Debug mode' ); ?></label>
				<div class="controls">
					<?php
					echo Form::select( 'setting[debug]', array( 'yes' => __( 'Yes' ), 'no' => __( 'No' ) ), Setting::get( 'debug' ), array(
						'id' => 'settingDebugMode'
					) );
					?>
				</div>
			</div>
		</div>

		<div class="widget-header">
			<h3><?php echo __( 'Page options' ); ?></h3>
		</div>
		
		<div class="widget-content">
			<div class="control-group">
				<label class="control-label"><?php echo __( 'Default page status' ); ?> </label>
				<div class="controls">
					<label class="radio inline" for="settingPageStatusDraft">
						<?php
						echo Form::radio( 'setting[default_status_id]', Model_Page::STATUS_DRAFT, (Setting::get( 'default_status_id' ) == Model_Page_Front::STATUS_DRAFT ), array(
							'id' => 'settingPageStatusDraft'
						) ) . ' ' . __( 'Draft' );
						?>
					</label>

					<label class="radio inline" for="settingPageStatusPublished">
						<?php
						echo Form::radio( 'setting[default_status_id]', Model_Page::STATUS_PUBLISHED, (Setting::get( 'default_status_id' ) == Model_Page_Front::STATUS_PUBLISHED ), array(
							'id' => 'settingPageStatusPublished'
						) ) . ' ' . __( 'Published' );
						?>
					</label>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="settingPageFilter"><?php echo __( 'Default filter' ); ?></label>
				<div class="controls">
					<select id="settingPageFilter" name="setting[default_filter_id]">
						<?php $current_default_filter_id = Setting::get( 'default_filter_id' ); ?>
						<option value="" <?php if ( $current_default_filter_id == '' ) echo ('selected="selected"'); ?> >&ndash; <?php echo __( 'none' ); ?> &ndash;</option>
						<?php foreach ( $filters as $filter_id ): ?>
							<?php if ( isset( $loaded_filters[$filter_id] ) ): ?>
								<option value="<?php echo $filter_id; ?>" <?php if ( $filter_id == $current_default_filter_id ) echo ('selected="selected"'); ?> ><?php echo Inflector::humanize( $filter_id ); ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>

					<p class="help-block"><?php echo __( 'Only for filter in pages, <i>not</i> in snippets.' ); ?></p>
				</div>
			</div>
		</div>

		<?php Observer::notify( 'view_setting_plugins' ); ?>

		<div class="form-actions widget-footer">
			<?php echo Form::button( 'submit', UI::icon( 'ok' ) . ' ' . __( 'Save setting' ), array(
				'class' => 'btn btn-large'
			) ); ?>
		</div>
	</div>
<?php Form::close(); ?>