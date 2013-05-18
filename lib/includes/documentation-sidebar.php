<input type="hidden" name="BASE_URL" id="BASE_URL" value="<?php echo BASE_URL; ?>" />
	
	<section id="sidebar">
		<a class="logo" href="<?php echo BASE_URL; ?>">API Documentor</a>
		<?php
		
		$category = new Categories();
		
		$categories = $category->fetchCategories();
			
		$doc = new Documentor();
		
		?>
		
		<?php if(count($categories) > 0){ ?>
		
			<nav>
				<ul>
					<?php foreach($categories as $realCategory){ ?>
					
						<li><a href="javascript:{}"><?php echo $realCategory['name']; ?></a>
							<ul>
								<?php $calls = $doc->fetchCalls($realCategory['ID']); ?>
								<?php if(count($calls) > 0){ ?>
								
									<?php foreach($calls as $call){ ?>
								
										<li><a href="call/<?php echo $call['ID']; ?>"><?php echo $call['name']; ?></a></li>
										
									<?php } ?>
									
								<?php } ?>
							</ul>
						</li>
					
					<?php } ?>
				</ul>
			</nav><!-- End nav -->
		
		<?php } ?>
		
		<footer>
			<span>Version: <?php echo VERSION; ?></span>
		</footer>
		<div class="clear"></div>
	</section><!-- End sidebar -->